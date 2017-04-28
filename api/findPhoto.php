<?php

    /*
            1:接收客户端的请求
                获取客户端的参数
            2：处理请求
                查询数据，连接数据库，发送sql 语句，返回结果，遍历结果
                组装成json 格式
            3：响应数据
                响应json 格式的数据.
    */

    //给客户端一个响应头，响应json 格式的数据.
    header('Content-Type:application/json;charset=utf-8');

    //连接数据库 得到连接
    $con = mysql_connect("127.0.0.1","root","");
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }

    //连接那个数据库  itcast 数据
    mysql_select_db("workspace", $con);


    $date = $_GET['date'];

    $sql="SELECT * FROM photo
                              WHERE bookDate= '$date'";

    //调用mysql_query 返回结果.
    $result = mysql_query($sql);


    //定义了一个空数组.
    $list = array();

    $total = 0;

    //从数据库里面查询到的结果进行一个遍历
    //遍历之
    while($row = mysql_fetch_array($result)){
        $item = array(
            'type'=> $row['flag'],
            'photo' => $row['photo']
        );
        //往数组里面添加一条记录.
        array_push($list,$item);

        //总记录数
        $total++;
    }

//    输出数据，把数据库里面取到的数据转换成json 格式向客户端输出.
    echo json_encode(
        array(
            'photo'=>$list,
            'total'=>$total
        )
    );
    mysql_close($con);
    usleep(300000);
?>