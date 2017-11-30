@extends('admin.layout')

@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">
            <div class="row-content am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title  am-cf">文章列表</div>
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
                                                <a href="{{ url('admin/user/create') }}">
                                                    <button  class="am-btn am-btn-default am-btn-success"><span class="am-icon-plus"></span> 新增</button>
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ asset('admin/user')}}" method="get">
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
                                                <th>性别</th>
                                                <th>头像</th>
                                                <th>手机号</th>
                                                <th>email</th>
                                                <th>状态</th>
                                                <th>角色表编号</th>
                                                <th>操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $v)
                                            <tr class="gradeX">
                                               
                                                <td class='ids' class="am-text-middle">{{ $v -> uid}}</td>
                                                <td class="am-text-middle">{{ $v -> uname}}</td>
                                                <td class="am-text-middle">{{ $v -> sex}}</td>
                                                 <td>
                                                    <img src="{{ asset('./uploads/user/s_') }}{{ $v->avatar }}"  class="tpl-table-line-img" alt="">
                                                </td>
                                                <td class="am-text-middle">{{ $v -> phone}}</td>
                                                <td class="am-text-middle">{{ $v -> email}}</td>
                                                <td class='status' class="am-text-middle">
                                                    @if($v->status == 0)
                                                        <button type="button" class="btn bg-purple margin">禁用</button>

                                                        @else
                                                        <button type="button" class="btn bg-olive btn-flat margin">启用</button>

                                                    @endif
                                                </td>
                                                <td class="am-text-middle">
                                                    @if( $v -> roleid  == 1 )
                                                        普通用户
                                                    @elseif(  $v -> roleid  == 4 )
                                                        vip用户
                                                    @else
                                                        广告商
                                                    @endif
                                                    
                                                </td>
                                                <td class="am-text-middle">
                                                    <div class="tpl-table-black-operation">
                                                        <a href="{{ url('admin/user') }}/{{$v->uid}}/edit">
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="javascript:;" onclick="abc('/admin/user/{{$v->uid}}')" class="tpl-table-black-operation-del">
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
    <script src="{{ asset('/Admin/assets/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('/Admin/assets/js/app.js') }}"></script>
    
    <script type="text/javascript">
            //状态操作
             $(".status").on('click', function () {
                    var t = $(this);
                    var id = $(this).parent().find('.ids').html();
                   // alert(id);
                    // 书写 ajax
                    $.ajax(
                        {
                            url:"{{ url('/admin/ajax/ajaxstatus') }}",
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
                $.ajax({
                       url: url, 
                       type: 'delete', 
                       success:function(data){
                            alert(data);
                            window.location.reload();
                       }
                });
                  
              };
    

    </script>

</body>

</html>
@stop