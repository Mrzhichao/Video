@extends('admin.layout')

@section('content')

        <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span> 表单 <small>Amaze UI</small></div>
                        <p class="page-header-description">Amaze UI 有许多不同的表格可用。</p>
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
                                <div class="widget-title am-fl">添加</div>
                                <div class="widget-function am-fr">
                                    <a href="javascript:;" class="am-icon-cog"></a>
                                </div>
                            </div>
                            <div class="widget-body am-fr">

                                <form action="{{ url('admin/user') }}" method="post" class="am-form tpl-form-border-form tpl-form-border-br" enctype="multipart/form-data">
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
                                     <div class="am-form-group">
                                        <label for="user-phone" class="am-u-sm-3 am-form-label">角色 <span class="tpl-form-line-small-title">roleid</span></label>
                                        <div class="am-u-sm-9">
                                            <select data-am-selected="{searchBox: 1}" style="display: none;">
                                              <option value="1">普通用户</option>
                                              <option value="2">Vip用户</option>
                                            </select>

                                        </div>  
                                    </div>
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">用户名 <span class="tpl-form-line-small-title">uname</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="text" name="uname" class="tpl-form-input" id="user-name" placeholder="请输入用户名">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">密码 <span class="tpl-form-line-small-title">upwd</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="password" name='upwd' class="tpl-form-input" id="user-name" placeholder="请输入密码">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">确认密码 <span class="tpl-form-line-small-title">re_upwd</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="password" name='re_upwd' class="tpl-form-input" id="user-name" placeholder="请输入密码">
                                        </div>
                                    </div>
                                 
                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">性别 <span class="tpl-form-line-small-title">sex</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="radio" name='sex' class="tpl-form-input" id="user-name" value="男"> 男
                                            <input type="radio" name='sex' class="tpl-form-input" id="user-name" value= '女'> 女
                                        </div>
                                    </div>
                
                                     <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">头像 <span class="tpl-form-line-small-title">avatar</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="file" name="avatar" class="tpl-form-input" id="user-name">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">手机号 <span class="tpl-form-line-small-title">phone</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="number" name="phone" class="tpl-form-input" id="user-name">
                                        </div>
                                    </div>

                                    <div class="am-form-group">
                                        <label for="user-name" class="am-u-sm-3 am-form-label">邮箱 <span class="tpl-form-line-small-title">email</span></label>
                                        <div class="am-u-sm-9">
                                            <input type="email" name="email" class="tpl-form-input" id="user-name">
                                        </div>
                                    </div>
                                    <div class="am-form-group">
                                        <div class="am-u-sm-9 am-u-sm-push-3">
                                            <button class="am-btn am-btn-primary tpl-btn-bg-color-success ">提交</button>
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