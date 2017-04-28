<?php

    //给客户端一个响应头，响应json 格式的数据.
        header('Content-Type:application/html;charset=utf-8');
        $code=$_GET['code'];
        $date=$_GET['date'];
        $imgs=$_GET['photos'];
        $imgList=explode(',',$imgs);

        //连接数据库 得到连接
        $con = mysql_connect("127.0.0.1","root","");
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }

        //连接那个数据库
        mysql_select_db("workspace", $con);
        for($i=0;$i<count($imgList);$i++){

            mysql_query("insert into photo(bookcode,photo,bookDate,flag) values ('$code','$imgList[$i]','$date',1)");
        }

        echo '{"status":"ok"}';




?>