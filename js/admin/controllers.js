/**
 * Created by Administrator on 2017/4/20.
 */
angular.module('Ctrls',[])
    .controller('NavsCtrls',['$scope',function ($scope) {
        $scope.navs=[
            {'text':'用户管理',link:'#!/users'},
            {'text':'订单管理',link:'#!/orders'},
            {'text':'评论管理',link:'#!/discuss'},
            {'text':'活动和报价管理',link:'#!/price'}
        ];
    }])
.controller('usersCtrl',['$scope','$rootScope','$http',function ($scope,$rootScope,$http) {
    $rootScope.key=0;
    $scope.flag=true;
    $http({
        url:'../../js/admin/model/users.php'
    }).then(function (data) {
        $scope.rows=data.data.rows;
    });
    $scope.search=function () {
        var user=$scope.user;
        $http({
            url:'../../js/admin/model/finduser.php',
            params:{
                user:user
            }
        }).then(function (data) {
            $scope.rows=data.data.rows;
        })
    };
    $scope.delete=function (target) {
        var user=target.getAttribute('data-id');
        $http({
            url:'../../js/admin/model/deleteUser.php',
            params:{
                user:user
            }
        }).then(function (data) {
            if(data.data.status=='ok'){
                location.reload();
            }
        })
    };
    $scope.add=function (target) {
        $scope.username=target.getAttribute('data-user');
        if($scope.flag){
            $scope.flag=false;
        }
        $scope.submit=function () {
            $scope.date=new Date($scope.orderDate).getTime();
            // 时间格式化函数
            Date.prototype.format = function(fmt) {
                var o = {
                    "M+" : this.getMonth()+1,                 //月份
                    "d+" : this.getDate(),                    //日
                    "h+" : this.getHours(),                   //小时
                    "m+" : this.getMinutes(),                 //分
                    "s+" : this.getSeconds(),                 //秒
                    "q+" : Math.floor((this.getMonth()+3)/3), //季度
                    "S"  : this.getMilliseconds()             //毫秒
                };
                if(/(y+)/.test(fmt)) {
                    fmt=fmt.replace(RegExp.$1, (this.getFullYear()+"").substr(4 - RegExp.$1.length));
                }
                for(var k in o) {
                    if(new RegExp("("+ k +")").test(fmt)){
                        fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length)));
                    }
                }
                return fmt;
            }
            var orderDate = new Date($scope.date).format("yyyy-MM-dd");
            $http({
                url:'../../js/admin/model/addOrder.php',
                params:{
                    user:$scope.username,
                    orderCode:$scope.orderCode,
                    orderClass:$scope.orderClass,
                    orderPrice:$scope.orderPrice,
                    orderDate:orderDate
                }
            }).then(function (data) {
                if(data.data.status=='ok'){
                    $scope.flag=false;
                    location.reload();
                }
            })
        };
    };

}])
.controller('ordersCtrl',['$scope','$rootScope','$http',function ($scope,$rootScope,$http) {
    $rootScope.key=1;
    $scope.settings='设置为可取';
    $scope.flag=true;
    $http({
        url:'../../js/admin/model/orders.php',
    }).then(function (data) {
        $scope.rows=data.data.rows;
        $scope.setting=function (target) {
            var code=target.getAttribute('data-code');
            $http({
                url:'../../js/admin/model/settings.php',
                params:{
                    code:code
                }
            }).then(function (data) {
                if(data.data.status=='ok'){
                    console.log($scope.rows);
                    $scope.rows.forEach(function (item) {
                        if(item.bookcode==code){
                            item.settings='已设置为可取';
                        }
                    });
                }
            })
        };
    });
    $scope.search=function () {
        var code=$scope.code;
        $http({
            url:'../../js/admin/model/findOrder.php',
            params:{
                code:code
            }
        }).then(function (data) {
            $scope.rows=data.data.rows;
        })
    };
    $scope.delete=function (target) {
        var code=target.getAttribute('data-id');
        $http({
            url:'../../js/admin/model/deleteOrder.php',
            params:{
                code:code
            }
        }).then(function (data) {
            if(data.status=='ok'){
                location.reload();
            }
        })
    };
    var photos=[];
    $scope.upload=function (target) {
        if($scope.flag){
            $scope.flag=false;
        }
        var code=target.getAttribute('data-code');
        var date=target.getAttribute('data-date');
        $("#upload").fileupload({
            autoUpload: true,
            done:function (e,data) {
                $(".showphotos").append("<div class='photo'><img src='../../api/img/"+data._response.result+"'></div>");
                photos.push(data._response.result);
            }
        });
        $scope.addPhotos=function () {
            var newPhoto=photos.join(',');
            $http({
                url:'../../js/admin/model/addPhotos.php',
                params:{
                    code:code,
                    date:date,
                    photos:newPhoto
                }
            }).then(function (data) {
                if(data.data.status=='ok'){
                    $scope.flag=true;
                    location.reload();
                }
            });
        };
    };

}])
.controller('discussCtrl',['$scope','$http','$rootScope',function ($scope,$http,$rootScope) {
    $rootScope.key=2;
    $scope.flag=true;
    $http({
        url:'../../js/admin/model/discuss.php',
    }).then(function (data) {
        $scope.rows=data.data.rows;
    });
    $scope.delete=function (target) {
        var id=target.getAttribute('data-id');
        $http({
            url:'../../js/admin/model/deleteDiscuss.php',
            params:{
                id:id
            }
        }).then(function (data) {
            if(data.data.status=='ok'){
                location.reload();
            }
        })
    };
    $scope.rediscuss=function (target) {
        $scope.flag=false;
        $scope.save='确定回复';
        var id=target.getAttribute('data-id');
        var user=target.getAttribute('data-user');
        $http({
            url:'../../js/admin/model/finddiscuss.php',
            params:{
                id:id
            }
        }).then(function (data) {
            $scope.content=data.data.rows[0].discuss;
            $scope.user=user;
            $scope.respeak=function () {
                var content=$scope.speak;
                $http({
                    url:'../../js/admin/model/rediscuss.php',
                    params:{
                        user:user,
                        content:content,
                        fatherid:id
                    }
                }).then(function (data) {
                    console.log(data.data);
                    if(data.data.status=='ok'){
                        $scope.flag=true;
                        location.reload();
                    }
                })
            }
        })
        
    }
}])
.controller('priceCtrl',['$scope','$http','$rootScope',function ($scope,$http,$rootScope) {
    $rootScope.key=3;
    $scope.flag=true;
    $http({
        url:'../../js/admin/model/taocan.php',
    }).then(function (data) {
        $scope.rows=data.data.rows;
    });
    $scope.delete=function (target) {
        var taoclass=target.getAttribute('data-id');
        $http({
            url:'../../js/admin/model/deletetaocan.php',
            params:{
                taoclass:taoclass
            }
        }).then(function (data) {
            if(data.data.status=='ok'){
                location.reload();
            }
        })
    };
    $scope.add=function () {
        $scope.flag=false;
        $scope.save='添加';
        $scope.submit=function () {
            var taoclass=$scope.taoclass;
            var price=$scope.price;
            var cloth=$scope.cloth;
            var perfact=$scope.perfact;
            $http({
                url:'../../js/admin/model/addTaocan.php',
                params:{
                    taoclass:taoclass,
                    price:price,
                    cloth:cloth,
                    perfact:perfact
                }
            }).then(function (data) {
                if(data.data.status=='ok'){
                    $scope.flag=true;
                    location.reload();
                }
            })
        };
    };
    $scope.edit=function (target) {
        $scope.flag=false;
        $scope.save='保存';
        var editclass=target.getAttribute('data-user');
        $http({
            url:'../../js/admin/model/findtaocan.php',
            params:{
                class:editclass
            }
        }).then(function (data) {
            $scope.taoclass=editclass;
            $scope.price=data.data.rows[0].price;
            $scope.cloth=data.data.rows[0].cloth;
            $scope.perfact=data.data.rows[0].perfact;
            $scope.submit=function () {
                $http({
                    url:'../../js/admin/model/edittaocan.php',
                    params:{
                        class:editclass,
                        price:$scope.price,
                        cloth:$scope.cloth,
                        perfact:$scope.perfact,
                    }
                }).then(function (data) {
                    if(data.data.status=='ok'){
                        $scope.flag=true;
                        location.reload();
                    }
                })
            }
        });
    }

}])