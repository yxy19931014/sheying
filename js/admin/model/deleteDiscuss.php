<?php

    header('Content-Type:application/json;charset=utf-8');

    //连接数据库 得到连接
    $id=$_GET['id'];
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace", $con);

    $sql="delete discuss from discuss where id='$id'";
    mysql_query($sql);

    echo '{"status":"ok"}';
    mysql_close($con);
    usleep(300000);
?>