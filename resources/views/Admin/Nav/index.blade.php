@extends('Admin.layout')
@section('content')


<div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>导航管理 ><small>导航预览</small></div>
                       
                    </div>
                     <div class="widget-head am-cf">
                             <div class="widget-title am-fl">
                                <a id="create" href="{{ url('admin/nav/create') }}"> <button  type="button" style="color: " class="btn active  btn-success">&nbsp;更新导航&nbsp;</button></a>
                                </div>
                            </div>
                </div>
            
            </div>
            
            <div class="row-content am-cf">
    	

                <div class="row">

 
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">

                        <div class="widget am-cf">
                           
                            <div class="widget-body  widget-body-lg am-fr">
                            
                                <table width="100%" id="example-r" class="am-table am-table-compact tpl-table-black ">
                                    <thead>
                                        <tr>

                                        	<th>导航编号</th>
                                            <th>导航名称</th>
                                            <th>导航描述</th>
                                            <th>导航链接</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $k => $v)
                                        <tr class="gradeX">
                                        	<td class="id">{{ $v -> nid }}</td>
                                            
                                            <td class="nname">{{ $v -> nname }}</td>
                                            <td  class="ndesc">{{ $v -> ndesc }}</td>
                                            
                                            <td class="nsrc">{{ $v -> resourceSrc }}</td>
                                            
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                  
                                                    <a class="tpl-table-black-operation-del del" href="javascript:void(0);" onclick="sendBtn('nav/{{ $v->nid }}')">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                                                       
                                        <!-- more data -->
                                    </tbody>
                                </table>
                                <div class="am-u-lg-12 am-cf">
                              
                                    <div class="am-fr tpl-pagination">
                                        <ul id="fenye" class="am-pagination ">
                                            
                                        </ul>
                                    </div>
                                </div>
								  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>

            </div>
        </div>

<!--判断错误信息 并弹出-->
@if(Session('msg'))
<script type="text/javascript">
//弹出信息框
     layer.alert("{{session('msg')}}", {
        skin: 'layui-layer-lan'
        ,closeBtn: 0
        ,anim: 2 //动画类型
        });

</script>
@endif

<script type="text/javascript">
//点击编辑时 弹出
    $('#edit').on('click',function()
        {
            layer.msg('玩命加载中');
        });
//点击添加时 弹出
 $('#create').on('click',function()
        {
            layer.msg('玩命加载中');
        });
 //点击搜索时 弹出
 $('#serach').on('click',function()
        {         //加载层
            var index = layer.load(1, {shade: false}); //0代表加载的风格，支持0-2
        });
  //点击搜索时 弹出
 $('#fenye').on('click',function()
        {         //加载层
            var index = layer.load(1, {shade: false}); //0代表加载的风格，支持0-2
        });

</script>


<script type="text/javascript">
       function sendBtn(path) {

           
        //询问框
        layer.confirm('你确定要删除吗?', {
        btn: ['狠心','不舍'] //按钮
        }, function(){
            $.ajax({

                    type:'DELETE',
                    url:path,
                    success:function(data)
                    {      
                        window.location.reload();
                        layer.msg(data, {icon: 1});
                    }
               });
        }, function(){
        });
        };
    </script>

<!--单击修改导航描述-->
<script>
        $(".ndesc").on('dblclick', fn1);

        function fn1() {
            var t = $(this);
            var id = t.parent().find('.id').html(); //获取ID名(修改数据)
            var name = t.html();
            var inp = $('<input style="color:black;" type="text">');
            inp.val(name);
            t.html(inp);
            inp.select();
            t.unbind('dblclick');
            inp.on('blur', function () {
                var newName = $(this).val();
                $.ajax({
                    url: "{{ url('admin/nav/ajaxNdesc') }}",
                    type: 'post',
                    data: {id: id, name: newName},
                    beforeSend: function () {
                        $("#info").html('<span class="text-red"><i class="fa fa-fw fa-spin fa-circle-o-notch"></i>正在修改中...</span>');
                        $("#info").show();
                    },
                    success: function (data) {
//                        console.log(data);
                        if (data.code == 0) {
                            t.html(name);
                            $("#info").html('<span class="text-red">用户名已经存在</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        } else if (data.code == 1) {
                            t.html(newName);
                            $("#info").html('<span class="text-red">修改成功</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        } else {
                            t.html(name);
                            $("#info").html('<span class="text-red">修改失败</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        }
                        ;
                        //添加事件。
                        t.on('dblclick', fn1);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
//                    timeout:1000,
                    dataType: 'json'
                });
            });
        }

    </script>


    <!--单击修改导航路径-->
<script>
        $(".nsrc").on('dblclick', fn1);

        function fn1() {
            var t = $(this);
            var id = t.parent().find('.id').html(); //获取ID名(修改数据)
            var name = t.html();
            var inp = $('<input style="color:black;" type="text">');
            inp.val(name);
            t.html(inp);
            inp.select();
            t.unbind('dblclick');
            inp.on('blur', function () {
                var newName = $(this).val();
                $.ajax({
                    url: "{{ url('admin/nav/ajaxNsrc') }}",
                    type: 'post',
                    data: {id: id, name: newName},
                    beforeSend: function () {
                        $("#info").html('<span class="text-red"><i class="fa fa-fw fa-spin fa-circle-o-notch"></i>正在修改中...</span>');
                        $("#info").show();
                    },
                    success: function (data) {
//                        console.log(data);
                        if (data.code == 0) {
                            t.html(name);
                            $("#info").html('<span class="text-red">用户名已经存在</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        } else if (data.code == 1) {
                            t.html(newName);
                            $("#info").html('<span class="text-red">修改成功</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        } else {
                            t.html(name);
                            $("#info").html('<span class="text-red">修改失败</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        }
                        ;
                        //添加事件。
                        t.on('dblclick', fn1);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
//                    timeout:1000,
                    dataType: 'json'
                });
            });
        }

    </script>

    <!--单击修改导航名字-->
<script>
        $(".nname").on('dblclick', fn1);

        function fn1() {
            var t = $(this);
            var id = t.parent().find('.id').html(); //获取ID名(修改数据)
            var name = t.html();
            var inp = $('<input style="color:black;" type="text">');
            inp.val(name);
            t.html(inp);
            inp.select();
            t.unbind('dblclick');
            inp.on('blur', function () {
                var newName = $(this).val();
                $.ajax({
                    url: "{{ url('admin/nav/ajaxName') }}",
                    type: 'post',
                    data: {id: id, name: newName},
                    beforeSend: function () {
                        $("#info").html('<span class="text-red"><i class="fa fa-fw fa-spin fa-circle-o-notch"></i>正在修改中...</span>');
                        $("#info").show();
                    },
                    success: function (data) {
//                        console.log(data);
                        if (data.code == 0) {
                            t.html(name);
                            $("#info").html('<span class="text-red">用户名已经存在</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        } else if (data.code == 1) {
                            t.html(newName);
                            $("#info").html('<span class="text-red">修改成功</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        } else {
                            t.html(name);
                            $("#info").html('<span class="text-red">修改失败</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        }
                        ;
                        //添加事件。
                        t.on('dblclick', fn1);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
//                    timeout:1000,
                    dataType: 'json'
                });
            });
        }

    </script>




@stop