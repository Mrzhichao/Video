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

                                <form action="{{ url('admin/user') }}/{{ $data-> uid }}" method="post" class="am-form tpl-form-border-form tpl-form-border-br" enctype="multipart/form-data">
                                
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
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">角色 <span class="tpl-form-line-small-title">roleid</span></label>
                                        <div class="am-u-sm-9">
                                            <select name='roleid' data-am-selected="{searchBox: 1}" style="display: none;">
                                              <option value="1" @if($data -> roleid == '1')  selected @endif >普通用户</option>
                                              <option value="4" @if($data -> roleid == '4')  selected @endif >Vip用户</option>
                                              <option value="5" @if($data -> roleid == '5')  selected @endif >广告用户</option>
                                            </select>

                                        </div>  
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">用户名 <span class="tpl-form-line-small-title">uname</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="uname" class="tpl-form-input" id="user-name" value="{{ $data -> uname}}">
                                        </div>
                                    </div>

                    
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">性别 <span class="tpl-form-line-small-title">sex</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="radio" name='sex' class="tpl-form-input" id="user-name" value="男" @if($data -> sex == '男')  checked @endif > 男
                                            <input type="radio" name='sex' class="tpl-form-input" id="user-name" value="女" @if($data -> sex == '女')  checked @endif > 女
                                        </div>
                                    </div>
                
                                     <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">头像 <span class="tpl-form-line-small-title">avatar</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="file" name="avatar" class="tpl-form-input" id="user-name" >
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">手机号 <span class="tpl-form-line-small-title">phone</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="number" name="phone" class="tpl-form-input" id="user-name" value="{{ $data -> phone }}">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">邮箱 <span class="tpl-form-line-small-title">email</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="email" name="email" class="tpl-form-input" id="user-name" value="{{ $data -> email}} ">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">状态 <span class="tpl-form-line-small-title">status</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="radio" name='status' class="tpl-form-input" id="user-name" value="0" @if($data -> status == '0')  checked @endif > 禁用
                                            <input type="radio" name='status' class="tpl-form-input" id="user-name" value="1" @if($data -> status == '1')  checked @endif > 启用
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