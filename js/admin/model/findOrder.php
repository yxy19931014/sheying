<?php

    header('Content-Type:application/json;charset=utf-8');

    //连接数据库 得到连接
    $code=$_GET['code'];
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace", $con);

    $sql="SELECT * FROM bookinfo where bookcode='$code'";

    $result = mysql_query($sql);

    $list = array();

    while($row = mysql_fetch_array($result)){
        $item = array(
            'bookcode' =>$row['bookcode'],
                        'bookclass' => $row['bookclass'],
                        'bookprice'=>$row['bookprice'],
                        'bookDate'=>$row['bookDate']
        );
        //往数组里面添加一条记录.
        array_push($list,$item);
    }

//    输出数据，把数据库里面取到的数据转换成json 格式向客户端输出.
    echo json_encode(
        array(
            'rows'=>$list,
        )
    );
    mysql_close($con);
    usleep(300000);
?>