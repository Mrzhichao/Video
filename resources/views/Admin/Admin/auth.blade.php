@extends('Admin.layout')


@section('content')

<div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                   <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>权限管理 ><small>后台用户授权</small></div>
                        
                    </div>
                    
                </div>

            </div>

            <div class="row-content am-cf">


               
                
                <div class="row">

                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                        <div class="widget am-cf">
                           
                            <div class="widget-body am-fr">

                    
                                <form action="{{ url('admin/admin/auth') }}" method="post" enctype="multipart/form-data" class="am-form tpl-form-border-form">
                              
                                   

                                <div class="am-form-group">
                                        <label class="am-u-sm-12 am-form-label am-text-left" for="user-name">用户名<span class="tpl-form-line-small-title"></span></label>
                                        <div class="am-u-sm-12">
                                            <input type="text"    id="user-name" disabled="" name="aname" value="{{$user->aname}}" class="tpl-form-input am-margin-top-xs">
                                            
                                        </div>
                                    </div>
                            <input type="hidden" name="aid" value="{{$user->aid}}">
                                    
                         <div class="am-form-group">
                                <label class="am-u-sm-12 am-form-label am-text-left" for="user-name">用户权限<span class="tpl-form-line-small-title"></span></label>
                                <div class="am-u-sm-12">
                                    @foreach($roles as $k => $v) 
                                        
                                     @if(in_array($v->rid,$own_roles))
                                     <label class="checkbox-inline">
                                      <input type="checkbox" name="rid[]"  checked value="{{$v->rid}}"> {{$v->rname}}
                                    </label>
                                @else
                                    <label class="checkbox-inline">
                                      <input type="checkbox" name="rid[]"  value="{{$v->rid}}"> {{$v->rname}}
                                    </label>
                                @endif     
                                   
                                   @endforeach
                                </div>
                                    
                    </div>
                                   {{ csrf_field() }}

                                    <div class="am-form-group">
                                        <div class="am-u-sm-12 am-u-sm-push-12">
                                            <button id="btn" class="am-btn am-btn-primary tpl-btn-bg-color-success " type="submit">添加</button>
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