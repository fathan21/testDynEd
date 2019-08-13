<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Galery;
use App\User;
use App\CounterCount;
use Image;
class SettingController extends Controller
{

    public function __construct()
    {
        $this->base_img = url('assets/img/galery/');
        $this->categories = $this->getCategoryMM();
    }
    public function get()
    {
        $data = DB::table('company')->first();
        $logo = url($data->logo);
        $data->logo = url($data->logo);

        $data->menu = $this->getCategoryMenu($logo);
        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }
    public function getCategoryMenu($logo)
    {

        $q= " SELECT name, id FROM menu WHERE parent = 1 ORDER BY seq ASC";
        $menus = DB::select(DB::raw($q));
        $menu = array(
            array('name'=>'Beranda','link'=>'/',
                    'open'=>false,
                    'child'=>[],
                    'meta'=>array(
                        'title'=>'Beranda | Jacatranet',
                        'description'=>'Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle',
                        'keywords'=>'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                        'img'=>$logo,
                    )
                )
        );
        foreach ($menus as $v) {
            $q= " SELECT id,name FROM menu WHERE parent = $v->id ORDER BY seq ASC";
            $detail = DB::select(DB::raw($q));
            $child = array();
            foreach ($detail as $k) {
                $child[] = array('name'=>$k->name,'link'=>'/c/'.$this->slug($k->name),
                    'id'=>$k->id,
                    'meta'=>array(
                        'title'=>$k->name.' | Jacatranet',
                        'description'=>'Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle',
                        'keywords'=>'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                        'img'=>$logo
                    )
                );
            }
            $menu[] = 
                array('name'=>$v->name,'link'=>'/c/'.$this->slug($v->name),
                    'id'=>$v->id,
                    'child'=>$child,
                    'open'=>false,
                    'meta'=>array(
                        'title'=>$v->name.' | Jacatranet',
                        'description'=>'Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle',
                        'keywords'=>'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                        'img'=>$logo,
                    )
                );
        }
        return $menu;
    }
    public function getCategoryMM()
    {

            $q= " 
            SELECT 
            a.id,
            a.name,
            a.parent
            FROM menu a
            WHERE a.is_single_page = 0
            ";
            $detail = DB::select(DB::raw($q));
            $jk = array();
            foreach ($detail as $key => $k) {
                    $q= " 
                    SELECT 
                    a.id,
                    a.name 
                    FROM menu a
                    WHERE a.parent = '".$k->id."'
                    AND a.is_single_page = 0
                ";
                $q = DB::select(DB::raw($q));
                $id = array();
                foreach ($q as $Qk) {
                    $id[] = $Qk->id;
                }
                $id = implode(",", $id);
                if($id !=''){
                    $id = $id.",".$k->id;
                }else{
                    $id = $k->id;
                }
                $jk[] = array('menu_id'=>$k->id,'name'=>$k->name,'slug'=>$this->slug($k->name),'id'=>$id,'link'=>"/c/".$this->slug($k->name),'parent'=>$k->parent);

            }
        return $jk;
    }
    public function categoryHome()
    {

        $headline = DB::table('headline_category')->select('menu_id')->get();
        $headline_id = array();
        foreach ($headline as $key => $value) {
            $headline_id[] = $value->menu_id;
        }

        //$headline_id = implode(",", $headline_id);

        $categories = $this->categories;

        $data = array();
        $no = 0;
        foreach ($categories as $k =>$category) {
            if($category['parent'] != 1){
                //continue;
            }
            if (!in_array($category['menu_id'], $headline_id))
            {
                continue;
            }
            $q = $this->queryNews(" AND g.id in ('".$category['id']."') ORDER BY publish_date DESC LIMIT 1,4 ");
            $news_q = DB::select(DB::raw($q));
            if($no == 2){
                // break;
            }
            if(count($news_q) > 0 ){
                $category['class'] = 'red';

                $no +=1;
            }else{
                continue;
            }
            $news = array();
            foreach ($news_q as $new_q) {
                if($new_q->galery_id !='' && $new_q->type=='article'){
                    $galery = Galery::find($new_q->galery_id);
                    //$new_q->img = $this->base_img."/".$galery->img;
                    $img_u = public_path('assets/img/galery/'.$galery->img);
                    $img_u =  url('img/'.$galery->img.'/80/80');//Image::make($img_u)->fit(80)->encode('data-url');
                    $new_q->img = $img_u;//$img_u->encoded;
                }else{
                    $video = explode("/", $new_q->video);
                    $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                }
                $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                $news[] = $new_q;
            }
            $category['news'] = $news;

            $q = $this->queryNews(" AND g.id in ('".$category['id']."') ORDER BY publish_date DESC LIMIT 1 ");
            $news_q = DB::select(DB::raw($q));
            if(isset($news_q[0])){
                
                if($news_q[0]->galery_id !='' && $news_q[0]->type=='article'){
                    $galery = Galery::find($news_q[0]->galery_id);
                    //$news_q[0]->img = $this->base_img."/".$galery->img;
                    $img_u = public_path('assets/img/galery/'.$galery->img);
                    $img_u = url('img/'.$galery->img.'/600/500');// Image::make($img_u)->fit(600,500)->encode('data-url');
                    $news_q[0]->img = $img_u;//$img_u->encoded;
                }else{
                    $video = explode("/", $news_q[0]->video);
                    $news_q[0]->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                }
                $news_q[0]->content_prev = substr(strip_tags($news_q[0]->content_prev),0,50)." ...";
                $news_q[0]->link = '/p/'.$news_q[0]->id.'-'.$this->slug($news_q[0]->title);
                $category['news_header'] = $news_q[0];   
            }

            $data[] = $category;
        }

        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;

    }

    public function galeryHome()
    {
        $q = $this->queryNews(" ORDER BY publish_date DESC LIMIT 6 ",'galery');
        $news_q = DB::select(DB::raw($q));
        $data = array();
        foreach ($news_q as $new_q) {
                $new_q->link = '/p/'.$new_q->id.'-galery-'.$this->slug($new_q->title);
                $galery = explode(",", $new_q->img);
                 if($new_q->img !='' ){
                    $img = DB::table('galery')->where('id',$galery[0])->first();
                    $new_q->img = $this->base_img.'/'.$img->img;
                }else{
                    $video = explode("/", $new_q->video);
                    $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                }
                $data[] = $new_q;
        }
        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }

    public function slug($string)
    {
     $string = strtolower($string);
     $d = array (' ','-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
     $string = str_replace($d, '-', $string); // Hilangkan karakter yang telah disebutkan di array $d
     return $string;
    }
    public function queryNews($q_where = '', $type='article')
    {
        if($type == 'article'){
            $q="SELECT a.id ,c.publish_date as date, a.title,
                     a.content as content_prev,a.type,c.video, c.galery_id,
                     e.full_name as writer
                     FROM posts a 
                     JOIN posts_meta b ON a.id = b.posts_id 
                     JOIN content c ON a.id = c.posts_id
                     JOIN user e ON c.writer = e.id
                     JOIN menu g ON g.id = a.menu_id
                     JOIN menu h ON h.id = g.parent
                     WHERE 
                     a.deleted_at IS NULL
                     AND a.status='publish'
                     $q_where ";

        }else{
            $q="SELECT a.id,c.publish_date as date, a.title,
                     c.galery_id as img,c.video,
                     e.full_name as writer 
                     FROM posts a 
                     JOIN posts_meta b ON a.id = b.posts_id 
                     JOIN content_galery c ON a.id = c.posts_id
                     JOIN user e ON c.writer = e.id
                     WHERE 
                     a.deleted_at IS NULL
                     AND a.status='publish'
                     $q_where ";

        }
        return $q;

    }

    public function queryNewsDetail($id, $type='article')
    {
        if($type == 'article'){
            $q="SELECT a.id,
                     b.*,
                     a.*,
                     c.*,
                     c.photographer as sumber,
                     c.publish_date as date, a.title,
                     a.content,
                     e.full_name as writer
                     FROM posts a 
                     JOIN posts_meta b ON a.id = b.posts_id 
                     JOIN content c ON a.id = c.posts_id
                     JOIN user e ON c.writer = e.id
                     JOIN menu g ON g.id = a.menu_id
                     JOIN menu h ON h.id = g.parent
                     WHERE 
                     a.deleted_at IS NULL
                     AND  a.id = '$id' ";
        }else if($type=='galery'){
            $q="SELECT a.id,
                     a.*, b.*,c.publish_date as date, a.title,
                     c.galery_id as img,c.video,
                     a.content,
                     e.full_name as writer
                     FROM posts a 
                     JOIN posts_meta b ON a.id = b.posts_id 
                     JOIN content_galery c ON a.id = c.posts_id
                     JOIN user e ON c.writer = e.id
                     WHERE 
                     a.deleted_at IS NULL
                     AND  a.id = '$id' ";

        }else{
            $q="SELECT a.id, a.title,
                     a.content
                     FROM posts a 
                     WHERE 
                     a.deleted_at IS NULL
                     AND  a.id = '$id' ";

        }
        $q = DB::select(DB::raw($q));
        $q = isset($q[0])?$q[0]:array();
        $q = json_decode(json_encode($q),true);

        if($type=='article' && isset($q['id'])){
            // cek content slide
            $content_slide = " SELECT a.* , CONCAT('$this->base_img','/',b.img) as img
                     FROM content_slide a 
                     JOIN galery b ON a.galery_id = b.id
                     WHERE 
                     a.deleted_at IS NULL
                     AND a.posts_id = '$id'
                     ORDER BY a.display_order ASC
                     ";
            $content_slide = DB::select(DB::raw($content_slide));
            
            $q['content_slide'] = $content_slide;//array_push($q,$content_slide);

        }
        if($type=='galery' && isset($q['id']) && $q['img']!=''){
            // get galery image
            $content_slide = " SELECT a.name , CONCAT('$this->base_img','/',a.img) as img
                     FROM  galery a
                     WHERE 
                     a.deleted_at IS NULL
                     AND a.id IN (".$q['img'].")
                     ";

            $content_slide = DB::select(DB::raw($content_slide));
            $q['imgs'] = $content_slide;
            $q['img'] = $content_slide[0]->img;
        }
        return $q;

    }

    public function getPopularId()
    {

        $last_30 = date("Y-m-d", strtotime("-7 days"));
        $now = date('Y-m-d');

        $q = "  
             SELECT SUM(a.count) as ctn, a.posts_id
                FROM counter_hits a
                JOIN posts b ON a.posts_id = b.id
                WHERE 
                a.posts_id != ''
                    AND ( b.type = 'article' || b.type = 'video' )
                    AND (b.created_at BETWEEN '$last_30' AND '$now' )
                GROUP by a.posts_id
                ORDER by ctn DESC
                LIMIT 5
                     ";
        $q = DB::select(DB::raw($q));


        $result = array();
        foreach ($q as $k => $v) {
            $result[] = $v->posts_id;
        }
        $result = implode(",", $result);

        return $result;
    }

    public function getCommentId()
    {

        $q = "  
            SELECT
                posts_id, ctn
                FROM
                (
                SELECT posts_id, COUNT(posts_id) as ctn 
                     FROM posts_comment
                     WHERE posts_id !=''
                     GROUP BY posts_id
                ) as tb 
                ORDER BY ctn DESC
                LIMIT 5
                     ";
        $q = DB::select(DB::raw($q));

        $result = array();
        foreach ($q as $k => $v) {
            $result[] = $v->posts_id;
        }
        $result = implode(",", $result);
        return $result;
    }
    public function getCommentCount($posts_id)
    {

        $q = "  
                SELECT posts_id, COUNT(posts_id) as ctn 
                     FROM posts_comment
                     WHERE posts_id =$posts_id
                     GROUP BY posts_id
                     ";
        $q = DB::select(DB::raw($q));
        $q = isset($q[0])?$q[0]->ctn:'0';
        return $q;
    }
    public function sidebar()
    {

        $last_30 = date("Y-m-d", strtotime("-14 days"));
        $now = date('Y-m-d');

        $q = $this->queryNews(" ORDER BY publish_date DESC LIMIT 5 ");
        $news_q = DB::select(DB::raw($q));
        $latest = array();
        $q_where = '';
        foreach ($news_q as $new_q) {
                if($new_q->galery_id !='' && $new_q->type=='article'){
                    $galery = Galery::find($new_q->galery_id);
                    //$new_q->img = $this->base_img."/".$galery->img;
                    $img_u = public_path('assets/img/galery/'.$galery->img);
                    $img_u =  url('img/'.$galery->img.'/80/80');//Image::make($img_u)->fit(80)->encode('data-url');
                    $new_q->img = $img_u;//$img_u->encoded;
                }else{
                    $video = explode("/", $new_q->video);
                    $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                }

                $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                $latest[] = $new_q;
        }

        $q_where = '';
        $popular_id = $this->getPopularId();

        if($popular_id!=''){
            $q_where = " AND a.id IN ($popular_id)";
        }
        $q = $this->queryNews(" $q_where ORDER BY publish_date DESC LIMIT 5 ");
        $news_q = DB::select(DB::raw($q));

        $populer = array();
        foreach ($news_q as $new_q) {
                if($new_q->galery_id !='' && $new_q->type=='article'){
                    $galery = Galery::find($new_q->galery_id);
                    //$new_q->img = $this->base_img."/".$galery->img;
                    $img_u = public_path('assets/img/galery/'.$galery->img);
                    $img_u =  url('img/'.$galery->img.'/80/80');//Image::make($img_u)->fit(80)->encode('data-url');
                    $new_q->img = $img_u;
                }else{
                    $video = explode("/", $new_q->video);
                    $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                }
                $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                $populer[] = $new_q;
        }

        $comment_id = $this->getCommentId();
        if($comment_id!=''){
            $q_where = " AND a.id IN ($comment_id) ";
        }
        $q = $this->queryNews(" $q_where ORDER BY publish_date DESC LIMIT 5 ");
        $news_q = DB::select(DB::raw($q));
        $comment = array();
        foreach ($news_q as $new_q) {
                if($new_q->galery_id !='' && $new_q->type=='article'){
                    $galery = Galery::find($new_q->galery_id);
                    //$new_q->img = $this->base_img."/".$galery->img;
                    $img_u = public_path('assets/img/galery/'.$galery->img);
                    $img_u =  url('img/'.$galery->img.'/80/80');//Image::make($img_u)->fit(80)->encode('data-url');
                    $new_q->img = $img_u;
                }else{
                    $video = explode("/", $new_q->video);
                    $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                }
                $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                $new_q->comment_count = $this->getCommentCount($new_q->id);
                $comment[] = $new_q;
        }



        $data['most_comment'] = $comment;
        $data['latest'] = $latest;
        $data['populer'] = $populer;
        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }
    public function news(Request $request)
    {
        $filter = $request->input('filter');
        $page = isset($filter['page'])?$filter['page']:'1';
        $limit = isset($filter['limit'])?$filter['limit']:'5';
        $start = ($page - 1 ) * $limit;
        $q = isset($filter['q'])?$filter['q']:'';
        $tag = isset($filter['tag'])?$filter['tag']:'';
        $cat = isset($filter['cat'])?$filter['cat']:'';
        $writer = isset($filter['writer'])?$filter['writer']:'';

        $q_where = '';
        $is_searh = false;
        if($q !=''){
            $is_searh = true;
            $q = explode(" ", $q);
            $q_s = array();
            foreach ($q as $v) {
                $q_s[] = " a.title LIKE '%$v%' ";
            }
            $q_s = implode(" || ", $q_s);
            $q_where .=" AND  ($q_s) ";
        }
        if($tag!=''){
            $is_searh = true;
            $q_where .=" AND (tags LIKE '%$tag%' || key_word LIKE '%$tag%') ";
        }
        if($writer!=''){
            $is_searh = true;
            $user = User::where('full_name',$writer)->first();
            if(isset($user->id)){
                $q_where .=" AND e.id = '$user->id'";   
            }
        }
        $type = 'article';
        if($cat!=''){
            $cat_id = '';
                if($cat=='galeri'){
                    $type ='galery';
                }
            foreach ($this->categories as $category) {
                if($cat == $category['slug']){
                    $q_where = " AND g.id in ('".$category['id']."') ";
                    $cat_id = $category['id'];
                    break;
                }
            }
        }
        $q = $this->queryNews('',$type);
        
        if($start==0 && !$is_searh){
            $main = DB::select(DB::raw($q." $q_where ORDER BY publish_date DESC LIMIT 1 "));
            $main = isset($main[0]->title)?$main[0]:array();
            if(isset($main->title)){
                if($type == 'article'){
                        if($main->galery_id !='' && $main->type=='article'){
                            $galery = Galery::find($main->galery_id);
                            //$main->img = $this->base_img."/".$galery->img;

		                    $img_u = public_path('assets/img/galery/'.$galery->img);
                            $img_u_m = url('img/'.$galery->img.'/600/500'); //Image::make($img_u)->fit(600,500)->encode('data-url');
		                    $img_u =  url('img/'.$galery->img.'/600/300');//Image::make($img_u)->fit(600,300)->encode('data-url');
		                    $main->img = $img_u;//$img_u->encoded;
                            $main->img_m = $img_u_m;//$img_u_m->encoded;
                        }else{
                            $video = explode("/", $main->video);
                            $main->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                        }
                        $main->content_prev = substr(strip_tags($main->content_prev),0,50)." ...";
                        $main->link = '/p/'.$main->id.'-'.$this->slug($main->title);
                        $main->comment_count = $this->getCommentCount($main->id);
                        
                }else{
                        $main->link = '/p/'.$main->id.'-galery-'.$this->slug($main->title);
                         if($main->img !='' ){
                            $galery = explode(",", $main->img);
                            $img = DB::table('galery')->where('id',$galery[0])->first();
                            // $main->img = $this->base_img.'/'.$img->img;

		                    $img_u = public_path('assets/img/galery/'.$img->img);
                            $img_u_m =  url('img/'.$img->img.'/600/500');//Image::make($img_u)->fit(600,500)->encode('data-url');
		                    $img_u =  url('img/'.$img->img.'/600/500');//Image::make($img_u)->fit(600,300)->encode('data-url');
		                    $main->img = $img_u;//$img_u->encoded;
                            $main->img_m = $img_u_m;//$img_u_m->encoded;
                        }else{
                            $video = explode("/", $main->video);
                            $main->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                        }
                        
                }
            } 
            $start = $start+1;
            $limit = $limit;   
        }else{
            $main = array();
        }

        $news_q = DB::select(DB::raw($q." $q_where ORDER BY publish_date DESC LIMIT $start,$limit "));
        $data = array();
        foreach ($news_q as $new_q) {
                if($type == 'article'){
                    if($new_q->galery_id !='' && $new_q->type=='article'){
                        $galery = Galery::find($new_q->galery_id);
                        //$new_q->img = $this->base_img."/".$galery->img;
                        $img_u = public_path('assets/img/galery/'.$galery->img);
                        $img_u = '';// Image::make($img_u)->fit(408,306)->encode('data-url');

                        $new_q->img =url('img/'.$galery->img.'/408/306'); //$img_u->encoded;
                    }else{
                        $video = explode("/", $new_q->video);
                        $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                    }
                    $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                    $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                    $new_q->comment_count = $this->getCommentCount($new_q->id);
                    
                }else{
                    $new_q->link = '/p/'.$new_q->id.'-galery-'.$this->slug($new_q->title);
                     if($new_q->img !='' ){
                        $galery = explode(",", $new_q->img);
                        $img = DB::table('galery')->where('id',$galery[0])->first();
                        //$new_q->img = $this->base_img."/".$galery->img;
                        $img_u = public_path('assets/img/galery/'.$img->img);
                        $img_u =  '';//Image::make($img_u)->fit(408,306)->encode('data-url');

                        $new_q->img =url('img/'.$img->img.'/408/306');// $img_u->encoded;
                    }else{
                        $video = explode("/", $new_q->video);
                        $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                    }
                    
                }
                $data[] = $new_q;
        }

        $news_q = DB::select(DB::raw($q." $q_where"));
        $count = count($news_q);

        $return['q_where'] = $q_where;
        $return['count'] = $count;
        $return['data'] = $data;
        $return['main'] = $main;
        $return['type'] = $type;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }

    public function headline(Request $request)
    {
        $headline = DB::table('headline')->select('posts_id')->get();

        $headline_id = array();
        foreach ($headline as $key => $value) {
            $headline_id[] = $value->posts_id;
        }
        $start = 0;
        $limit = 10;
        
        $headline_id = implode(",", $headline_id);

        $q_where = " AND a.id IN ($headline_id) ";
        
        $type = 'article';
        
        $q = $this->queryNews('',$type);

        $news_q = DB::select(DB::raw($q." $q_where ORDER BY publish_date DESC LIMIT $start,$limit "));
        $data = array();
        foreach ($news_q as $new_q) {
                if($type == 'article'){
                    
                    if($new_q->galery_id !='' && $new_q->type=='article'){
                        $galery = Galery::find($new_q->galery_id);
                        //$new_q->img = $this->base_img."/".$galery->img;
                         //$new_q->img = $this->base_img."/".$galery->img;
	                    $img_u = public_path('assets/img/galery/'.$galery->img);
                        //$img_u_m =  Image::make($img_u)->fit(600,500)->encode('data-url');
	                    //$img_u =  Image::make($img_u)->fit(600,300)->encode('data-url');
	                    $new_q->img =url('img/'.$galery->img.'/600/300');// $img_u->encoded;
                        $new_q->img_m = url('img/'.$galery->img.'/600/500');//$img_u_m->encoded;
                    }else{
                        $video = explode("/", $new_q->video);
                        $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                    }
                    $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                    $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                    $new_q->comment_count = $this->getCommentCount($new_q->id);
                    
                }else{
                    $new_q->link = '/p/'.$new_q->id.'-galery-'.$this->slug($new_q->title);
                     if($new_q->img !='' ){
                        $galery = explode(",", $new_q->img);
                        $img = DB::table('galery')->where('id',$galery[0])->first();
	                    $img_u = public_path('assets/img/galery/'.$img->img);
                        //$img_u_m =  Image::make($img_u)->fit(600,500)->encode('data-url');
	                    //$img_u =  Image::make($img_u)->fit(600,300)->encode('data-url');
	                    $new_q->img = url('img/'.$galery->img.'/600/300');//$img_u->encoded;
                        $new_q->img_m = url('img/'.$galery->img.'/600/500');//$img_u_m->encoded;
                    }else{
                        $video = explode("/", $new_q->video);
                        $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                    }
                    
                }
                $data[] = $new_q;
        }

        $news_q = DB::select(DB::raw($q." $q_where"));
        $count = count($news_q);

        $return['q_where'] = $q_where;
        $return['count'] = $count;
        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }

    public function news_detail(Request $request,$link)
    {
        $page_no_comment = array('hubungi-kami','tentang-kami');

        $id = 0;
        if(in_array($link, $page_no_comment)){
            // single page
            $type = 'page';
            if($link == 'hubungi-kami'){
                $id = 2;
            }
            if($link == 'tentang-kami'){
                $id = 1;
            }
        }else{
            $link = explode("-", $link);
            if(isset($link[1]) && $link[1] == 'galery'){
                $type = 'galery';
                $id = $link[0];
            }else{
                $type = 'article';
                $id = $link[0];
            }
        }
        // update populer

        $input_s = array();
        $input_s["page"] = 'read';
        $input_s["posts_id"] = $id;
        $input_s["date"] = date('Y-m-d');
        $chk_p = CounterCount::where('posts_id',$id)->first();
        if(isset($chk_p->id)){
            $chk_p->page = 'read';
            $chk_p->count = $chk_p->count+1;
            $chk_p->date = date("Y-m-d");
            $chk_p->save();
        }else{
            $chk_p = new CounterCount;
            $chk_p->count = 1;
            $chk_p->page = 'read';
            $chk_p->date = date("Y-m-d");
            $chk_p->posts_id = $id;
            $chk_p->save();
        }

        $q = $this->queryNewsDetail($id,$type);
        $data = $q;
        $data = json_decode(json_encode($data),true);
        $data['type_page'] = $type;

        if(isset($data['title'])){

            $data['meta'] = array(
                'title'=>$data['title'].' | Jacatranet',
                'description'=>isset($data['description'])?$data['description']: $data['title']." - ". substr(strip_tags($data['content']),0,100),
                'keywords'=>isset($data['key_word'])?$data['key_word']:'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                'img'=>isset($data['img'])?$data['img']:'',
            );   
        }
        if( isset($data['galery_id']) && $data['galery_id'] !='' && $data['type']=='article'){
            $galery = Galery::find($data['galery_id']);
            $data['img'] = $this->base_img."/".$galery->img;
        } 



        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }

    public function news_detail_related(Request $request,$link)
    {

        $link = explode("-", $link);

        $q_where = array();
        foreach ($link as $key => $value) {
            $q_where[] = " title LIKE '%$value%' ";
        }
        if(count($q_where) > 0){
            $q_where = implode(" ||  ", $q_where);
            $q_where = " AND ($q_where) ";
        }

        $q_where .= " AND a.id != ".$link[0]." ";


        $q = $this->queryNews();
        $news_q = DB::select(DB::raw($q." $q_where ORDER BY publish_date DESC LIMIT 5  "));
        $data=array();
        foreach ($news_q as $new_q) {

                if($new_q->galery_id !='' && $new_q->type=='article'){
                    $galery = Galery::find($new_q->galery_id);
                    //$new_q->img = $this->base_img."/".$galery->img; 
                    // ->encode('jpg', 75)
                    $img_u = public_path('assets/img/galery/'.$galery->img);
                    $img_u = url('img/'.$galery->img.'/80/80');//Image::make($img_u)->fit(80)->encode('data-url');
                    $new_q->img = $img_u;//$img_u->encoded;
                }else{
                    $video = explode("/", $new_q->video);
                    $new_q->img = 'https://img.youtube.com/vi/'.end($video).'/hqdefault.jpg';
                }
                $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                $data[] = $new_q;
        }
        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }

}
