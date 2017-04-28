<?php

    //给客户端一个响应头，响应json 格式的数据.
        header('Content-Type:application/html;charset=utf-8');

        $imgs=$_GET['imgs'];
        $imgs1=substr($imgs,2);
        $imgs2=substr($imgs1,0,strlen($imgs1)-2);
        $imgList=explode('","',$imgs2);
        $date=$_GET['date'];

        //连接数据库 得到连接
        $con = mysql_connect("127.0.0.1","root","");
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }

        //连接那个数据库
        mysql_select_db("workspace", $con);
        for($i=0;$i<count($imgList);$i++){

            $result = mysql_query(" DELETE FROM photo WHERE photo='$imgList[$i]'");
        }
        $sql = " UPDATE photo SET flag = 0 WHERE bookDate='$date'";
        mysql_query($sql);
        if (!mysql_query($sql,$con)){
              die('Error: ' . mysql_error());
            }
        echo '{"status":"ok"}';

        //调用mysql_query 返回结果.
//        $result = mysql_query($sql);



?>