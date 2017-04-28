<?php
    header('content-type:text/html;charset=utf-8');
    $user=$_POST["user"];
    $pwd=$_POST['pwd'];
    $type=$_POST['type'];
    $con=mysql_connect("localhost","root","");
    if(!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("workspace",$con);

    $result = mysql_query("SELECT * FROM user");
    $userFlag=false;
    $pwdFlag=true;
    $typeFlag=false;
    while($row = mysql_fetch_array($result)){
        if($row["username"]==$user){
            $userFlag=true;
            if($row["password"]!=$pwd){
                $pwdFlag=false;
            }
            if($row['type']==$type){
                $typeFlag=true;
            }
        }
    }
    if($userFlag==false){
        echo "<font color='red'>该用户名不存在</font>";
    } else {
        if($pwdFlag==true && $typeFlag==true){
            if($type=='1'){
                            //    开启会话
                            session_start();
                        //    服务器存储了session的信息
                            $userInfo=array(
                                'username'=>$user,
                                'password'=>$pwd
                            );
                            $_SERVER['userInfo']=$userInfo;
            }
            echo "<font color='lime'>登陆成功</font>";
        }else{
            echo "<font color='red'>登录失败！请重新输入</font>";
        }
    }

    mysql_close($con);
?>