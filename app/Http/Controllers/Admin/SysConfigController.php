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
     * 将网站配置表中的内容写入config目录下的网站配置文件中
     */

    public function PutFile()
    {

//        1 获取网站配置表中的数据

        $conf = SysConfig::pluck('conf_content','conf_name')->all();
        //dd($conf);

//        2 创建网站配置文件，写入数据
        //配置文件的文件名
        $filename = config_path().'\webconfig.php';
//        数据库中查到的数据是数组形式，变成字符串形式
        $context ="<?php \n return \n ".var_export($conf,true).';';
//        dd($con);
        //return $filename;

        file_put_contents($filename,$context);
        
    }
    
    /**
     * 批量修改网站配置内容
     */

    public function ContentChange(Request $request)
    {

        //dd(1111);
        $input = $request->all();
        //dd($input);

//        根据conf_id数组获取要修改的网站配置记录，然后从conf_content的同下标中取出此网站配置记录要修改成的值

       foreach ($input['conf_id'] as $k=>$v){
//           找到一条要修改的网站配置记录
          $conf =  SysConfig::find($v);

//          $input['conf_content']
          $conf->update(['conf_content'=>$input['conf_content'][$k]]);
       }

        $this->PutFile();
       return redirect('admin/sysconfig');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //网站配置数据
        $config = SysConfig::get();

        foreach ($config as $k=>$v){
            // dd($v);
//            根据当前这条记录的field_type字段的值类决定，conf_content的显示形式
            switch ($v->field_type){
                case 'input':

//                    <input type="text" name="conf_title">
                    $v->conf_contents = '<input class="lg" style="color:blue" type="text" name="conf_content[]" value="'.htmlspecialchars($v->conf_content).'">';

                    break;

                case 'textarea':
//                    <textarea id="" cols="30" rows="10" name="conf_tips"></textarea>
                    $v->conf_contents = '<textarea id="" style="color:blue" cols="30" rows="10" name="conf_content[]">'.htmlspecialchars($v->conf_content).'</textarea>';
                    break;

                case 'radio':

//                    $item =[
//                        0=>1,
//                        1=>'开启'
//                    ]
//
//                    1|开启,0|关闭
//                    =====>
//                  arr=  [
//                        0=>'1|开启',
//                        1=>'0|关闭'
//                    ]
//                ========》
//                    <input type="radio" name="field_type" value="1" >开启　
//                    <input type="radio" name="field_type" value="0" >关闭　

//                    存放最终拼接的结果
                    $str = '';

                    $arr = explode(',',$v->field_value);
                    foreach ($arr as $m=>$n){

                      $item = explode('|',$n);

                      //如果当前网站配置记录的conf_content的值 == 单选按钮的值，应该给单选按钮添加checked属性
                        if($item[0] == $v->conf_content){
                            $str.= '<input type="radio" checked name="conf_content[]" value="'.$item[0].'" >'.$item[1];
                        }else{
                            $str.= '<input type="radio"  name="conf_content[]" value="'.$item[0].'" >'.$item[1];
                        }

                    }

                    $v->conf_contents = $str;


                    break;
            }
            

        }
 // dd($config);
        return view('admin.SysConfig.index',['title'=>'配置首页','config'=>$config]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.SysConfig.add',['title'=>'配置添加']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       return view('admin.SysConfig.edit',['title'=>'配置修改']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
