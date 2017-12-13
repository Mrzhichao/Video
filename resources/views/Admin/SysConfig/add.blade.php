@extends('Admin.layout')

@section('content')

   <!-- 内容区域 -->
        <div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>配置管理&nbsp;&nbsp;&nbsp;&nbsp;<small>配置添加</small></div>
                    </div>
                </div>

            </div>

            <div class="row-content am-cf">


                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                            <div class="widget-head am-cf">
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
                                <form action="{{ url('admin/sysconfig') }}" method="post"> 
                                    <table class="add_tab" style="background:#4B5357;color:white;">         
                                        <tr>
                                            {{csrf_field()}}
                                            <th><i class="require"></i>标题：</th>
                                            <td>
                                                <input type="text" name="conf_title" style="color:black;"  value="{{config('webconfig.web_title')}}">
                                                <span style="color:white;" ><i class="fa fa-exclamation-circle yellow" ></i>配置项标题必须填写</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><i class="require"></i>名称：</th>
                                            <td>
                                                <input type="text" name="conf_name" style="color:black;">
                                                <span  style="color:white;"><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><i class="require"></i>内容：</th>
                                            <td>
                                                <input type="text" name="conf_content" style="color:black;">
                                                <span  style="color:white;"><i class="fa fa-exclamation-circle yellow"></i>配置项内容必须填写</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>类型：</th>
                                            <td>
                                                <input type="radio" name="field_type" value="input" style="color:white;" checked onclick="showTr(this)">input　
                                                <input type="radio" name="field_type" value="textarea" style="color:white;" onclick="showTr(this)">textarea　
                                                <input type="radio" name="field_type" value="radio" style="color:white;" onclick="showTr(this)">radio
                                            </td>
                                        </tr>  
                                            <tr class="field_value" style="display: none">
                                                <th>类型值：</th>
                                                <td>
                                                    <input type="text" class="lg" name="field_value" style="color:black;">
                                                    <p style="color:white;"><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置，格式 1|开启,0|关闭</p>
                                                </td>
                                            </tr>
                                        <tr>
                                            <th>排序：</th>
                                            <td>
                                                <input type="text" class="sm" name="conf_order" value="0" style="color:black;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>说明：</th>
                                            <td>
                                                <textarea id="" cols="10" name="conf_tips" style="color:black;"></textarea>
                                            </td>
                                        </tr>

                                        <tr>
                                 
                                            <td colspan='6'>
                                                <input type="submit" style="color:white;height:40px" value="提交">
                                            </td>
                                        </tr>
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
</body>
</html>

<script type='text/javascript'>

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

@stop