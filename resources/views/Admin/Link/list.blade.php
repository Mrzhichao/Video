@extends('Admin.layout')

@section('content')

 <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
    </div>
    <!--面包屑导航 结束-->

    <!--结果页快捷搜索框 开始-->
    <div class="search_wrap">


    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <div class="alert alert-danger">
                        <ul>
                            @if(session('msg'))
                                <li style="color:red">{{session('msg')}}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="am-u-sm-12">
                <table width="100%" border="1px solid red" class="am-table am-table-compact am-table-striped tpl-table-black list_tab">
              
                    <tr>
                        <th class="tc" width="5%">ID</th>
                        <th class="tc" width="5%">友情链接名</th>
                        <th class="tc" width="5%">提示信息</th>
                        <th class="tc" width="5%">提示url</th>
                        <th class="tc" width="10%">操作</th>
                    </tr>
                                     
                                    
            @foreach($links as $k=>$v)
                    <tr>
                        <td class="tc">{{$v->link_id}}</td>
                        <td class="tc">{{$v->link_name}}</td>
                        <td class="tc">{{$v->link_title}}</td>
                        <td class="tc">{{$v->link_url}}</td>
                        <td>
                            <a href="{{url('admin/link/'.$v->link_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="userDel({{$v->link_id}})">删除</a>
                        </td>
                    </tr>
             @endforeach
       
                </table>
                {{--<style>--}}
                    {{--table{table-layout: fixed;word-break: break-all; word-wrap: break-word; //表格固定布局}--}}

                    {{--.award-name{-o-text-overflow:ellipsis;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;width:100%; //超出部分显示省略号}--}}

                {{--</style>--}}





                {{--分页--}}
                {{--<div class="page_list">--}}
                   <?php
                        $v = empty($input) ? '' : $input;
                    ?>
                    {{--{!! $users->appends(['keywords'=>$v])->render() !!}--}}
                {{--</div>--}}



                <div class="page_list">

                    {{--appends(['keyword1'=>'a','keyword2'=>'aaa@q163.com','num'=>2])--}}
{{--                    {!! $user->appends($request->all())->render() !!}--}}
                </div>

                <style>
                    .page_list ul li span{
                        padding:6px 12px;
                    }
                </style>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

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
@endsection