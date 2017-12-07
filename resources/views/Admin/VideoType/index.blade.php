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
                                <div class="widget-title  am-cf">视频类别列表</div>

                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">

                                                <a class="am-btn am-btn-default am-btn-success" href="{{ url('admin/videotype/create') }}">新增</a>
                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}">
                                          <option value="option1">所有类型</option>
                                          @foreach ($types as $type)
                                          <option value="{{ $type->vtid }}">{{ $type->vtname }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field" name='search' value="" >
                                        <span class="am-input-group-btn">
                                        <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="button"></button>
                                      </span>
                                    </div>
                                </div>

                                <div class="am-u-sm-12">
                                    <table width="100%" border="1px solid red" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>排序</th>
                                                <th>名称</th>
                                                <th>上传者</th>
                                                <th>添加时间</th>
                                                <th>修改时间</th>
                                                <th width="20%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($types as $ob)
                                            <tr class="gradeX" id="videotype_vtid_{{ $ob->vtid }}">
                                                <th class="am-text-middle">{{ $ob->vtid }}</th>
                                                <th class="am-text-middle">
                                                    <input type="text" style="width:30px;color:blue" onchange="changeOrder(this,{{$ob->vtid}})" value="{{$ob->order_sort}}">
                                                </th>
                                                <th class="am-text-middle">{{ $ob->vtname }}</th>
                                                <th class="am-text-middle">{{ $ob->uname }}</th>
                                                <th class="am-text-middle">{{ date('Y-m-d',$ob->addTime) }}</th>
                                                <th class="am-text-middle">{{ date('Y-m-d',$ob->editTime) }}</th>
                                                <th class="am-text-middle">
                                                    <div id='div1' class="tpl-table-black-operation">

                                                        <a href="{{ url('admin/video/create') }}?id={{ $ob->vtid }}" id='add'>
                                                            <i class="am-icon-pencil"></i> 添加视频
                                                        </a>

                                                        <a href="{{ url('admin/videotype/'.$ob->vtid) }}" id='show'>
                                                            <i class="am-icon-pencil"></i> 所有视频
                                                        </a>

                                                        <a href="{{ url('admin/videotype/'.$ob->vtid.'/edit') }}" id='edit'>
                                                            <i class="am-icon-pencil"></i> 修改
                                                        </a>

                                                        <a href="javascript:;" onclick="typeDel( '{{ $ob->vtid }} ') " class="tpl-table-black-operation-del" id='del'>
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>   

                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="am-u-lg-12 am-cf">
                                    <div>
                                        <ul class="am-pagination tpl-pagination">
                                            <center>
                                            </center>
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
</body>
</html> 

<script type='text/javascript'>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script type='text/javascript'>

    //排序
    function changeOrder(obj,vtid){
        //获取当前需要排序的记录的ID,vtid
        //获取当前记录的排序文本框中的值
        var order_sort = $(obj).val();

        $.post("{{url('admin/videotype/changeorder')}}",{'_token':"{{csrf_token()}}","vtid":vtid,"order_sort":order_sort},function(data){
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

    function typeDel(vtid){
        layer.confirm('您确认删除吗？', {
            btn: ['确认','取消']
            }, function(){
                $.ajax({
                    type: 'DELETE',
                    url: "{{ url('admin/videotype') }}/"+vtid,
                    success: function(data) {
                        // alert(data);
                        if(data.error == 0){
                           layer.msg(data.msg,{icon: 6});
                           var sel = $('#videotype_vtid_' + vtid);
                           sel.remove();
                        }else if(data.error == 1){
                           layer.msg(data.msg, {icon: 5});
                           var t=setTimeout("location.href = location.href;",2000);
                        }else{
                           layer.msg(data.msg, {icon: 5});
                           var t=setTimeout("location.href = location.href;",2000);
                        }
                    },
                    dataType: 'json',
                 });
            }, function(){});
    }
        
</script>

@stop

    