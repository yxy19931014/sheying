<?php

    header('Content-Type:application/json;charset=utf-8');

    //连接数据库 得到连接
    $class=$_GET['class'];
    $price=$_GET['price'];
    $cloth=$_GET['cloth'];
    $perfact=$_GET['perfact'];
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace", $con);

    $sql="update taocan set price='$price',cloth='$cloth',perfact='$perfact' where class='$class'";
    mysql_query($sql);

//    输出数据，把数据库里面取到的数据转换成json 格式向客户端输出.
    echo json_encode(
        array(
            "status"=>"ok",
        )
    );
    mysql_close($con);
    usleep(300000);
?>