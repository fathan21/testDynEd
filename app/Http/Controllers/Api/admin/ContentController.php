<?php

namespace App\Http\Controllers\api\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Content;
use App\ContentGalery;
use App\ContentSlide;
use App\Posts;
use App\Galery;
use App\PostsMeta;
use App\User;
class ContentController extends Controller
{
    
    public function __construct()
    {
        $this->_model = new Posts;
        $this->base_img = url('assets/img/galery/');
    }

	public function index(Request $request)
	{
		$input = $request->input();

		$limit = isset($input['limit'])?$input['limit']:10;
		$page = isset($input['page'])?$input['page']:1;
		$q = isset($input['q'])?$input['q']:'';
		$category = isset($input['category'])?$input['category']:'';
		$offset = ($page-1) * $limit;

		$article = $this->_model->select('posts.created_at','posts.id','type',
					'title','posts.status','menu_id',
					DB::raw(' IF(menu_p.id !=1 && menu_p.id IS NOT NULL, CONCAT(menu_p.name," - ",menu.name) ,menu.name)  as category')
				)
				->join('menu','menu.id','=','posts.menu_id')
				->join('menu as menu_p','menu_p.id','=','menu.parent','left')
				->whereNull('posts.deleted_at');

		$data = $article;//->union($galery);
		if($q !=''){
			$data = $data->where(function($query) use ($q){
			        $query->where('title', 'like', '%' . $q . '%');
			});
		}
		if($category !=''){
			$category_id = array($category);
			$category_dt = DB::table('menu')->where('parent',$category)->get();
			foreach ($category_dt as $cat_dt) {
				$category_id[] = $cat_dt->id;
			 } 
			$data = $data->where(function($query) use ($category_id){
			        $query->whereIn('menu_id', $category_id );
			});
		}

		$data = $data->skip($offset)->take($limit)->orderBy('created_at','desc')->paginate();

		$data = json_decode(json_encode($data),true);
		//print_r($data);die();
		foreach ($data['data'] as $key => $value) {
			if($value['menu_id'] != 5){
				$writer = DB::table('content')->where('content.posts_id',$value['id'])->join('user','content.writer','=','user.id')->first();
				$data['data'][$key]['writer'] = $writer->full_name;
				$data['data'][$key]['publish_date'] = $writer->publish_date;
				$data['data'][$key]['link'] = '#/p/'.$value['id'];
				
			}
			if($value['menu_id'] == 5){
				$writer = DB::table('content_galery')->where('content_galery.posts_id',$value['id'])->join('user','content_galery.writer','=','user.id')->first();
				$writer = json_decode(json_encode($writer),true);
				$data['data'][$key]['writer'] = $writer['full_name'];
				$data['data'][$key]['publish_date'] = $writer['publish_date'];
				$data['data'][$key]['link'] = '#/p/'.$value['id']."-galery";
			}
		}
		return $data;
	}
	public function show($id)
	{

		$article = $this->_model->select('posts.created_at','posts.id','type',
					'title','posts.status','menu_id',
					DB::raw(' IF(menu_p.id !=1 && menu_p.id IS NOT NULL, CONCAT(menu_p.name," - ",menu.name) ,menu.name)  as category')
				)
				->join('menu','menu.id','=','posts.menu_id')
				->join('menu as menu_p','menu_p.id','=','menu.parent','left')
				->whereNull('posts.deleted_at')->where('posts.id',$id)->first();
		$data = $this->_model
			->select('posts.created_at','posts.id','user.full_name as writer','posts.type','content.photographer',
						'title','posts.status','menu.name as category','content.publish_date',	
						'posts.content','tags as tag',
						'menu.id as category_id','parent_m.id as category_parent_id',
						'galery_id','video'
					);
		if($article->type == 'article' || $article->type ==' video'){
			
			$data = $data->join('content','posts.id','=','content.posts_id')
					->join('posts_meta','posts.id','=','posts_meta.posts_id')
					->join('menu','menu.id','=','posts.menu_id')
					->join('menu as parent_m','parent_m.id','=','menu.parent','left')
					->join('user','user.id','=','content.writer')
			->find($id);
			
			if($data->galery_id!=''){
				$galery = Galery::find($data->galery_id);
				$data->img_prev= $this->base_img.'/'.$galery->img;
			} else{
				$data->img_prev = '';
			}

			$data->galeries = array();
		}else{
			$data = $data->join('content_galery as content','posts.id','=','content.posts_id')
					->join('posts_meta','posts.id','=','posts_meta.posts_id')
					->join('menu','menu.id','=','posts.menu_id')
					->join('menu as parent_m','parent_m.id','=','menu.parent','left')
					->join('user','user.id','=','content.writer')
			->find($id);
			//die;
			$g_id = explode(",", $data->galery_id);
			$galeries = Galery::whereIN('id',$g_id)->get();
			$gl = array();
			foreach ($galeries as $galery) {
				$gl[] = array(
					'img_prev'=>$this->base_img.'/'.$galery->img,
					'galery_id'=>$galery->id,
					'file'=>NULL,
				);
			}
			$data->galeries = $gl;
			$data->img_prev = '';
		}

		$tag= explode(",", $data->tag);
		$tags= array();
		foreach ($tag as $key => $value) {
			$tags[] = array('text'=>$value);
		}

		if($data->category_parent_id == '' || $data->category_parent_id == 1){
			$data->category = $data->category_id;
			$data->category_sub = '';
		}else{
			$data->category = $data->category_parent_id;
			$data->category_sub = $data->category_id;

		}

		$data->tags  = $tags;
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
		$token = $request->header('token');

		$user = User::where('token',$token)->first();
        //$input = $request->only(['title','content']);
        $validation = Validator::make($input, [
                'title' => 'required|min:2', // unique:users
                'content' => 'required|min:2', // unique:users
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

        $posts = $id == ''?$this->_model:$this->_model->find($id);

        $posts->title = $input['title'];
        $posts->content = $input['content'];
        $posts->type = $input['type'];
        $posts->status = $input['status'];
        $posts->menu_id = isset($input['category_sub']) && $input['category_sub']!=''?$input['category_sub']:$input['category'];
        $posts_meta = $id==''?new PostsMeta: PostsMeta::where('posts_id',$id)->first();
	    
	    $tag_i = array();
	    foreach ($input['tags'] as $tag) {
	    	$tag_i[] = $tag['text'];
	    }
	    $posts_meta->tags = implode(",", $tag_i);
        $posts_meta->key_word = $posts_meta->tags;
		$posts_meta->description = substr(strip_tags($posts->content),0,100);


        if($posts->menu_id!=5 ){
        	$content = $id==''?new Content: Content::where('posts_id',$id)->first();
        	$content->photographer = $input['photographer'];
        	$content->video = $input['video'];
        	$content->galery_id = $input['galery_id'];
        	$content->writer = $user->id;
        	$content->photo_caption = $posts->title;

	        if($posts->status == 'publish' && $posts->publish_date==''){
	        	$content->publish_date = date('Y-m-d H:i:s');
	        }

	        $posts->save();
	        $posts_meta->posts_id = $posts->id;
	        $content->posts_id = $posts->id;

	        $posts_meta->save();
	        $content->save();
        }
        if($posts->menu_id ==5){
        	$content = $id==''?new ContentGalery: ContentGalery::where('posts_id',$id)->first();
        	$content->photographer = $input['photographer'];
        	$content->video = $input['video'];
        	$content->galery_id = $input['galery_id'];
        	$content->writer = $user->id;
        	// $content->photo_caption = $posts->title;

	        if($posts->status == 'publish' && $posts->publish_date==''){
	        	$content->publish_date = date('Y-m-d H:i:s');
	        }

	        $posts->save();
	        $posts_meta->posts_id = $posts->id;
	        $content->posts_id = $posts->id;

	        $posts_meta->save();
	        $content->save();
        }
        // $data->name = $input['name'];

        

		$res = array(
			'msg'=>'success',
			'error'=>false,
			'data'=>$token,
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
		$files = $request->file("file");
		$input = $request->input();

		$input_galery_id = $input['galery_id'];

		$data = array();
		foreach ($input_galery_id as $v) {
			if($v!=0 && $v!=''){
				$data[] = (Int)$v;
			}
		}
		foreach ($files as $k=>$file) {

			$filename = Galery::slug($input['name']).'_'.time().$k.".".$file->getClientOriginalExtension();
	        $file->move(public_path('assets/img/galery'), $filename);

	        $in = new Galery;
	        $in->name = $filename;
	        $in->img = $filename;
	        $in->drive = 'local';
	        $in->img_type = 'img';

	        $in->save();
	        $data[] = $in->id;
		}

        $res['data'] = $data;
        $res['error'] = false;
        $res['msg'] = 'success';

        return $res;
	}

    public function getCategoryMenu()
    {

        $q= " SELECT name, id FROM menu WHERE parent = 1 ORDER BY name ASC";
        $menus = DB::select(DB::raw($q));
        $menu = array(

        );
        foreach ($menus as $v) {
            $q= " SELECT id,name FROM menu WHERE parent = $v->id ORDER BY name ASC";
            $detail = DB::select(DB::raw($q));
            $child = array();
            foreach ($detail as $k) {
                $child[] = array('name'=>$k->name,
                    'id'=>$k->id,
                );
            }
            $menu[] = 
                array('name'=>$v->name,
                    'id'=>$v->id,
                    'child'=>$child
                );
        }

        $res['data'] = $menu;
        $res['error'] = false;
        $res['msg'] = 'success';

        return $res;
    }
}
