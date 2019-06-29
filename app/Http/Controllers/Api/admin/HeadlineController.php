<?php

namespace App\Http\Controllers\api\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Headline;
use App\HeadlineCategory;
class HeadlineController extends Controller
{
    
    public function __construct()
    {
        $this->_model = new Headline;
        $this->_model_category = new HeadlineCategory;
        $this->base_img = url('assets/img/galery/');
    }

	public function index(Request $request)
	{
		$input = $request->input();

		$headline = $this->_model->join('posts','posts.id','headline.posts_id')
		->select('headline.id','posts.title')
		->get();
		$headline_category = $this->_model_category->join('menu','menu.id','headline_category.menu_id')
		->select('headline_category.id','menu.name')
		->get();
		$data = array(
			'headline'=>$headline,
			'headline_category'=>$headline_category,
		);
			
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

        $input = $request->only(['id','type']);
        $validation = Validator::make($input, [
                'id' => 'required', // unique:users
                'type' => 'required', // unique:users
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

        if($input['type'] == 'headline'){
	        $data = $id == ''?$this->_model:$this->_model->find($id);
	        $data->posts_id = $input['id'];
        }else{
	        $data = $id == ''?$this->_model_category:$this->_model_category->find($id);
	        $data->menu_id = $input['id'];
        }
        
        $data->save();

		$res = array(
			'msg'=>'success',
			'error'=>false,
			'data'=>$input,
		);
		return $res;
	}
	public function destroy(Request $request,$id)
	{
		$input = $request->input();

		if(isset($input['type']) && $input['type'] == 'headline'){
			$this->_model->find($id)->delete();
		}else if($input['type'] == 'headline_category'){
			$this->_model_category->find($id)->delete();

		}
		//$data = $this->_model->find($id);


		$res = array(
			'msg'=>'success',
			'error'=>false,
			'data'=>$input,
		);
		return $res;
	}
}
