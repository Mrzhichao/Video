<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;
use App\Models\Admin\SysConfig;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SysConfigController extends Controller
{

    /**
     * 批量修改网站配置内容
     */
    public function contentChange(Request $request)
    {
        $input = $request->all();
        dd($input);

        //根据conf_id数组获取要修改的网站配置记录，然后从conf_content的同下标中取出此网站配置记录要修改成的值
        foreach ($input['conf_id'] as $k=>$v){

            //找到一条要修改的网站配置记录
            $conf =  SysConfig::find($v);

            //$input['conf_content']
            $conf->update(['conf_content'=>$input['conf_content'][$k]]);
        }

        $this->putFile();
        return redirect('admin/sysconfig');
    }


    /**
     * 将网站配置表中的内容写入config目录下的网站配置文件中
     */
    public function putFile()
    {
        //1 获取网站配置表中的数据
        $conf = SysConfig::pluck('conf_content','conf_name')->all();
        //2 创建网站配置文件，写入数据

        //配置文件的文件名
        $filename = config_path().'\webconfig.php';

        //数据库中查到的数据是数组形式，变成字符串形式
        $context ="<?php \n return \n ".var_export($conf,true).';';
        //return $filename;

        file_put_contents($filename,$context);
        
    }


    /**
     * 配置首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //网站配置数据
        $config = SysConfig::orderby('conf_order','asc')->get();

        foreach ($config as $k=>$v){
            //根据当前这条记录的field_type字段的值类决定，conf_content的显示形式
     
            switch ($v->field_type){
                case 'input':
                //<innput type="text" name="conf_title">

                    $config[$k]->_html = '<input class="lg conf_content" style="color:blue" id="conf_content" type="text" name="conf_content[]" value="'.$v->conf_content.'">';

                    break;

                case 'textarea':
                //<textarea id="" cols="30" rows="10" name="conf_tips"></textarea>
                    
                    $config[$k]->_html = '<textarea class="conf_content" style="color:blue"" id="conf_content" cols="30" rows="10" name="conf_content[]">'.htmlspecialchars($v->conf_content).'</textarea>';
                    
                    break;

                case 'radio':   

//                  $item =[ 0=>1,1=>'开启'  ]

//                  1|开启,0|关闭

//                  arr=  [  0=>'1|开启',  1=>'0|关闭' ]
//                  
//                  <input type="radio" name="field_type" value="1" >开启　<input type="radio" name="field_type" value="0" >关闭　

//                  存放最终拼接的结果
                    $str = '';

                    $arr = explode(',',$v->field_value);
                    foreach ($arr as $m=>$n){

                        $r = explode('|',$n);

                        //如果当前网站配置记录的conf_content的值 == 单选按钮的值，应该给单选按钮添加checked属性
                        $c=($v->conf_content == $r[0])?' checked ':'';
                        $str.= '<input type="radio" name="conf_content" value="'.$r[0].'".$c. >'.$r[1];
                    }
                        $config[$k]->_html = $str;

                    break;
            }

        }

        return view('admin.SysConfig.index',['title'=>'配置首页','config'=>$config]);
    }


    /**
     * 添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.SysConfig.add',['title'=>'配置添加']);
    }


    /**
     * 添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');

        if($request->field_type != 'radio'){
            $input['conf_content']=$request->conf_content;
        }else{
              $value=$request->field_value;
              $input['conf_content']=$value;  
        }

        $res = SysConfig::create($input);

        if($res){
            $this->PutFile();
            return redirect('admin/sysconfig');
        }else{
            return back();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * 更新页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $config=SysConfig::find($id);
       // dd($config);
       return view('admin.SysConfig.edit',['title'=>'配置修改','config'=>$config]);
    }


    /**
     * 更新操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_token','_method','vimg');
        
        //过滤掉空数据
        foreach($input as $k=>&$v){
            if(!$v){unset($input[$k]); }
        }

        $conf=SysConfig::find($id);

        $res = $conf->update($input);
        if($res){
            return redirect('admin/sysconfig');
        }else{
            return redirect('admin/sysconfig/'.$conf->conf_id.'/edit');
        }
    }


    /**
     *  ajax排序操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeOrder(Request $request)
    {
        $conf_id = $request->input('conf_id');
        //要修改的值
        $conf_order = $request->input('conf_order');

        $cate = SysConfig::find($conf_id);
        $res = $cate->update(['conf_order'=>$conf_order]);

        if($res){
            $data =[
                'status'=> 0,
                'msg'=>'排序成功'
            ];
        }else{
            $data =[
                'status'=> 1,
                'msg'=>'排序失败'
            ];
        }

          return $data;
    }


    /**
     * 删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [];

        $res = SysConfig::find($id)->delete();
        if($res){
            $data['error'] = 0;
            $data['msg'] ="删除成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="删除失败";
        }

        return $data;
    }


    /**
     * 删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delmore(Request $request)
    {
        $delmore = $request->input('delmore');
        dd($delmore);
        foreach($delmore as $key=>$value){
            $res = SysConfig::find($value->id)->delete();
        }
        
        if($res){
            $data['error'] = 0;
            $data['msg'] ="删除成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="删除失败";
        }

        return $data;
    }


    /**
     * 修改单选按钮状态
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function config_status_ajax_update(Request $request)
    {
        $id = $request->input('id');
        $data = SysConfig::find($id);

        if($data->field_type == 'radio'){

            if($data->conf_content == 0) {
                $res = $data->update(['conf_content' => 1]);
                if($res){
                    return ['conf_content'=>1];
                }else{
                    return ['conf_content'=>0];
                }

            }else{
                $res = $data->update(['conf_content' => 0]);
                if($res){
                    return ['conf_content'=>0];
                }else{
                    return ['conf_content'=>1];
                }
            }
        }

    }


    /**
     * 修改单选按钮状态
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function config_content_ajax_update(Request $request)
    {
        $id = $request->input('id');

        $content=$request->input('content');
        
        $res = SysConfig::find($id)->update(['conf_content' => $content]);
        if($res){
            $data['error'] = 0;
            $data['msg'] ="修改成功";
        }else{
            $data['error'] = 1;
            $data['msg'] ="修改失败";
        }

        return $data;
    }

}
