<?php

    header('Content-Type:application/json;charset=utf-8');

    //连接数据库 得到连接
    $taoclass=$_GET['taoclass'];
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace", $con);

    $sql="delete from taocan where class='$taoclass'";
    mysql_query($sql);

    echo '{"status":"ok"}';
    mysql_close($con);
    usleep(300000);
?>