<?php

include('db.php');
//include('fonction.php');
include('headers.php');

if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    http_response_code(200);
} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $sql = "select * from goal order by ts desc";

    $i = 0;
   

    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_object()) {
  
            $json[$i] = array("name" => $row->name,
                "age" => $row->age,
                "comment" => $row->comment,
                "ts" => $row->ts);
  
            $i++;
        }
        $result->close();
    }
    $mysqli->close();
    echo json_encode($json);
} 
/*else if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
            
        }
    }
    echo json_encode($res);
} */
else {
    http_response_code(403);
}
?>
     