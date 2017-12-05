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
                                <div class="widget-title am-fl">配置添加</div>
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
                                <form action="{{ url('admin/sysconfig') }}" class="am-form tpl-form-line-form" method='post' enctype="multipart/form-data"> 
                                    <table class="add_tab">
                                        <tbody>
                                        <tr>
                                            {{csrf_field()}}
                                            <th><i class="require"></i>标题：</th>
                                            <td>
                                                <input type="text" name="conf_title" value="{{config('webconfig.web_title')}}">
                                                <span><i class="fa fa-exclamation-circle yellow"></i>配置项标题必须填写</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><i class="require"></i>名称：</th>
                                            <td>
                                                <input type="text" name="conf_name">
                                                <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>类型：</th>
                                            <td>
                                                <input type="radio" name="field_type" value="input" checked onclick="showTr(this)">input　
                                                <input type="radio" name="field_type" value="textarea" onclick="showTr(this)">textarea　
                                                <input type="radio" name="field_type" value="radio" onclick="showTr(this)">radio
                                            </td>
                                        </tr>
                                        <tr class="field_value" style="display: none">
                                            <th>类型值：</th>
                                            <td>
                                                <input type="text" class="lg" name="field_value">
                                                <p><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置，格式 1|开启,0|关闭</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>排序：</th>
                                            <td>
                                                <input type="text" class="sm" name="conf_order" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>说明：</th>
                                            <td>
                                                <textarea id="" cols="10" name="conf_tips"></textarea>
                                            </td>
                                        </tr>

                                        <tr>
                                                <th></th>
                                                <td>
                                                    <input type="submit" style="color:red" value="提交">
                                                    <input type="button" class="back" style="color:red" onclick="history.go(-1)" value="返回">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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

</body>

</html>
@stop

    <script>
        function showTr(obj){
            switch($(obj).val()){
                case 'input':
                    $('.field_value').hide();
                    break;
                case 'textarea':
                    $('.field_value').hide();
                    break;

                case 'radio':
                    $('.field_value').show();
            }

        }
    </script>
