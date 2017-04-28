<?php

	header('Content-Type:text/html; charset=utf-8');
    //连接数据库 得到连接
        $con = mysql_connect("127.0.0.1","root","");
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }

        //连接那个数据库  itcast 数据
        mysql_select_db("workspace", $con);
	//get 方式提交. 当前页码
        $page = $_GET['page'];

        //每页显示多少条.
        $pageSize = $_GET['pageSize'];

        $start=($page-1)*$pageSize;

        $sql="select *,(select count(*) from photo) as total from photo order by id desc limit $start , $pageSize ";


        //调用mysql_query 返回结果.
        $result = mysql_query($sql);


        //定义了一个空数组.
        $list = array();

        //从数据库里面查询到的结果进行一个遍历
        //遍历之
        while($row = mysql_fetch_array($result)){
            $item = array(
                'photo' => $row['photo'],
            );
            //往数组里面添加一条记录.
            array_push($list,$item);
        }
        $page++;
    //    输出数据，把数据库里面取到的数据转换成json 格式向客户端输出.
        echo json_encode(array("page"=>$page,"items"=>$list));

        mysql_close($con);
        sleep(1);
?>