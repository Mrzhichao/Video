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
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-3">
                                    <div class="am-form-group tpl-table-list-select">
                                        <select data-am-selected="{btnSize: 'sm'}">
                                          <option value="option1">所有类型</option>
                                          @foreach ($types as $type)
                                          <option value="{{ $type['vtid'] }}">{{ $type['vtname'] }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>

                            <form action="{{ url('admin/video')}}" method="get">
                                <div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
                                    <div class="am-input-group am-input-group-sm tpl-form-border-form cl-p">
                                        <input type="text" class="am-form-field" name='search' value="{{ $where['search'] }}" placeholder="上传者|视频名称">
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
                                                <th width="5%">ID</th>
                                                <th width="5%">排序</th>
                                                <th width="5%">名称</th>
                                                <th width="5%">Logo</th>
                                                <th width="5%">上传者</th>
                                                <th width="5%">视频类型</th>
                                                <th width="10%">上映时间</th>
                                                <th width="10%">下映时间</th>
                                                <th width="5%">关键字</th>
                                                <th width="5%">地址</th>
                                                <th width="10%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach ($videos as $ob)
                                            <tr class="gradeX" id="video_vid_{{ $ob->vid }}">
                                                <th class="am-text-middle">{{ $ob->vid }}</th>
                                                <th class="am-text-middle">
                                                    <input style="width:30px;color:blue" type="text" onchange="changeOrder()" value="{{$ob->typeid}}">
                                                </th>
                                                <th class="am-text-middle">{{ $ob->vname }}</th>
                                                <th>
                                                    <img src=" {{ asset('/Uploads/Video/'.$ob->logo) }}" class="tpl-table-line-img" alt="">
                                                </th>

                                                <th class="am-text-middle">{{ $ob->uname }}</th>
                                                <th class="am-text-middle">{{ $ob->types['vtname'] }}</th>
                                                <th class="am-text-middle">{{ date('Y-m-d',$ob->publicTime) }}</th>
                                                <th class="am-text-middle">{{ date('Y-m-d',$ob->projectionTime) }}</th>
                                                <th class="am-text-middle">{{ $ob->keywords }}</th>
                                                <th class="am-text-middle">{{ $ob->resourceSrc }}</th>
                                                <th class="am-text-middle">
                                                    <div id='div1' class="tpl-table-black-operation">
                                                        <a href="{{ url('admin/video/'.$ob->vid.'/edit') }}" id='edit'>
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="javascript:;" onclick="videoDel( '{{ $ob->vid }} ') " class="tpl-table-black-operation-del" id='del'>
                                                            <i class="am-icon-trash"></i> 删除
                                                        </a>
                                                        <a href="{{ url('admin/vad/create')}}?vid={{ $ob->vid }}" class="tpl-table-black-operation-del" id='del'>
                                                            <i class="am-icon-pencil"></i> 广告
                                                        </a>
                                                        <a href="{{ url('admin/carousel/create')}}?vid={{ $ob->vid }}" class="tpl-table-black-operation-del" id='del'>
                                                            <i class="am-icon-pencil"></i> 轮播
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
                                               {!! $videos->appends($where)->render() !!}
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


    <script src="{{ asset('/Admin/assets/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('/Admin/assets/js/app.js') }}"></script>

    <script src="{{ asset('/Admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/layer/layer.js') }}"></script>

</body>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
       
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
        
</script>

</html>
@stop

    