@extends('Admin.layout')

@section('content')

 <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">浏览配置</div>

                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a class="am-btn am-btn-default am-btn-success" href="{{ url('admin/sysconfig/create') }}">新增</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="am-u-sm-12">
                                   <table class="table table-hover table-bordered " style="background:white;color:black">
                                        <tr>
                                            <th width="5%" >ID</th>
                                            <th width="10%">友情链接名</th>
                                            <th width="50%" align='center'>提示信息</th>
                                            <th width="15%">提示url</th>
                                            <th >操作</th>
                                        </tr>

                                    @foreach($links as $k=>$v)
                                            <tr>
                                                <th class="tc">{{$v->link_id}}</th>
                                                <th class="tc">{{$v->link_name}}</th>
                                                <th class="tc">{{$v->link_title}}</th>
                                                <th class="tc">{{$v->link_url}}</th>
                                                <th>
                                                    <a href="{{url('admin/link/'.$v->link_id.'/edit')}}">修改</a>
                                                    <a href="javascript:;" onclick="userDel({{$v->link_id}})">删除</a>
                                                </th>
                                            </tr>       
                                     @endforeach

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script src="{{ asset('Admin/assets/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/amazeui.datatables.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/app.js') }}"></script>

    <script src="{{ asset('/Admin/assets/js/jquery.min.js') }}"></script>
</body>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
       
 <script>
        
        function userDel(id) {

            //询问框
            layer.confirm('您确认删除吗？', {
                btn: ['确认','取消'] //按钮
            }, function(){
//                如果用户发出删除请求，应该使用ajax向服务器发送删除请求
//                $.get("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);
                //admin/user/1
                $.post("{{url('admin/user')}}/"+id,{"_method":"delete","_token":"{{csrf_token()}}"},function(data){
                    //alert(data);
//                    data是json格式的字符串，在js中如何将一个json字符串变成json对象
                   //var res =  JSON.parse(data);
//                    删除成功
                   if(data.error == 0){
                       //console.log("错误号"+res.error);
                       //console.log("错误信息"+res.msg);
                       layer.msg(data.msg, {icon: 6});
//                       location.href = location.href;
                       var t=setTimeout("location.href = location.href;",2000);
                   }else{
                       layer.msg(data.msg, {icon: 5});

                       var t=setTimeout("location.href = location.href;",2000);
                       //location.href = location.href;
                   }


                });


            }, function(){

            });
        }
        




    </script>

</html>
@stop

    