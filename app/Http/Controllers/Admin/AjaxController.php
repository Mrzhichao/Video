<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\Admin\Admin;

class AjaxController extends Controller
{

	//修改用户状态
    public function ajaxStatus(Request $request)
    {
        $id = $request->input('id');
        $data = User::find($id);
        if ($data->status == 0) {
            $data->update(['status' => 1]);
            $res = $data->save();
            if ($res) {
                return ['status'=>1];
               // return response()->json(['astatus' => 1]);
               // return json_encode(['astatus' => 1]);
            } else {
                return ['status'=>0];
        	// return response()->json(['astatus' => 0]);
            // return json_encode(['astatus' => 0]);
            }
        } else {
            $data->update(['status' => 0]);
            $res = $data->save();

            if ($res) {
                return ['status'=>0];
                // return response()->json(['astatus' => 0]);
                // return json_encode(['astatus' => 0]);
            } else {
                return ['status'=>1];
               // return response()->json(['astatus' => 1]);
                // return json_encode(['astatus' => 1]);
            }
        }
    }
    //修改管理员状态
    public function adminajaxStatus(Request $request)
    {
        // return 111;
        $id = $request->input('id');
        // return $id;
        $data = Admin::find($id);
        if ($data->status == 0) {
            $data->update(['status' => 1]);
            $res = $data->save();
            if ($res) {
                return ['status'=>1];
               // return response()->json(['astatus' => 1]);
               // return json_encode(['astatus' => 1]);
            } else {
                return ['status'=>0];
            // return response()->json(['astatus' => 0]);
            // return json_encode(['astatus' => 0]);
            }
        } else {
            $data->update(['status' => 0]);
            $res = $data->save();

            if ($res) {
                return ['status'=>0];
                // return response()->json(['astatus' => 0]);
                // return json_encode(['astatus' => 0]);
            } else {
                return ['status'=>1];
               // return response()->json(['astatus' => 1]);
                // return json_encode(['astatus' => 1]);
            }
        }
    }

}
