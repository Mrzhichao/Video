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

                                 @if(Session('msg'))
                                    <div style="color: #cf4; size:125%;" id="msg">{{session('msg')}}</div>
                                @endif
                                </div>

                                <div class="widget-function am-fr">
                                <form action="{{ url('admin/ad') }}" method="get">
                                <input style="color:#a2b;" type="text" name="aname" value="{{ $namekey['aname'] }}" placeholder="...谁添加的">
                               <button class="am-btn   am-btn-success">搜索</button>
                                </form>
                                </div>
                            </div>
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
                                            
                                            <th>开始时间</th>
                                            <th>结束时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $k => $v)
                                        <tr class="gradeX">
                                        	<td>{{ $v -> aname }}</td>
                                            <td>{{ $v -> id }}</td>
                                            <td>{{ $v -> adesc }}</td>
                                            <td>{{ $v -> acontent }}</td>
                                            <td><img width="60" height="40" src="{{ asset('./uploads/Ad/s_') }}{{ $v->aimg }}" /></td>
                                            <td>{{ $v -> aprice }}</td>
                                            
                                            <td>{{ date('Y-m-d',$v -> startTime) }}</td>
                                            <td>{{ date('Y-m-d', $v -> endTime )}}</td>
                                            <td>
                                                <div class="tpl-table-black-operation">
                                                    <a href="{{ url('admin/ad') }}/{{$v->id}}/edit">
                                                        <i class="am-icon-pencil"></i> 编辑
                                                    
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
                                        <ul class="am-pagination ">
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
       function sendBtn(path) {

           
          var comfirm = confirm('你确定要删除吗?');
            if(comfirm){
             
               $.ajax({

                    type:'DELETE',
                    url:path,
                    success:function(data)
                    {      
                        window.location.reload();
                            alert(data);

                    }
               });
            }
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
	

</script>>









@stop