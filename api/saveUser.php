<?php

    header('Content-Type:text/html;charset=utf-8');

    $con = mysql_connect("127.0.0.1","root","");

    if (!$con){
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db("workspace", $con);

    //sql 语句
    $sql="INSERT INTO user (username,password,sex,headphoto,type)

    VALUES
    ('$_POST[username]','$_POST[password]','$_POST[sex]','$_POST[photo]',1)";
    if (!mysql_query($sql,$con)){
      die('Error: ' . mysql_error());
    }

    //添加成功
    echo '{"status":"ok"}';
    //关闭跟数据库的连接
    mysql_close($con)
?>