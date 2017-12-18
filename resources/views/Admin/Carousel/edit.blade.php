@extends('Admin.layout')


@section('content')

<div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                   <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>轮播管理 ><small>修改轮播</small></div>
                        
                    </div>
                    
                </div>

            </div>

            <div class="row-content am-cf">


               
                
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                           
                            <div class="widget-body am-fr">

                    
                                <form action="{{ url('admin/carousel/') }}/{{$data->cid}}" method="post" enctype="multipart/form-data" class="am-form tpl-form-border-form">
                                {{ method_field('put') }}
                                   <div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label am-text-left" for="user-name">轮播名称<span class="tpl-form-line-small-title">name</span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text" placeholder="轮播视频名称" name="cname" id="user-name" value="{{ $data->cname }}" class="tpl-form-input am-margin-top-xs">
                                        
                                        </div>
                                    </div>

                        <input type="hidden" name="vid" value="{{$data->cid}}">
                                               
                                    

                                   {{ csrf_field() }}

                                    <div class="am-form-group">
                                        <div class="am-u-sm-12 am-u-sm-push-12">
                                            <button id="btn" class="am-btn am-btn-primary tpl-btn-bg-color-success " type="submit">修改</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


<!--判断错误信息 并弹出-->


    @if (count($errors) > 0)
        <center> <div id="error" style="background: #efe; margin: 0px;padding: 0px;" >
         <ul style="color:#f89;">
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
          </ul>
         </div></center>
    @endif
           
<script type="text/javascript">
    //捕获页
    layer.open({
        type: 1,
        shade: false,
        title: false, //不显示标题
        content: $('#error'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
        cancel: function(){
        layer.msg('请按照规则填写...', {time: 3000, icon:5});
        }
    });


</script>         



@if(Session('msg'))
<script type="text/javascript">
//弹出信息框
     layer.alert("{{session('msg')}}", {
        skin: 'layui-layer-molv'
        ,closeBtn: 0
        ,anim: 2 //动画类型
        });

</script>
@endif

<script type="text/javascript">
    //提交
    $('#btn').on('click',function()
        {         //加载层
            var index = layer.load(2, {shade: false});
        });

</script>


@stop