@extends('admin.layout')

@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">管理员列表</div>
                            </div>
                            <div id='msg' class="am-btn-group am-btn-group-xs">
                                 @if(session('msg'))
                                    <li style="color:red">{{session('msg')}}</li>
                                @endif
                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a href="{{ url('admin/admin/create') }}">
                                                    <button  class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ asset('admin/admin')}}" method="get">
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                            <input type="text" name='keyword' class="am-form-field ">
                                            <span class="am-input-group-btn">
                                                <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search"></button>
                                              </span>
                                        </div>
                                    </div>
                                </form>
                                <div class="am-u-sm-12">
                                    <table width="100%" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>名称</th>
                                                <th>头像</th>
                                                <th>状态</th>
                                                <th>角色表编号</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $v)
                                            <tr class="gradeX">
                                               
                                                <td class='ids' class="am-text-middle">{{ $v -> aid}}</td>
                                                <td class="am-text-middle">{{ $v -> aname}}</td>
                                                 <td>
                                                    <img src="{{ asset('./uploads/admin/s_') }}{{ $v->avatar }}"  class="tpl-table-line-img" alt="">
                                                </td>
                                                <td class='status' class="am-text-middle">
                                                    @if($v->status == 0)
                                                        <button type="button" class="btn bg-purple margin">禁用</button>

                                                        @else
                                                        <button type="button" class="btn bg-olive btn-flat margin">启用</button>

                                                    @endif
                                                </td>
                                                <td class="am-text-middle">
                                                    @if( $v -> roleid  == 2 )
                                                        超级管理员
                                                    @else
                                                        普通管理员
                                                    @endif
                                                    
                                                </td>
                                                <td class="am-text-middle">
                                                    <div class="tpl-table-black-operation">
                                                        <a href="{{ url('admin/admin') }}/{{$v->aid}}/edit">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="javascript:;" onclick="abc('/admin/admin/{{$v->aid}}')" class="tpl-table-black-operation-del">
                                                        <i class="am-icon-pencil"></i>删除
                                                        </a>
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="am-u-lg-12 am-cf">

                                    <div class="am-fr">
                                        {!! $data->appends($where)->render() !!}
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

    <script type="text/javascript">
            //状态操作
             $(".status").on('click', function () {
                    var t = $(this);
                    var id = $(this).parent().find('.ids').html();
                   // alert(id);
                    // 书写 ajax
                    $.ajax(
                        {
                            url:"{{ url('/admin/ajax/adminajaxstatus') }}",
                            type:'post',
                            data:{id:id},
                            success:function (data) {
                                // console.log(data);
                                if(data.status == 0)
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

        //提示信息消失
        
        $("#msg").fadeOut(6000, 'linear' ,function(){
  
        });

         //删除操作
        function abc(path) {
            var url = path;
              layer.confirm('您确定删除吗？', {
              btn: ['确定','取消'] //按钮
                }, function(){
                    $.ajax({
                           url: url, 
                           type: 'delete', 
                           success:function(data){
                                // alert(data);
                                // window.location.reload();
                                // var res = JSON.parse($data);
                                if(data.error == 0){
                                    layer.msg('删除成功', {icon: 6});
                                    window.location.reload(2000);
                                }else{
                                    layer.msg('删除失败', {icon: 5});
                                    window.location.reload(2000);
                                }
                           }
                    });
                }, function(){
                  layer.msg('确定放弃删除吗?', {
                    time: 20000, //20s后自动关闭
                    btn: ['确定', '取消']
                  });
                });
                      
        };

    </script>

</body>

</html>
@stop