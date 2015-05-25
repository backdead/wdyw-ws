<?php

include('db.php');
include('fonction.php');
include('headers.php');

if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    http_response_code(200);
} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = "select t.*, count(r.person) as nb_participants from (SELECT c.id as id_user, b.code as type_activity, a.id as id_activity, a.name, a.time, a.minpeople, a.maxpeople, a.location, a.city, c.name as user_name, c.avatar FROM z_activity a, type_activity b, z_user c where a.isdeleted = 0 and a.person = c.id and a.type = b.id) t left join relation_participant r on t.id_activity = r.activity group by t.type_activity, t.name, t.time, t.minpeople, t.maxpeople, t.location, t.city, t.user_name, t.avatar order by time desc";

    $i = 0;

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_object()) {
            if (!isset($row->avatar)) {
                $row->avatar = 'images/avatars/anonymous_mask.png';
            }

            $json[$i] = array("type" => $row->type_activity,
                "name" => $row->name,
                "date" => $row->time,
                "location" => $row->location,
                "city" => $row->city,
                "host" => $row->user_name,
                "minpeople" => $row->minpeople,
                "maxpeople" => $row->maxpeople,
                "nbparticipants" => $row->nb_participants,
                "avatar" => stripslashes($row->avatar),
                "id_activity" => $row->id_activity,
                "id_user" => $row->id_user);

            $i++;
        }
        $result->close();
    }
    $mysqli->close();

    echo json_encode($json);
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $token = $_SERVER['HTTP_TKN'];
    $userId = checkToken($token);

    if (isset($userId)) {
        $json = file_get_contents('php://input');

        $obj = json_decode($json, true);
        
        if (isset($obj) && $obj['treatment'] == "CREATE") {
            $d1 = getdate(strtotime($obj['date']));
            $d2 = getdate(strtotime($obj['time']));

            $date1 = $d1['year'] . '-' . $d1['mon'] . '-' . $d1['mday'];
            $date2 = $d2['hours'] . ':' . $d2['minutes'];


            $person = $userId;
            $type = getActivityTypeId($obj['type']);
            $name = $obj['name'];
            $location = $obj['location'];
            $date = $date1 . ' ' . $date2;
            $pMin = $obj['pmin'];
            $pMax = $obj['pmax'];
            $city = 'METZ';
            $phone1 = '0631742452';
            $phone2 = null;

            $sql = "insert into z_activity (id, person, type, name, time, city, location, minpeople, maxpeople, phone1, phone2, ts, isdeleted) value (UUID(), '$person', '$type', '$name', '$date', '$city', '$location', '$pMin', '$pMax', '$phone1', '$phone2', CURRENT_TIMESTAMP, 0);";

            $ok = 0;
            if ($mysqli->query($sql)) {
                $ok+= $mysqli->affected_rows;
            }
            
            unset($sql);

            if ($ok == 1) {

                //TODO envoyer un mail pour inviter à confirmer l'email
                //TODO un ws qui premet de passer le champ emailValid=1
                //$obj->token = uniqid();
                $res = array("status" => 'OK');
            } else {
                $res = array("status" => "ACTIVITY_CREATION_FAILED");
            }

            $mysqli->close();
            
        } else if($obj['treatment'] == "CANCEL") {
            $idActivity = $obj['id'];
            
            $sql1 = "delete from relation_participant where activity = '$idActivity';";
            $sql2 = "update z_activity set isdeleted = 1, ts = CURRENT_TIMESTAMP where id = '$idActivity';";
            
            $result = $mysqli->query($sql1);
            
            $ok = 0;
            if ($mysqli->query($sql2)) {
               $ok += $mysqli->affected_rows;
            }
            
            unset($sql1);
            unset($sql2);
            unset($result);
            
            if($ok == 1) {
                $res = array("status" => 'OK');
            } else {
                $res = array("status" => 'ACTIVITY_CANCELATION_FAILED');
            }
            
            $mysqli->close();
        }
    } else {
        $res = array("status" => 'AUTH_FAILED');
    }
    echo json_encode($res);
} else {
    http_response_code(403);
}
?>
     