/**
 * Created by thinkpad on 2017/3/5.
 */
$(function () {
    $("#upload").fileupload({
        autoUpload: true,
        done:function (e,data) {
            $(".photo").html("<img src='api/"+data._response.result+"'>");
            $("#photoHidden").val(data._response.result);
        }
    });
});