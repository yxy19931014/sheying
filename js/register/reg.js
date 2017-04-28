/**
 * Created by thinkpad on 2017/3/5.
 */
// 验证用户名是否存在
$("#username").blur(function () {
    var username=$(this).val();
    $.ajax({
        type:"post",
        url:"api/username.php",
        data:{
            "username":username
        },
        success:function (data) {
            $(".usertest").html(data);
            if($(".usertest").html()=='<font color="red">此用户名已被注册</font>'){
                $(".usertest").attr("test","0");
            }else {
                $(".usertest").attr("test","1");
            }
        }
    })
});
// 保存用户注册的信息
$("li.reg").click(function () {
    $("div.reg").show();
    $("#regId").find("input").val("");
    $("#regId").find("#reg").val("注册");
    $("#regId").find("span").html("");
    $("#regId").find(".photo").html("");

    $("form .close").click(function () {
        $(this).parents(".reg").hide();
    });
    $("#reg").click(function () {
        var data=$("#regId").serialize();
        $.ajax({
            type:"post",
            url:"api/saveUser.php",
            data:data,
            dataType:"json",
            beforeSend:function () {
                $("#regId").append("<p class='tip'></p>");
                var tip=$(".tip");
                tip.css({
                    "position":"absolute",
                    "bottom":"80px",
                    "right":"200px",
                    "color":"red",
                    "fontWeight":700
                });
                if($(".usertest").attr("test")==0){
                    tip.html("请输入正确的用户名");
                    return false;
                }else if($("#username").val()==0 || $("#password").val()==0 || $("#sex").val()==0 || $("#photo").val()==0){
                    tip.html("请完整填写注册信息");
                    return false;
                }
            },
            success:function (data) {
                console.log(data);
                if(data.status=="ok"){
                    $(".tip").html("注册成功");
                    setTimeout(function () {
                        $("form .close").click();
                        location.href="regSuccess.html";
                    },1000);

                }
            }
        })
    });
});
