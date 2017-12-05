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
                                <div class="widget-title am-fl">视频添加</div>
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

                                <form action="{{ url('admin/video') }}" id="art_form" class="am-form tpl-form-line-form" method='post' enctype="multipart/form-data"> 
                                          {{ csrf_field() }}
                                    <div class="am-form-group">
                                        <label for="" class="am-u-sm-3 am-form-label">视频名称 
                                            <span class="tpl-form-line-small-title">Title</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name='vname' value="{{ old('vname') }}" placeholder="请输入视频名称">
                                            <small>请填写视频名称5-8字左右。</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">发布者
                                            <span class="tpl-form-line-small-title">Author</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name='uname' value="{{ old('uname') }}" placeholder="请输入上传者">
                                            <small>请填写发布者1-5字左右。</small>
                                        </div>
                                    </div>

                                     <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">视频路径
                                             <span class="tpl-form-line-small-title">Title</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name='resourceSrc' value="{{ old('resourceSrc') }}" class="tpl-form-input" id="user-name" placeholder="请输入标题文字">
                                            <small>请填写视频路径。</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-email" class="am-u-sm-3 am-form-label">上映时间
                                        <span class="tpl-form-line-small-title">Time</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name='publicTime' class="am-form-field tpl-form-no-bg" placeholder="{{ date('Y-m-d H:i:s') }}" data-am-datepicker="" readonly="">
                                            <small>上映时间为必填</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-email" class="am-u-sm-3 am-form-label">下映时间
                                        <span class="tpl-form-line-small-title">Time</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="am-form-field tpl-form-no-bg" name='projectionTime' placeholder="{{ date('Y-m-d H:i:s') }}" data-am-datepicker="" readonly="">
                                            <small>下映时间必填</small>
                                        </div>
                                    </div>


                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">视频简介</label>
                                        <div class="am-u-sm-9">
                                            <textarea class="" rows="10" name='introduction' value="{{ old('introduction') }}" id="user-intro" placeholder="请输入视频简介">{{ old('introduction') }}</textarea>
                                        </div>
                                    </div>              

                                     <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">视频关键词</label>
                                        <div class="am-u-sm-9">
                                            <input type="text" rows="10" name='keywords' id="user-intro" value="{{ old('keywords') }}" placeholder="请输入视频关键词">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-weibo" class="am-u-sm-3 am-form-label">封面图
                                            <span class="tpl-form-line-small-title">Images</span>
                                         </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" size="50" id="art_thumb" name="art_thumb">
                                            <input id="file_upload" name="logo" type="file" multiple="true" >
                                            <br>
                                            <img src="" id="img1" alt="" style="width:80px;height:80px">
                                            <script type="text/javascript">
                                                $(function () {
                                                    $("#file_upload").change(function () {
                                                        $('img1').show();
                                                        uploadImage();
                                                    });
                                                });

                                                function uploadImage() {
                                                    // 判断是否有选择上传文件
                                                    var imgPath = $("#file_upload").val();
                                                    if (imgPath == "") {
                                                        alert("请选择上传图片！");
                                                        return;
                                                    }
                                                    //判断上传文件的后缀名
                                                    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                                    if (strExtension != 'jpg' && strExtension != 'gif'
                                                        && strExtension != 'png' && strExtension != 'bmp') {
                                                        alert("请选择图片文件");
                                                        return;
                                                    }
                                                    var formData = new FormData($('#art_form')[0]);
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/admin/video/upload",
                                                        data: formData,
                                                        async: true,
                                                        cache: false,
                                                        contentType: false,
                                                        processData: false,
                                                        success: function(data) {
                                                           $('#img1').attr('src','/Uploads/'+data);
                                                            $('#img1').show();
                                                            $('#art_thumb').val('/Uploads/'+data);
                                                        },
                                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                                            alert("上传失败，请检查网络后重试");
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">视频分类
                                            <span class="tpl-form-line-small-title">VideoId</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <select data-am-selected="{searchBox: 1}" name='typeid' style="display: none;">
                                                <option value="option1">所有类型</option>
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
    <script src="{{ asset('Admin/assets/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/amazeui.datatables.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Admin/assets/js/app.js') }}"></script>

    <script src="{{ asset('/Admin/assets/js/jquery.min.js') }}"></script>

</body>

</html>
@stop



