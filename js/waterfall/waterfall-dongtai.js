/**
 * Created by thinkpad on 2017/2/21.
 */
// 扩展jQuery的方法
// 分为两种
// 一种是扩展jQuery的全局方法
// 一种是局部方法
// 一般假设要扩展的是工具方法，就扩展全局方法
// 一般要操作页面上的dom，扩展局部方法
var arr=[];
$.fn.waterfall=function () {
    var items=$(".items");
    var parentWidth=items.width();
    var item=items.children();
    var width=item.width();
    var column=5;
    var space=(parentWidth-column*width)/(column-1);
    


    // 开始定位
    item.each(function (index,dom) {
         // 先计算第一行
        // 一行五列
        var obj=$(dom);
        if(index<column){
            var top=0;
            obj.css({
                left:index*(width+space),
                top:"0"
            });
            arr[index]=obj.height();
        }else  {
            // 找到最矮的一列索引值
            var minIndex=0;//假设最小的索引为0
            var minHeight=arr[minIndex];
            for(var i=0;i<arr.length;i++){
                if(minHeight>arr[i]){
                    minHeight=arr[i];
                    minIndex=i;
                }
            }

            obj.css({
                top:minHeight+space,
                left:minIndex*(width+space)
            });
            arr[minIndex]=minHeight+space+obj.height();
        }

    });

// 计算最高的一列
    var maxIndex=0;
    var maxHeight=arr[maxIndex];
    for(var i=0;i<arr.length;i++){
        if(maxHeight<arr[i]){
            maxIndex=i;
            maxHeight=arr[i];
        }
    }
    items.height(maxHeight+30+"px");
    
    
    
};

