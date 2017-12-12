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
                          

                                <div class="widget-title am-fl">
                                <a id="create" href="{{ url('admin/ad/create') }}"> <button  type="button" style="color: " class="btn active  btn-success">&nbsp;广告添加&nbsp;</button></a>
                                </div>

                                <div class="widget-function am-fr">
                                <form action="{{ url('admin/ad') }}" method="get">
                                <input style="color:#a2b;" type="text" name="aname"  value="{{ $namekey['aname'] }}" placeholder="...谁添加的">
                               <button class="btn   btn-success" id="serach" >搜索</button>
                                </form>
                                </div>
                            </div>
                            <form id="form" action="upload" method="post" enctype="multipart/form-data">
                                          <input type="file"  name="vimg" id="upload" style="display: none;">

                                    </form>
                            <div class="widget-body  widget-body-lg am-fr">
                            
                                <table width="100%" id="example-r" class="am-table am-table-compact tpl-table-black ">
                                    <thead>
                                        <tr>

                                        	<th>添加者</th>
                                            <th>广告编号</th>
                                            <th>广告描述</th>
                                            <th>广告链接</th>
                                            <th>预览图</th>
                                            <th>付款</th>
                                            <th>状态</th>
                                            <th>开始时间</th>
                                            <th>结束时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $k => $v)
                                        <tr class="gradeX">
                                        	<td>{{ $v -> aname }}</td>
                                            <td class="id">{{ $v -> id }}</td>
                                            <td>{{ $v -> adesc }}</td>
                                            <td>{{ $v -> acontent }}</td>
                                            <td class="vimg"><img width="60" height="40" src="{{ asset('./uploads/Ad/s_') }}{{ $v->aimg }}" /></td>
                                            <td>{{ $v -> aprice }}</td>
                                            @if($v->status == 1)
                                            <td style="color:#cf4;">已激活</td>
                                            @else
                                                <td id="xf" style="color:#58f;">请续费</td>
                                            @endif
                                            <td>{{ date('Y-m-d',$v -> startTime) }}</td>
                                            <td>{{ date('Y-m-d', $v -> endTime )}}</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a id="edit"  href="{{ url('admin/ad') }}/{{$v->id}}/edit">
                                                        <i  class="am-icon-pencil"></i> 编辑
                                                    
                                                    </a>
                                                    <a class="tpl-table-black-operation-del del" href="javascript:void(0);" onclick="sendBtn('ad/{{ $v->id }}')">
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
                                            {!! $data->appends($namekey)->render() !!}
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

<script type="text/javascript">
    $('#xf').on('click',function()
        {
           layer.alert("付费君被劫持了....", {
            skin: 'layui-layer-lan'
            ,closeBtn: 0
            ,anim: 1 //动画类型
            });
 
        });

</script>>

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




<script type="text/javascript">

    //提示信息消失
    $('#msg').slideUp(3000);

</script>

<script type="text/javascript">

	var i = 0;
	var arr = $('.id');
	
	//去除ID排序 
	$('#id').on('click',function()
		{


			if(i%2 == 0){

			
				arr.sort(function(a,b){
					 return a.innerHTML>b.innerHTML?1:-1;
				});//对li进行排序，这里按照从小到大排序
				$('ul').empty().append(arr);//清空原来内容添加排序后内容。
				

			}else{

				arr.sort(function(a,b){
					 return a.innerHTML<b.innerHTML?1:-1;
				});//对li进行排序，这里按照从小到大排序
				$('ul').empty().append(arr);//清空原来内容添加排序后内容。

			}
			i++;
		});
	

</script>


<!--单击修改图片-->
<script type="text/javascript">
   //  $(function () {
   //      $("#form").change(function () {
   //      $('vimg').show();
   //      uploadImage();
   //      });
   // });

var id = null;
var img = null; 
$('.vimg').on('dblclick',function()
        {


            var t = $(this);
            img = t.find('img');
            id = t.parent().find('.id').html();  //获取ID
           $('#upload').click();
        });

$('#upload').change(function()
            {
                uploadImage();
            });
function uploadImage() {
   // 判断是否有选择上传文件
        var imgPath = $('#upload').val();
        if (imgPath == "") {
        alert("请选择上传图片！");
        return;
        }
      //  判断上传文件的后缀名
        // var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
        // if (strExtension != 'jpg' && strExtension != 'gif'
        // && strExtension != 'png' && strExtension != 'bmp') {
        // alert("请选择图片文件");
        // return;
        // }
        //获取ID

        var formData = new FormData();
        formData.append('id',id); //追加ID
        formData.append('upload', $('#upload')[0].files[0]);
        formData.append('_token', "{{csrf_token()}}");
        // var formData = new FormData($('#form')[0]);
        // console.log(formData);
        $.ajax({
        type: "POST",
        url: "ad/ajax",
        data:formData,
        async: true,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
        img.attr('src','/'+data);
       
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("上传失败，请检查网络后重试");
        }
        });
        }    




 </script>







@stop