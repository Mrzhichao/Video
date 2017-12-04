@extends('Admin.layout')
@section('content')


<div class="tpl-content-wrapper">

            <div class="container-fluid am-cf">
                <div class="row">
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-9">
                        <div class="page-header-heading"><span class="am-icon-home page-header-heading-icon"></span>广告管理 ><small>广告预览</small></div>
                       
                    </div>
                    
                </div>
            
            </div>
            
            <div class="row-content am-cf">
    	

        

                <div class="row">
 
                    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">

                        <div class="widget am-cf">
                            <div class="widget-head am-cf">


                                <!-- <div class="widget-function am-fr">
                                <form action="{{ url('admin/ad') }}" method="get">
                                <input style="color:#a2b;" type="text" name="min"  value="" placeholder="...最小时间">--
                                <input style="color:#a2b;" type="text" name="max"  value="" placeholder="...最大时间">
                               <button class="btn   btn-success" id="serach" >搜索</button>
                                </form>
                                </div> -->
                            </div>
                            <div class="widget-body  widget-body-lg am-fr">
                            
                                <table width="100%"  id="example-r" class="am-table am-table-compact tpl-table-black ">
                                    <thead>
                                        <tr>

                                        	<th>视频广告编号</th>
                                            <th>视频名字</th>
                                            <th>广告链接</th>
                                            <th>单击修改</th>
                                            <th>投放时间</th>
                                            <th>共计金额</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $k => $v)
                                        <tr class="gradeX">
                                        	<td id="id">{{ $v -> vaid }}</td>
                                            <td>{{ $v -> video['vname'] }}</td>
                                            <td>{{ $v -> vredirect }}</td>
                                            <td class="vimg"><img width="60" height="40" src="{{ asset('./uploads/Vad') }}/{{ $v->vpath }}" /></td>
                                            <td>{{ $v -> vtime }}秒</td>
                                            <td>{{ $v -> vprice }}</td>
                                            
                                            
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a id="edit"  href="{{ url('admin/vad') }}/{{$v -> vaid}}/edit">
                                                        <i  class="am-icon-pencil"></i> 编辑
                                                    
                                                    </a>
                                                    <a class="tpl-table-black-operation-del del" href="javascript:void(0);" onclick="sendBtn('vad/{{ $v -> vaid }}')">
                                                        <i class="am-icon-trash"></i> 删除
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                                                       
                                        <!-- more data -->
                                    </tbody>
                                </table>
                                <div class="am-u-lg-12 am-cf">
                            
                                    <div class="am-fr tpl-pagination">
                                        <ul id="fenye" class="am-pagination ">
                                           {!! $data->render() !!}
                                        </ul>
                                    </div>
                                </div>
								  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>

            </div>
        </div>

<!--判断错误信息 并弹出-->
@if(Session('msg'))
<script type="text/javascript">
//弹出信息框
     layer.alert("{{session('msg')}}", {
        skin: 'layui-layer-lan'
        ,closeBtn: 0
        ,anim: 2 //动画类型
        });

</script>
@endif

<script type="text/javascript">
//点击编辑时 弹出
    $('#edit').on('click',function()
        {
            layer.msg('玩命加载中');
        });
//点击添加时 弹出
 $('#create').on('click',function()
        {
            layer.msg('玩命加载中');
        });
 //点击搜索时 弹出
 $('#serach').on('click',function()
        {         //加载层
            var index = layer.load(1, {shade: false}); //0代表加载的风格，支持0-2
        });
  //点击搜索时 弹出
 $('#fenye').on('click',function()
        {         //加载层
            var index = layer.load(1, {shade: false}); //0代表加载的风格，支持0-2
        });

</script>

<script type="text/javascript">
       function sendBtn(path) {

           
        //询问框
        layer.confirm('你确定要删除吗?', {
        btn: ['狠心','不舍'] //按钮
        }, function(){
            $.ajax({

                    type:'DELETE',
                    url:path,
                    success:function(data)
                    {      
                        window.location.reload();
                        layer.msg(data, {icon: 1});
                    }
               });
        }, function(){
        });
        };
    </script>

<!--单击修改信息-->
<script type="text/javascript">
    $(function () {
        $("#file_upload").change(function () {
        $('img1').show();
        uploadImage();
        });
   });

     $(".vimg").on('dblclick', fn1);


        function fn1() {
            var t = $(this);
            var id = t.parent().find('#id').html(); //获取ID名(修改数据)
            console.log(id);
            var name = t.html();
            var inp = $('<input style="color:black;" type="text">');
            inp.val(name);
            t.html(inp);
            inp.select();
            t.unbind('dblclick');
            inp.on('blur', function () {
                var newName = $(this).val();
                $.ajax({
                    url: "{{ url('admin/carousel/ajaxName') }}",
                    type: 'post',
                    data: {id: id, name: newName},
                    beforeSend: function () {
                        $("#info").html('<span class="text-red"><i class="fa fa-fw fa-spin fa-circle-o-notch"></i>正在修改中...</span>');
                        $("#info").show();
                    },
                    success: function (data) {
//                        console.log(data);
                        if (data.code == 0) {
                            t.html(name);
                            $("#info").html('<span class="text-red">用户名已经存在</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        } else if (data.code == 1) {
                            t.html(newName);
                            $("#info").html('<span class="text-red">修改成功</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        } else {
                            t.html(name);
                            $("#info").html('<span class="text-red">修改失败</span>');
                            $("#info").show();
                            $("#info").fadeOut(2000);
                        }
                        ;
                        //添加事件。
                        t.on('dblclick', fn1);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);
                    },
//                    timeout:1000,
                    dataType: 'json'
                });
            });
        }


    function uploadImage() {
    // 判断是否有选择上传文件
    var imgPath = $("#file_upload").val();
    if (imgPath == "") {
    alert("请选择上传图片！");
     return;
    }
    //判断上传文件的后缀名
    var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
        if (strExtension != 'jpg' && strExtension != 'gif'&& strExtension != 'png' && strExtension != 'bmp') {
                 alert("请选择图片文件");
                 return;
            }
    var formData = new FormData($('#art_form')[0]);
     $.ajax({
       type: "POST",
       url: "/admin/upload",
       data: formData,
       async: true,
       cache: false,
       contentType: false,
       processData: false,
       success: function(data) {
            $('#img1').attr('src','http://project193.oss-cn-beijing.aliyuncs.com/'+data);
            $('#img1').show();
            $('#art_thumb').val('/uploads/'+data);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                  alert("上传失败，请检查网络后重试");
                }
           });
       }
 </script>


@stop