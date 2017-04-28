<?php
    header('Content-Type:application/html;charset=utf-8');

        $con = mysql_connect("127.0.0.1","root","");
            if (!$con){
                die('Could not connect: ' . mysql_error());
            }
        mysql_select_db("workspace", $con);
        $sql="select * from taocan";

        $result=mysql_query($sql);

        //定义了一个空数组.
        $list = array();
        while($row = mysql_fetch_array($result)){
                $item = array(
                    'class'=> $row['class'],
                    'price' => $row['price'],
                    'cloth' => $row['cloth'],
                    'perfact' => $row['perfact'],
                );
                //往数组里面添加一条记录.
                array_push($list,$item);
            }

        //    输出数据，把数据库里面取到的数据转换成json 格式向客户端输出.
            echo json_encode(
                array(
                    'result'=>$list,
                )
            );






?>