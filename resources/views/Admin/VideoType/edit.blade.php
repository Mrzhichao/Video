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

                                <form action="{{ url('admin/videotype/'.$videotype['vtid']) }}" class="am-form tpl-form-line-form" method='post' enctype="multipart/form-data"> 
                                    {{ csrf_field() }}
                                    <input type="hidden" name='_method' value="put">
               
                                    <div class="am-form-group">
                                        <label for="" class="am-u-sm-3 am-form-label">视频类别名称 
                                            <span class="tpl-form-line-small-title">Name</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name='vtname' value="" placeholder="{{ $videotype['vtname'] }}">
                                            <small>视频类别名称5-8字左右。</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">发布者
                                            <span class="tpl-form-line-small-title">Uname</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="tpl-form-input" id="user-name" name='uname' value="" placeholder="{{ $videotype['uname'] }}">
                                            <small>请填写发布者1-5字左右。</small>
                                        </div>
                                    </div>


                                    <div class="am-form-group">
                                        <label for="user-email" class="am-u-sm-3 am-form-label">修改时间
                                        <span class="tpl-form-line-small-title">Time</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" class="am-form-field tpl-form-no-bg" name='editTime' placeholder="{{ date('Y-m-d',$videotype['editTime']) }}" data-am-datepicker="" readonly="">
                                            <small>修改时间必填</small>
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-intro" class="am-u-sm-3 am-form-label">理由
                                         <span class="tpl-form-line-small-title">Reason</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <textarea class="" rows="10" name='reason' value="{{ $videotype['reason'] }}" id="user-intro" placeholder="{{ $videotype['reason'] }}"></textarea>
                                        </div>
                                    </div>        


                                    <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">视频分类
                                            <span class="tpl-form-line-small-title">VideoId</span>
                                        </label>
                                        <div class="am-u-sm-9">
                                            <select data-am-selected="{searchBox: 1}" name='pid' style="display: none;">
                                                <option value="0" selected>根分类</option>
                                                @foreach ($types as $type)
                                                    @if ( $type['vtid'] == $videotype['pid'] )
                                                       <option value="{{ $type['vtid'] }}" selected>{{ $type['vtname'] }}</option>
                                                    @else
                                                      <option value="{{ $type['vtid'] }}" >{{ $type['vtname'] }}</option>
                                                   @endif
                                                @endforeach
                                            </select>

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

@stop
