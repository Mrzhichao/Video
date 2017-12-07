@extends('Admin.layout')
@section('content')


<div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>角色管理 ><small>角色预览</small></div>
                       
                    </div>
                    
                </div>
            
            </div>
            
            <div class="row-content am-cf">
    	

        

                <div class="row">
 
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">

                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                          

                                <div class="widget-title am-fl">
                                <a id="create" href="{{ url('admin/role/create') }}"> <button  type="button" style="color: " class="btn active  btn-success">&nbsp;角色添加&nbsp;</button></a>
                                </div>

                                <div class="widget-function am-fr">
                                <form action="{{ url('admin/role') }}" method="get">
                                <input style="color:#a2b;" type="text" name="aname"  placeholder="角色关键字">
                               <button class="btn   btn-success" id="serach" >搜索</button>
                                </form>
                                </div>
                            </div>
                            <form id="form" action="upload" method="post" enctype="multipart/form-data">
                                          <input type="file"  name="vimg" id="upload" style="display: none;">

                                    </form>
                            <div class="widget-body  widget-body-lg am-fr">
                            
                                <table width="100%" id="example-r" class="am-table am-table-compact tpl-table-black ">
                                    <thead>
                                        <tr>

                                        	<th>角色编号</th>
                                            <th>角色名称</th>
                                            <th>角色描述</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $k => $v)
                                        <tr class="gradeX">
                                        	<td>{{$v ->rid}}</td>

                                            <td class="id">{{ $v -> rname }}</td>
                                            <td>{{ $v -> rdesc }}</td>
                                            
                                               <td> <div class="tpl-table-black-operation">
                                                <a href="{{ url('admin/role/auth') }}/{{$v->rid}}">
                                                            <i  class="am-icon-pencil"></i> 授权
                                                        </a>
                                                    <a id="edit"  href="{{ url('admin/role') }}/{{$v->rid}}/edit">
                                                        <i  class="am-icon-pencil"></i> 编辑
                                                    
                                                    </a>
                                                    <a class="tpl-table-black-operation-del del" href="javascript:void(0);" onclick="sendBtn('role/{{ $v->rid }}')">
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
                                            {!! $data->appends($where)->render() !!}
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



@stop