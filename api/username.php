<?php
    header("content-type:text/html;charset=utf-8");
    $username=$_POST["username"];
    $con=mysql_connect("localhost","root","");
    if(!$con){
        die("Could not connect:".mysql_error());
    }
    mysql_select_db("workspace",$con);
    $result=mysql_query("select username from user");
    $flag=false;
    while($row=mysql_fetch_array($result)){
        if($row["username"]==$username){
            $flag=true;
        }
    }
    if($flag == true){
        echo "<font color='red'>此用户名已被注册</font>";
    }else {
        echo "<font color='lime'>✔此用户名可以使用</font>";
    }

    mysql_close($con);
?>