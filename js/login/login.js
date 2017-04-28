/**
 * Created by thinkpad on 2017/3/9.
 */


$("#login").click(function () {
    $.cookie('PHPSESSID', '', { expires: -1 });
    var user=$("#user").val();
    var pwd=$("#pwd").val();
    var type=$('#type').val();
    $.ajax({
        url:"api/login.php",
        type:"post",
        data:{
            user:user,
            pwd:pwd,
            type:type
        },
        success:function (data) {
            $(".loginTip").html(data);
            if($(".loginTip").html()=='<font color="lime">登陆成功</font>'){
                if(type==0){
                    setTimeout(function () {
                        //  跳转
                        $.cookie('username',user,{path:'/'});
                        $.cookie('password',pwd,{path:'/'});
                        $(".login .close").click();
                        location.href="views/admin/index.html";
                    },500);
                }else {
                    setTimeout(function () {
                        //  跳转
                        $.cookie('username',user,{path:'/'});
                        $.cookie('password',pwd,{path:'/'});
                        $(".login .close").click();
                        location.href="loginSuccess.html";
                    },500);
                }

            }else {
                $("#user").val("");
                $("#pwd").val("");
            }
        }
    })
});