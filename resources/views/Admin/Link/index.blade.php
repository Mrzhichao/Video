@extends('Admin.layout')

@section('content')

   <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 友情链接 <small></small></div>
                        <p class="page-header-description">Link</p>
                    </div>
                    <div class="am-u-lg-3 tpl-index-settings-button">
                        <button type="button" class="page-header-button"><span class="am-icon-paint-brush"></span> 设置</button>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">


                <div class="row">


                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">添加链接</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>

                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul style="color:red;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                             @endif

                            <div class="widget-body am-fr">   
                                <form action="{{ url('admin/sysconfig') }}" method="post"> 
                                   <table class="add_tab" style="background:#4B5357;color:white;">
                                        <tr>
                                            <th >排序</th>
                                            <th >ID</th>
                                            <th >友情链接名</th>
                                            <th >提示信息</th>
                                            <th >提示url</th>
                                            <th >操作</th>
                                        </tr>

                                    @foreach($links as $k=>$v)
                                        <tr id="links_link_id_{{ $v->link_id }}">
                                            <th>
                                                <input type="text" style="width:30px;color:blue" onchange="changeOrder(this,{{$v->link_id}})" value="{{$v->link_order}}">
                                            </th>
                                            <th >{{$v->link_id}}</th>
                                            <th >{{$v->link_name}}</th>
                                            <th >{{$v->link_title}}</th>
                                            <th >{{$v->link_url}}</th>
                                            <th>
                                                <a href="{{url('admin/link/'.$v->link_id.'/edit')}}">修改</a>
                                                <a href="javascript:;" onclick="LinkDel( {{$v->link_id}} )">删除</a>
                                            </th>
                                        </tr>
                                    @endforeach
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</body>
</html>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
       
<script type='text/javascript'>

    function LinkDel(link_id){
        layer.confirm('您确认删除吗？', {
            btn: ['确认','取消']
            }, function(){
                $.ajax({
                    type: 'DELETE',
                    url: "{{ url('admin/link') }}/"+link_id,
                    success: function(data) {
                        if(data.error == 0){
                           layer.msg(data.msg, {icon: 6});
                           var sel = $('#links_link_id_' + link_id);
                           sel.remove();
                        }else{
                           layer.msg(data.msg, {icon: 5});
                           var t=setTimeout("location.href = location.href;",2000);
                        }
                    },
                    dataType: 'json',
                 });
            }, function(){});
    }

    //排序
    function changeOrder(obj,link_id){
        //获取当前需要排序的记录的ID,vtid
        //获取当前记录的排序文本框中的值
        var link_order = $(obj).val();

        $.post("{{url('admin/link/changeorder')}}",{'_token':"{{csrf_token()}}","link_id":link_id,"link_order":link_order},function(data){
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