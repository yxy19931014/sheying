<?php

    header('Content-Type:application/json;charset=utf-8');

    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    $code=$_GET['code'];
    mysql_select_db("workspace", $con);

    $sql = " UPDATE photo SET flag = 1 WHERE bookcode='$code'";

    mysql_query($sql);

    echo json_encode(
        array(
            "status"=>"ok",
        )
    );
    mysql_close($con);
    usleep(300000);
?>