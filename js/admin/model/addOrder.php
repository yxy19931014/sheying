<?php

    header('Content-Type:application/json;charset=utf-8');
    $code=$_GET['orderCode'];
    $class=$_GET['orderClass'];
    $price=$_GET['orderPrice'];
    $date=$_GET['orderDate'];
    $user=$_GET['user'];
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace", $con);

    $sql="insert into bookinfo(bookcode,bookclass,bookprice,bookDate)values ('$code','$class','$price','$date')";
    $sql1="insert into bookphoto(username,bookcode,bookDate)values ('$user','$code','$date')";
    mysql_query($sql);
    mysql_query($sql1);
    echo '{"status":"ok"}';
    mysql_close($con);
    usleep(300000);
?>