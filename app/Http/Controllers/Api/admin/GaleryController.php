<?php

namespace App\Http\Controllers\api\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Galery;
class GaleryController extends Controller
{
    
    public function __construct()
    {
        $this->_model = new Galery;
        $this->base_img = url('assets/img/galery/');
    }

	public function index(Request $request)
	{
		$input = $request->input();

		$limit = isset($input['limit'])?$input['limit']:10;
		$page = isset($input['page'])?$input['page']:1;
		$q = isset($input['q'])?$input['q']:'';
		$offset = ($page-1) * $limit;

		$data = $this->_model->select('created_at','id','name','id',DB::raw(' IF(img_type="img", CONCAT("'.$this->base_img.'","/",img) ,img) as img '))
				->whereNull('deleted_at');
		if($q !=''){
			$data = $data->where(function($query) use ($q){
			        $query->where('name', 'like', '%' . $q . '%');
			});
		}

		$data = $data->skip($offset)->take($limit)->orderBy('created_at','desc')->paginate();
			
		return $data;
	}
	public function show($id)
	{
		$data = $this->_model->find($id);

		if($data->img_type=='img' && $data->drive=='local'){
			$data->img_prev= $this->base_img.'/'.$data->img;
		} else{
			$data->img_prev = '';
		}
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

        $input = $request->only(['name','img']);
        $validation = Validator::make($input, [
                'name' => 'required|min:2', // unique:users
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

        $data->name = $input['name'];
        $data->img_type = 'img';
        $data->drive = 'local';
        if(isset($input['img']) && $input['img']!=''){
        	$data->img = $input['img'];
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
	public function upload(Request $request)
	{
		$file = $request->file("file");

		$input = $request->input();

		$filename = date('YmdHis')."_".$this->_model->slug($input['name']).".".$file->getClientOriginalExtension();
        $file->move(public_path('assets/img/galery'), $filename);
        $res['data'] = $filename;
        $res['file_path'] = $this->base_img.'/'.$filename;
        $res['error'] = false;
        $res['msg'] = 'success';

        return $res;
	}
}
