<?php

    header('Content-Type:application/json;charset=utf-8');

    //连接数据库 得到连接
    $user=$_GET['user'];
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace", $con);
    $sql="SELECT bookcode FROM bookphoto
                    WHERE username= '$user'";


    //调用mysql_query 返回结果.
    $result = mysql_query($sql);
    while($row = mysql_fetch_array($result)){
        $sql1="delete bookphoto,bookinfo from bookphoto join bookinfo on bookphoto.bookcode=
            bookinfo.bookcode where bookinfo.bookcode='$row[bookcode]'";
            mysql_query($sql1);
            $sql2="delete from photo where bookcode='$row[bookcode]'";
                mysql_query($sql2);
    }
    $sql3="delete from user where username='$user'";

//    $sql="delete user,bookphoto,bookinfo,photo from user join bookphoto join bookinfo join photo on user.username=bookphoto.username and bookphoto.bookcode=
//    bookinfo.bookcode=photo.bookcode where user.username='$user'";
     mysql_query($sql3);
   if (!mysql_query($sql,$con)){
         die('Error: ' . mysql_error());
    }
     echo '{"status":"ok"}';
    mysql_close($con);
    usleep(300000);
?>