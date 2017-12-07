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
                                                <th class="am-text-middle">{{ $video['vid'] }}</th>
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
                                                        <a href="{{ url('admin/carousel/create')}}?vid={{ $video['vid'] }}" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-pencil"></i> 推荐
                                                        </a>
                                                        <a href="{{ url('admin/carousel/create')}}?vid={{ $video['vid'] }}" class="tpl-table-black-operation-del">
                                                            <i class="am-icon-pencil"></i> 评论
                                                        </a>
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

@stop

    