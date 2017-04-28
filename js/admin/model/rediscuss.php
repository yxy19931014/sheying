<?php

    header('Content-Type:application/json;charset=utf-8');
    $fatherid=$_GET['fatherid'];
    $user=$_GET['user'];
    $content=$_GET['content'];
    $date=date('Y-m-d',time());
         $con = mysql_connect("127.0.0.1","root","");
             if (!$con){
                 die('Could not connect: ' . mysql_error());
             }
    mysql_select_db("workspace", $con);
    $sql="insert into rediscuss(user,content,date,fatherid) values('$user','$content','$date','$fatherid')";
    $sql="update rediscuss set content='$content',user='$user',fatherid='$fatherid',date='$date' where content=''and user='$user'";
    mysql_query($sql);
    echo '{"status":"ok"}';

?>