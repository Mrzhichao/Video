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
                                <div class="widget-title  am-cf">视频详情列表</div>

                            </div>
                            <div class="widget-body  am-fr">
                                <div class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                                    <div class="am-form-group">
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <a class="am-btn am-btn-default am-btn-success" href="{{ url('admin/video')}}">返回</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="am-u-sm-12">
                                    <table width="100%" border="1px solid red" class="am-table am-table-compact am-table-striped tpl-table-black ">
                                        <thead>
                                            <tr>  
                                                <th width="5%">ID</th>
                                                <th width="10%">海报</th>
                                                <th width="10%">上传者</th>
                                                <th width="10%">视频类型</th>
                                                <th width="10%">上映时间</th>
                                                <th width="10%">下映时间</th>
                                                <th width="5%">播放量</th>
                                                <th width="5%">下载量</th>
                                                <th width="5%">评分</th>
                                                <th width="25%">操作</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="gradeX" id="video_vid_{{ $video['vid'] }}">
                                                <th class="am-text-middle">{{ $video['aid'] }}</th>
                                                <th>
                                                    <img src="{{ asset('/Uploads/Video/'.$video->logo) }}" class="tpl-table-line-img" alt="">
                                                </th>
                                                <th class="am-text-middle">{{ $video['uname'] }}</th>
                                                <th class="am-text-middle">{{ $video['types']['vtname'] }}</th>
                                                <th class="am-text-middle">{{ date('Y-m-d',$video['publicTime']) }}</th>
                                                <th class="am-text-middle">{{ date('Y-m-d',$video['projectionTime']) }}</th>
                                                <th class="am-text-middle">{{ $video['numOfViewed'] }}</th>
                                                <th class="am-text-middle">{{ $video['numOfDownload'] }}</th>
                                                <th class="am-text-middle">{{ $video['vscores'] }}</th>
                                                <th class="am-text-middle">
                                                    <div id='div1' class="tpl-table-black-operation">
                                                        <a href="{{ url('admin/video/'.$video['vid'].'/edit') }}" id='edit'>
                                                            <i class="am-icon-pencil"></i> 编辑
                                                        </a>
                                                        <a href="{{ url('admin/vad/create')}}?vid={{ $video['vid'] }}" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-pencil"></i> 广告
                                                        </a>
                                                        <a href="{{ url('admin/carousel/create')}}?vid={{ $video['vid'] }}" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-pencil"></i> 轮播
                                                        </a>
                                                        @if(empty($em))
                                                        <a id="tj" href="javascript:;" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-pencil"></i> 推荐
                                                        </a>
                                                        <a id="hidden" style="display: none;" href="javascript:;" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-pencil"></i> 取消
                                                        </a>
                                                        @else
                                                        <a id="tj"
                                                        style="display: none;" 
                                                         href="javascript:;" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-pencil"></i> 推荐
                                                        </a>
                                                        <a id="hidden" href="javascript:;" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-pencil"></i> 取消
                                                        </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        
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
</body>
</html>

<!-- 推荐页 -->
<script type="text/javascript">

//点击按钮 发送推荐
$('#tj').on('click',function()
    {
        //ajax发送视频编号到推荐表

    $.ajax({
        type:'post',
        url:'/home/video/tj',
        data:{vid:"{{ $video['vid'] }}"},
        success:function(data)
        {
            layer.alert(data, {
            skin: 'layui-layer-lan'
            ,closeBtn: 0
            ,anim: 2 //动画类型
            });
            if(data == '已推荐'){
            //把取消按钮显示出来
                $('#tj').css('display','none');
                $('#hidden').css('display','');
            }else if(data == '影片已经过期'){
                $('#tj').css('display','none');
                $('#hidden').css('display','');
            }
        }

    });

    });



</script>


<!-- 推荐页 -->
<script type="text/javascript">

//点击按钮取消推送
$('#hidden').on('click',function()
    {
        //ajax发送视频编号到推荐表

    $.ajax({
        type:'post',
        url:'/home/video/qx',
        data:{vid:"{{ $video['vid'] }}"},
        success:function(data)
        {
            layer.alert(data, {
            skin: 'layui-layer-lan'
            ,closeBtn: 0
            ,anim: 2 //动画类型
            });
            if(data == '已取消'){
            //把推荐按钮显示出来
                $('#hidden').css('display','none');
                $('#tj').css('display','');
            }else if(data == '请不要重复取消'){
                $('#hidden').css('display','none');
                $('#tj').css('display','');
            }

        }

    });

    });



</script>

@stop

    