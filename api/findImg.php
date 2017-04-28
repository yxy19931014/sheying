<?php
    header('Content-Type:text/html;charset=utf-8');

    //连接数据库 得到连接
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    $user=$_GET["user"];

    //连接那个数据库  teacher 数据
    mysql_select_db("workspace", $con);

    $sql="SELECT headphoto FROM user
          WHERE username= '$user'";

    //调用mysql_query 返回结果.
    $result = mysql_query($sql);

    //从数据库里面查询到的结果进行一个遍历
    //遍历之
    while($row = mysql_fetch_array($result)){
        echo $row["headphoto"];
    }

    mysql_close($con);
    usleep(300000);
?>