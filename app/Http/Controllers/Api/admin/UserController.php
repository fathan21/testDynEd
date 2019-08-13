<?php

namespace App\Http\Controllers\api\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->_model = new User;
    }

	public function index(Request $request)
	{
		$input = $request->input();

		$limit = isset($input['limit'])?$input['limit']:10;
		$page = isset($input['page'])?$input['page']:1;
		$q = isset($input['q'])?$input['q']:'';
		$offset = ($page-1) * $limit;

		$data = $this->_model->whereNull('deleted_at');
		if($q !=''){
			$data = $data->where(function($query) use ($q){
			        $query->where('full_name', 'like', '%' . $q . '%')
			        ->orWhere('email', 'like', '%' . $q . '%');
			});
		}

		$data = $data->skip($offset)->take($limit)->paginate($limit);

		return $data;
	}
	public function show($id)
	{
		$data = $this->_model->find($id);
		$res = array(
			'msg'=>'success',
			'error'=>false,
			'data'=>$data,
		);
		return $res;
	}


	public function store(Request $request)
	{
		return $this->save($request);
	}
	public function update(Request $request,$id)
	{
		return $this->save($request, $id);
	}

	public function save($request,$id='')
	{
		$input = $request->input();

        $input = $request->only(['email', 'password','full_name','user_group_id']);
        $validation = Validator::make($input, [
                'full_name' => 'required|min:2',
                'email' => 'required|email|unique:user,email,'.$id, // unique:users
                'password' => $id==''?'required':'', // unique:users
        ]);
        if ($validation->fails()) {
            $errorString = implode(",",$validation->messages()->all());
            $res = array(
                "status"=>"400",
                "error"=>true,
                "msg"=>$errorString,
                'data'=>$validation->errors(),
            );
            return $res;
        }

        $data = $id == ''?$this->_model:$this->_model->find($id);

        $data->email = $input['email'];
        $data->full_name = $input['full_name'];
        $data->user_group_id = $input['user_group_id'];
        if(isset($input['password'])){
	        $data->password =Hash::make($input['password']);

        }
        $data->save();

		$res = array(
			'msg'=>'success',
			'error'=>false,
			'data'=>$input,
		);
		return $res;
	}
	public function destroy($id)
	{
		$data = $this->_model->find($id);
        $data->deleted_by = '1';
        $data->deleted_at = date('Y-m-d H:i:s');
        $data->save();
	}
}
