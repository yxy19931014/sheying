<?php

    header('Content-Type:application/json;charset=utf-8');
    $taoclass=$_GET['taoclass'];
    $price=$_GET['price'];
    $cloth=$_GET['cloth'];
    $perfact=$_GET['perfact'];

    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace", $con);

    $sql="insert into taocan(class,price,cloth,perfact)values ('$taoclass','$price','$cloth','$perfact')";
    mysql_query($sql);
    echo '{"status":"ok"}';
    mysql_close($con);
    usleep(300000);
?>