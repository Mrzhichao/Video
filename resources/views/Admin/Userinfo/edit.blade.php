@extends('admin.layout')

@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            

            <div class="row-content am-cf">
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">修改</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form action="{{ url('admin/userinfo/') }}/{{ $data-> uiid }}" method="post" class="am-form tpl-form-border-form tpl-form-border-br">
                                
                                    {{ method_field('put') }}
                                    {{ csrf_field() }}
                                    
                                     @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                    @endif
                                    <div id='msg' class="am-form-group">
                                        @if(session('msg'))
                                            <li style="color:red">{{session('msg')}}</li>
                                         @endif
                                    </div>
                                     <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">昵称 <span class="tpl-form-line-small-title">nickname</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="nickname" class="tpl-form-input" id="user-name" value="{{$data->nickname}}">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">真实姓名 <span class="tpl-form-line-small-title">realname</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name='realname' class="tpl-form-input" id="user-name" value="{{$data->realname}}">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">身份证号 <span class="tpl-form-line-small-title">cardid</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="number" name='cardid' class="tpl-form-input" id="user-name" value="{{$data->cardid}}">
                                        </div>
                                    </div>
                                 
                                    
                
                                     <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">QQ <span class="tpl-form-line-small-title">qq</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="number" name="qq" class="tpl-form-input" id="user-name" value="{{$data->qq}}">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button class="am-btn am-btn-primary tpl-btn-bg-color-success ">修改</button>
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
    <script src="{{ asset('/Admin/assets/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('/Admin/assets/js/amazeui.datatables.min.js') }}"></script>
    <script src="{{ asset('/Admin/assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/Admin/assets/js/app.js') }}"></script>

</body>

</html>

@stop