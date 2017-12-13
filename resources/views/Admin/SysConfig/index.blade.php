@extends('Admin.layout')

@section('content')

                 <meta name="csrf-token" content="{{ csrf_token() }}">
                   <!-- 内容区域 -->
                        <div class="tpl-content-wrapper">

                            <div class="container-fluid am-cf">
                                <div class="row">
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>配置管理&nbsp;&nbsp;&nbsp;&nbsp;<small>配置浏览</small></div>
                                    </div>
                                </div>

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
                                    <table class="list_tab" style="background:white;color: black" >
                                        <tr>
                                            <th width='10%'>是否选择</th>
                                            <th width="5%">排序</th>
                                            <th width="10%">ID</th>
                                            <th width="10%">标题</th>
                                            <th width="10%">名称</th>
                                            <th width="20%">内容</th>
                                            <th width="40%">操作</th>
                                        </tr>

                                    <form action="{{url('admin/sysconfig/delmore')}}" method="post">

                                        {{csrf_field()}}  
                                        @foreach($config as $k=>$v)
                                            <tr>
                                                <td><input type="checkbox" id='del' name="delmore[]"></td>
                                                <td class="tc">
                                                    <input style="width:30px;color:black"  type="text" onchange="changeOrder(this,{{$v->conf_id}})" value="{{$v->conf_order}}">
                                                </td>
                                                <td class="tc ids">{{$v->conf_id}}</td>
                                                <td class="tc ids">{{$v->conf_title}}</td>
                                                <td class="tc ids">{{$v->conf_name}}</td>
                                               
                                            @if($v->field_type == 'radio')
                                                <td class='status'>
                                                    <!-- <input type="hidden" name="conf_id[]" value="{{$v->conf_id}}"> -->
                                                    @if($v->_html == 0)
                                                        <button type="button" class="btn bg-purple margin">启用</button>
                                                    @else
                                                        <button type="button" class="btn bg-olive btn-flat margin">禁用</button>
                                                    @endif
                                                    <span id='div'></span>
                                                </td>
                                            @else
                                                <td class='content' >
                                                    {!! $v->_html !!}
                                                    <span id='div'></span>
                                                </td>
                                            @endif

                                                <td>
                                                    {{--http://www.myblog.com/admin/config/9/edit--}}
                                                    <a href="{{url('admin/sysconfig/'.$v->conf_id.'/edit')}}">修改</a>
                                                    <a href="javascript:;" onclick="delLinks({{$v->conf_id}})">删除</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                        <tr>
                                            <button type="button" id='button'>全选</button>
                                            <button type="button" id='button'>全不选</button>
                                            <button type="button" id='button'>反选</button>
                                        </tr>
                                        <input type='submit' value='删除'>
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
</form>
</body>
</html>

<script type='text/javascript'>
    
    //删除操作
    function delLinks(id) {
        //询问框
        layer.confirm('您确认删除吗？', {
            btn: ['确认','取消'] //按钮
        },function(){
            //如果用户发出删除请求，应该使用ajax向服务器发送删除请求
            //$.get("请求服务器的路径","携带的参数", 获取执行成功后的额返回数据);
            //admin/user/1
            $.post(
                "{{url('admin/sysconfig')}}/"+id,
                {
                    "_method":"delete",
                    "_token":"{{csrf_token()}}"},
                    function(data){
                    //alert(data);
                    //data是json格式的字符串，在js中如何将一个json字符串变成json对象
                    //var res =  JSON.parse(data);

                    if(data.error == 0){
                       //console.log("错误号"+res.error);
                       //console.log("错误信息"+res.msg);
                       layer.msg(data.msg, {icon: 6});
                       //location.href = location.href;
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
    
    // //批量删除
    // $('button').on('click',function(){
    //     switch($(this).html()){
    //         case '全选':
    //             $(this).parent('tr')
    //             $("input[id='del']").prop('checked',true);
    //         break; 
    //         case '全不选':
    //             $("input[id='del']").prop('checked',false);
    //         break; 
    //         case '反选':
    //             $.each($("input[id='del']"),function(i,n){
    //                 $(n).prop('checked',!$(n).prop('checked'));
    //             });
    //         break;
    //     }
    // })
   

    //更新状态操作
    $(".status").on('click', function () {
        var t = $(this);
        var id = $(this).parent().find('.ids').html();

        // 书写 ajax
        $.ajax(
            {
                url:"{{ url('admin/sysconfig/status/ajax/update') }}",
                type:'post',
                data:{id:id},
                success:function (data) {
                    console.log(data);
                    if(data.conf_content == 1)
                    {
                        t.html('<button type="button" class="btn bg-purple margin">禁用</button>');
                    }else {
                        t.html('<button type="button" class="btn bg-olive btn-flat margin">启用</button>');
                    }
                },
                dataType:'json'
            }
        );
    });


    //更新内容操作
    $(".conf_content").blur(function () {  

        id =  $(this).parents('tr').find(".ids").html(); 
        content = $(this).val();
        
        layer.confirm(
            '您确认修改吗？', 
            {btn: ['确认','取消'] },
            function(){
                $.ajax( 
                { 
                    url:"{{ url('admin/sysconfig/content/ajax/update') }}",
                    type:'post',
                    data:{id:id,content:content},
                    success:function (data) {

                        if(data.error == 0){
                           //console.log("错误号"+res.error);
                           //console.log("错误信息"+res.msg);
                           layer.msg(data.msg, {icon: 6});
                           //location.href = location.href;
                           var t=setTimeout("location.href = location.href;",2000);
                        }else{
                           layer.msg(data.msg, {icon: 5});

                           var t=setTimeout("location.href = location.href;",2000);
                           //location.href = location.href;
                        }
                    },
                    dataType:'json'
                }) 
            }, 
            function(){}
        );
    })


    //排序操作
    function changeOrder(obj,conf_id){
        //获取当前需要排序的记录的ID,vtid
        //获取当前记录的排序文本框中的值
        var conf_order = $(obj).val();

        $.post("{{url('admin/sysconfig/changeorder')}}",{'_token':"{{csrf_token()}}","conf_id":conf_id,"conf_order":conf_order},function(data){
            //如果排序成功，提示排序成功
            if(data.status == 0){

                layer.msg(data.msg,{icon: 6});
                location.href = location.href;
            }else{
                //如果排序失败，提示排序失败
                layer.msg(data.msg,{icon: 5});
                location.href = location.href;
            }

        })

    }

</script>

@stop

    