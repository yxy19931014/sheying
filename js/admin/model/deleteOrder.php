<?php

    header('Content-Type:application/json;charset=utf-8');

    //连接数据库 得到连接
    $code=$_GET['code'];
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace", $con);

    $sql="delete bookphoto,bookinfo from bookphoto join bookinfo on bookphoto.bookcode=
    bookinfo.bookcode where bookinfo.bookcode='$code'";
    mysql_query($sql);
    $sql1="delete from photo where bookcode='$code'";
        mysql_query($sql1);

   if (!mysql_query($sql,$con) || !mysql_query($sql1,$con)){
         die('Error: ' . mysql_error());
    }


    echo '{"status":"ok"}';
    mysql_close($con);
    usleep(300000);
?>