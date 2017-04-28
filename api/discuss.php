<?php
    header('Content-Type:application/html;charset=utf-8');
    $filename  = dirname(__FILE__).'/data.txt';
    $discuss=$_GET['discuss'];
    $user=$_GET['user'];
    $date=date('Y-m-d',time());

        $con = mysql_connect("127.0.0.1","root","");
            if (!$con){
                die('Could not connect: ' . mysql_error());
            }
        mysql_select_db("workspace", $con);
        $sql1="insert into discuss(username,discuss,date) values('$user','$discuss','$date')";
        $sql2="insert into rediscuss(user,content,date,fatherid) values('$user','','',0)";
        mysql_query($sql1);
        mysql_query($sql2);
       echo '{"status":"ok"}';




?>