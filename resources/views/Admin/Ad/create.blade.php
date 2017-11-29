@extends('Admin.layout')


@section('content')

<div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                   <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>广告管理 -><small>广告添加</small></div>
                        
                    </div>
                    
                </div>

            </div>

            <div class="row-content am-cf">


               
                
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                           
                            <div class="widget-body am-fr">
								<!-- 报错信息 -->
								 @if (count($errors) > 0)
						            <div class="alert alert-danger">
						                <ul style="color:#cf4;">
						                @foreach ($errors->all() as $error)
						                    <li>{{ $error }}</li>
						                @endforeach
						                </ul>
						            </div>
						        @endif

					
                                <form action="{{ url('admin/ad/') }}" method="post" enctype="multipart/form-data" class="am-form tpl-form-border-form">

								<div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label am-text-left" for="user-name">添加者<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" readonly=""    id="user-name" value="{{$aname}}" class="tpl-form-input am-margin-top-xs">
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" name="aid" value="{{ $aid }}">
                                    <div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label am-text-left" for="user-name">请对广告做出描述 <span class="tpl-form-line-small-title">dsec</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" placeholder="广告描述" name="adesc" id="user-name" class="tpl-form-input am-margin-top-xs">
                                           
                                        </div>
                                    </div>
                                       <div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label am-text-left" for="user-name">请输入广告链接 <span class="tpl-form-line-small-title">link</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" placeholder="链接地址" name="acontent" id="user-name" class="tpl-form-input am-margin-top-xs">
                                        
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label am-text-left" for="user-email">开始时间 <span class="tpl-form-line-small-title">startTime</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" id="startTime" name="startTime" readonly="" data-am-datepicker="" placeholder="点击输入框填入" class="am-form-field tpl-form-no-bg am-margin-top-xs">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label am-text-left" for="user-email">结束时间 <span class="tpl-form-line-small-title">endTime</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" id="endTime" name="endTime" readonly="" data-am-datepicker="" placeholder="点击输入框填入" class="am-form-field tpl-form-no-bg am-margin-top-xs">
                                        </div>
                                    </div>



                                    
                                 
    <i class="am-icon-cloud-upload"></i> 请上传广告图片
                                                <input type="file" id="file" name="aimg"  id="doc-form-file">
                                           


                                    <div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label  am-text-left" for="user-weibo">共计金额 <span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" readonly id="jine" name="aprice" placeholder=点我 快点我"" class="am-margin-top-xs" id="user-weibo">
                                            <div>

                                            </div>
                                        </div>
                                    </div>

                                    

                                   {{ csrf_field() }}

                                    <div class="am-form-group">
                                        <div class="am-u-sm-12 am-u-sm-push-12">
                                            <button class="am-btn am-btn-primary tpl-btn-bg-color-success " type="submit">提交</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

<script type="text/javascript">
	//点击结束时间获取开始时间的值
	$('#jine').on('click',function()
		{
			//获取开始时间的时间戳
			var startTime = $('#startTime').val();
			var timestamp = Date.parse(new Date(startTime));
			startstamp = timestamp / 1000;
			//获取结束时间的时间戳
			var endTime = $('#endTime').val();
			var timestamp = Date.parse(new Date(endTime));
			endstamp = timestamp / 1000;

			//判断时间是不是没选
			if(!startstamp){
				alert('请输入开始时间');
				return;
			}
			if(!endstamp){
				alert('请输入结束时间');
				return;
			}

			//计算几天  多少钱
			//天数*10
			if(endstamp > startstamp){

				var time = endstamp - startstamp;
				time = Math.ceil(time/(60*60*24));
				var jine = time * 10;

				$('#jine').val(jine);


			}else{
				alert('请输入有效时间!!');
				return;
			}
			




		});
	//重置金额值
	$('#jine').val('');

</script>




@stop