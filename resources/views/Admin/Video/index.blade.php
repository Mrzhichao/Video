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
                                <div class="widget-title  am-cf">视频列表</div>
                            </div>
                            <div class="widget-body  am-fr">

                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a class="am-btn am-btn-default am-btn-success" href="{{ url('admin/video/create') }}">新增</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <form action="{{ url('admin/video')}}" method="get">
                                
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}" id='type' name='type' >
                                          <option value="0">所有类型</option>
                                          @foreach ($types as $type)
                                            @if( !empty($where) )
                                                  @if( $type['vtid'] == $where['type'])
                                                    <option value="{{ $type['vtid'] }}" selected >{{ $type['vtname'] }}</option>
                                                  @else 
                                                    <option value="{{ $type['vtid'] }}">{{ $type['vtname'] }}</option>
                                                  @endif
                                            @endif    
                                          @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                         @if( !empty($where) )
                                            <input type="text" class="am-form-field" name='search' value="" placeholder="{{$where['search']}}">
                                        @else 
                                            <input type="text" class="am-form-field" name='search' value="" placeholder="关键字|视频名称">
                                        @endif
                                        <span class="am-input-group-btn">
                                        <button class="am-btn  am-btn-default am-btn-success tpl-table-list-field am-icon-search" type="submit"></button>
                                      </span>
                                    </div>
                                </div>
                            </form>

                                <div class="am-u-sm-12">
                                    <table width="100%" border="1px solid red" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>
                                                <th width="5%">排序</th>
                                                <th width="5%">ID</th>
                                                <th width="5%">视频名称</th>
                                                <th width="5%">关键字</th>
                                                <th width="5%">视频地址</th>
                                                <th width="5%">是否vip</th>
                                                <th width="10%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($videos as $ob)
                                            <tr class="gradeX" id="video_vid_{{ $ob->vid }}">
                                                <th class="am-text-middle">
                                                    <input style="width:30px;color:blue" type="text" onchange="changeOrder(this,{{$ob->vid}})" value="{{$ob->type_order}}">
                                                </th>
                                                <th class="am-text-middle">{{ $ob->vid }}</th>
                                                <th class="am-text-middle">{{ $ob->vname }}</th>
                                                <th class="am-text-middle">{{ $ob->keywords }}</th>
                                                <th class="am-text-middle">{{ $ob->resourceSrc }}</th>
                                                <th class="am-text-middle">
                                                @if($ob->isvip == 0)
                                                是
                                                @else
                                                否
                                                @endif
                                                </th>
                                                <th class="am-text-middle">
                                                    <div id='div1' class="tpl-table-black-operation">
                                                        <a href="javascript:;" onclick="videoDel( '{{ $ob->vid }} ') " class="tpl-table-black-operation-del" id='del'>
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>   
                                                        <a href="{{ url('admin/video/'.$ob->vid) }}" class="tpl-table-black-operation-del" id='del'>
                                                            <i class="am-icon-pencil"></i> 详情
                                                        </a>
                                                        <a href="{{ url('admin/videoreview/'.$ob->vid) }}" class="tpl-table-black-operation-del" id='del'>
                                                            <i class="am-icon-pencil"></i> 查看评论
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if(!empty($where))
                                <div class="am-u-lg-12 am-cf">
                                    <div>
                                        <ul class="am-pagination tpl-pagination">
                                            <center>
                                               {!! $videos->appends($where)->render() !!}
                                            </center>
                                        </ul>
                                    </div>
                                </div>
                                @endif
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

    function videoDel(vid){
        layer.confirm('您确认删除吗？', {
            btn: ['确认','取消']
            }, function(){
                $.ajax({
                    type: 'DELETE',
                    url: "{{ url('admin/video') }}/"+vid,
                    success: function(data) {
                        if(data.error == 0){
                           layer.msg(data.msg, {icon: 6});
                           var sel = $('#video_vid_' + vid);
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
    function changeOrder(obj,vid){
        //获取当前需要排序的记录的ID,vtid
        //获取当前记录的排序文本框中的值
        var type_order = $(obj).val();
        $.post("{{url('admin/video/changeorder')}}",{'_token':"{{csrf_token()}}","vid":vid,"type_order":type_order},function(data){
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

<script type='text/javascript'>
    $(document).ready(function(){
        $("#type").click(function(){
            $typeid=$('#type').val();
                $.ajax({
                    url: '/admin/video',
                    type: 'get',
                    data: {type:type},
                    success: function(data){

                        if(data['ServerStatus']=='200'){
                            // 如果成功
                            $('#pic').attr('src', '/Uploads/Video/'+data['ResultData']);
                            $('input[name=pic]').val(data);
                            $(obj).off('change');
                        }else{
                            // 如果失败
                            alert(data['ResultData']);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        var number = XMLHttpRequest.status;
                        var info = "错误号"+number+"收索失败!";
                        alert(info);
                    },
                    async: true
                });
      });
    });
</script>
@stop

    