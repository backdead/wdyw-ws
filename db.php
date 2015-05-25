<?php

include('dbconf.php');


//$conn = mysql_connect($host, $user, $pass);
//mysql_select_db($db_name, $conn);

$mysqli = new mysqli($host, $db_user, $pass, $db_name);

if ($mysqli->connect_errno) {
    printf("DB Connection failed : %s\n", $mysqli->connect_error);
    exit();
}

//$mysqli->autocommit(FALSE);


function checkToken($token)  {
    
    global $mysqli;
    
    $tkn = $mysqli->real_escape_string(strip_tags($token));
    
    
    $sql = "SELECT id, ts FROM z_user WHERE token='$tkn';";   
    if ($result = $mysqli->query($sql)) {
        $res = $result->fetch_object();  
        if (isset($res)) {            
            //chk token life 
            //si plus vieux que 1H, disconnect? ou pas!?            
            //ou nouveau token?
            $userId=$res->id;
        }
        $result->close();
    }
    
    unset($res);
    unset($sql);
    
    return $userId;
}



?>