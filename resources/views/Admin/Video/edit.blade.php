@extends('Admin.layout')

@section('content')
   <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 表单 <small>Amaze UI</small></div>
                        <p class="page-header-description">Active Video</p>
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
                                <div class="widget-title am-fl">视频修改</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
<!-- 
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul style="color:red;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                             @endif
 -->
                            <div class="widget-body am-fr">   

                                <form action="{{ url('admin/video/'.$video['vid']) }}" class="am-form tpl-form-line-form" method='post' enctype="multipart/form-data" id="art_form"> 
                                    {{ csrf_field() }}
                                    {{method_field('put')}}
                                    <!-- <input type="hidden" name='_method' value="put"> -->
               
                                    <div class="am-form-group">
                                        <label for="" class="am-u-sm-3 am-form-label">视频名称 
                                            <span class="tpl-form-line-small-title">Title</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name='vname' value="" placeholder="{{ $video['vname'] }}">
                                            <small>请填写1-5字左右的视频名称</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">发布者
                                            <span class="tpl-form-line-small-title">Author</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name='uname' value="" placeholder="{{ $video['uname'] }}">
                                            <small>请填写1-5字左右的发布者</small>
                                        </div>
                                    </div>

                                     <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">视频路径
                                             <span class="tpl-form-line-small-title">Title</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name='resourceSrc' value="" class="tpl-form-input" id="user-name" placeholder="{{ $video['resourceSrc'] }}">
                                            <small>请填写完整的视频路径</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-email" class="am-u-sm-3 am-form-label">上映时间
                                        <span class="tpl-form-line-small-title">Time</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name='publicTime' class="am-form-field tpl-form-no-bg" placeholder="{{ date('Y-m-d',$video['publicTime']) }}" data-am-datepicker="" readonly="">
                                            <small>上映时间为必填项</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-email" class="am-u-sm-3 am-form-label">下映时间
                                        <span class="tpl-form-line-small-title">Time</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="am-form-field tpl-form-no-bg" name='projectionTime' placeholder="{{ date('Y-m-d',$video['projectionTime']) }}" data-am-datepicker="" readonly="">
                                            <small>下映时间必填项</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">视频简介</label>
                                        <div class="am-u-sm-9">
                                            <textarea class="" rows="10" name='introduction' value="" id="user-intro" placeholder="{{ $video['introduction'] }}"></textarea>
                                        </div>
                                    </div>              

                                     <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">视频关键词</label>
                                        <div class="am-u-sm-9">
                                            <input type="text" rows="10" name='keywords' id="user-intro" value="" placeholder="{{ $video['keywords'] }}">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">海报</label>
                                        <div class="am-u-sm-9">
                                            <img  src="{{ asset('/Uploads/Video/'.$video->logo) }}" style="width:80px;cursor: pointer;"/>
                                            <img src="{{ asset('Admin/img/file.png') }}" id="pic" style="width:80px;cursor: pointer;"/>
                                            <input type="file" name="logo" id="photo_upload" style="display: none;" />
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">视频分类
                                            <span class="tpl-form-line-small-title">VideoId</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <select data-am-selected="{searchBox: 1}" name='typeid' style="display: none;">
                                                <option value="">所有类型</option>
                                                @foreach ($types as $type)

                                                    <option value="{{ $type->vtid }}">{{ $type->vtname }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">是否是Vip</label>
                                        <div class="am-u-sm-9">
                                            <div class="tpl-switch">
                                                <input type="checkbox" name='isVip' class="ios-switch bigswitch tpl-switch-btn" value="0">
                                                <div class="tpl-switch-btn-view">
                                                <div></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <input type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success" value='提交' />
                                        </div>
                                    </div>
                               
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

    $('#pic').on('click', function(){
        $('#photo_upload').trigger('click');
        $('#photo_upload').on('change', function(){
            var obj = this;
            //用整个from表单初始化FormData
            var formData = new FormData($('#art_form')[0]);
            $.ajax({
                url: '/admin/video/upload',
                type: 'post',
                data: formData,
                // 因为data值是FormData对象，不需要对数据做处理
                processData: false,
                contentType: false,
                beforeSend:function(){
                    // 菊花转转图
                    $('#pic').attr('src', '/Uploads/load.gif');
                },
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
                    var info = "错误号"+number+"文件上传失败!";
                    // 将菊花换成原图
                    $('#pic').attr('src', '/Admin/img/file.png');
                    alert(info);
                },
                async: true
            });
        });
    });

</script>

@stop