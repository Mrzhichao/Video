@extends('admin.layout')

@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">评论详情</div>
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
                                                <a href="{{ url('admin/video') }}">
                                                    <button  class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 返回</button>
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ asset('admin/videoreply/'.$id)}}" method="get">
                                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                        <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                            <input type="text" name='keyword' class="am-form-field " placeholder="请输入视频评论的标题">
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
                                                <th>回复评论者昵称</th>
                                                <th>回复评论视频的名称</th>
                                                <th>回复评论内容</th>
                                                <th>回复评论时间</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $k =>$v)
                                        <tr class="gradeX">
                                                <td class='ids' class="am-text-middle">{{ $v -> rid }}</td>
                                                <td class="am-text-middle">{{ $v-> nickname }}</td>
                                                <td class="am-text-middle">{{ $v ->vname }}</td>
                                                <td class="am-text-middle">{{ $v -> rcontent}}</td>
                                                <td class="am-text-middle">{{ $v -> rtime}}</td>
                                                <td class="am-text-middle">
                                                    <div class="tpl-table-black-operation">
                                                        <a href="javascript:;" onclick="abc('/admin/videoreply/{{$v->rid}}')" class="tpl-table-black-operation-del">
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
    <script src="{{ asset('/Admin/assets/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('/Admin/assets/js/app.js') }}"></script>
    
    <script type="text/javascript">
        //提示信息消失
        
        $("#msg").fadeOut(6000, 'linear' ,function(){
  
        });

        //删除操作
        function abc(path) {
            var url = path;
            // alert(111);
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