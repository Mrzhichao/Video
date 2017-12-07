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
                                <form action="{{ url('admin/link') }}" method="post"> 
                                     <table class="add_tab" style="background:#4B5357;color:black;">
                                        <tbody>
                                            <tr>
                                                {{csrf_field()}}
                                                <th><i class="require">*</i>链接名称：</th>
                                                <td>
                                                    <input type="text" class="lg" name="link_name" value="">
                                                    <p>名称可以写30个字</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><i class="require">*</i>链接提示：</th>
                                                <td>
                                                    <input type="text" class="lg" name="link_title">
                                                    <p>提示可以写30个字</p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th><i class="require">*</i>链接url：</th>
                                                <td>
                                                    <input type="text" class="lg" name="link_url">
                                                    <p>URL可以写30个字</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><i class="require">*</i>链接排序：</th>
                                                <td>
                                                    <input type="text" class="lg" name="link_order">
                                                    <p>必须为数字</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td  colspan='6'>
                                                    <input type="submit" value="提交" style="color:white;height:40px">
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
</body>
</html>

<script type="text/javascript">

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
