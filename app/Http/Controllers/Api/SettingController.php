<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SettingController extends Controller
{

    public function __construct()
    {
        $this->base_img = url('assets/img/galery/');
        $this->categories = array(
            array('name'=>'Berita Persija', 'link'=>'berita-persija', 'id'=>'3','class'=>'red'),
            array('name'=>'Artikel', 'link'=>'artikel', 'id'=>'4','class'=>'blue'),
            array('name'=>'Acara', 'link'=>'acara', 'id'=>'16','class'=>'teal'),
        );
    }
    public function get()
    {
        $data = DB::table('company')->first();
        $logo = url($data->logo);
        $data->logo = url($data->logo);

        $data->menu = array(
            array('name'=>'Beranda','link'=>'/',
                    'meta'=>array(
                        'title'=>'Beranda | Jacatranet',
                        'description'=>'Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle',
                        'keywords'=>'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                        'img'=>$logo,
                    )
                ),
            array('name'=>'Berita Persija','link'=>'/c/berita-persija',
                    'meta'=>array(
                        'title'=>' Berita Persija | Jacatranet',
                        'description'=>'Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle',
                        'keywords'=>'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                        'img'=>$logo,
                    )
                ),
            array('name'=>'Artikel','link'=>'/c/artikel',
                    'meta'=>array(
                        'title'=>'Artikel | Jacatranet',
                        'description'=>'Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle',
                        'keywords'=>'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                        'img'=>$logo,
                    )
            ),
            array('name'=>'Acara','link'=>'/c/acara',
                    'meta'=>array(
                        'title'=>'Acara | Jacatranet',
                        'description'=>'Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle',
                        'keywords'=>'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                        'img'=>$logo,
                    )
            ),
            array('name'=>'Galeri','link'=>'/c/galery',
                    'meta'=>array(
                        'title'=>'Galeri | Jacatranet',
                        'description'=>'Sedikit berita, foto dan video tentang Persija Jakarta dan Urban Lifestyle',
                        'keywords'=>'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
                        'img'=>$logo,
                    )
            ),
        );

        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }
    public function categoryHome()
    {
        $categories = $this->categories;
        $data = array();
        foreach ($categories as $category) {
            $q = $this->queryNews(" AND h.id = '".$category['id']."' ORDER BY publish_date DESC LIMIT 1,4 ");
            $news_q = DB::select(DB::raw($q));
            $news = array();
            foreach ($news_q as $new_q) {
                $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                $news[] = $new_q;
            }
            $category['news'] = $news;

            $q = $this->queryNews(" AND h.id = '".$category['id']."' ORDER BY publish_date DESC LIMIT 1 ");
            $news_q = DB::select(DB::raw($q));
            if(isset($news_q[0])){
                    
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
                $img = DB::table('galery')->where('id',$galery[0])->first();
                $new_q->img = $this->base_img.'/'.$img->img;
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
                     CONCAT('$this->base_img','/',d.img) as img,
                     a.content as content_prev,
                     e.full_name as writer
                     FROM posts a 
                     JOIN posts_meta b ON a.id = b.posts_id 
                     JOIN content c ON a.id = c.posts_id
                     JOIN galery d ON d.id = c.galery_id
                     JOIN user e ON c.writer = e.id
                     JOIN menu g ON g.id = a.menu_id
                     JOIN menu h ON h.id = g.parent
                     WHERE 
                     a.deleted_at IS NULL
                     AND a.status='publish'
                     $q_where ";

        }else{
            $q="SELECT a.id,c.publish_date as date, a.title,
                     c.galery_id as img,
                     e.full_name as writer 
                     FROM posts a 
                     JOIN posts_meta b ON a.id = b.posts_id 
                     JOIN content_galery c ON a.id = c.posts_id
                     JOIN user e ON c.writer = e.id
                     WHERE 
                     a.deleted_at IS NULL
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
                     c.publish_date as date, a.title,
                     CONCAT('$this->base_img','/',d.img) as img,
                     a.content,
                     e.full_name as writer
                     FROM posts a 
                     JOIN posts_meta b ON a.id = b.posts_id 
                     JOIN content c ON a.id = c.posts_id
                     JOIN galery d ON d.id = c.galery_id
                     JOIN user e ON c.writer = e.id
                     JOIN menu g ON g.id = a.menu_id
                     JOIN menu h ON h.id = g.parent
                     WHERE 
                     a.deleted_at IS NULL
                     AND  a.id = '$id' ";
        }else if($type=='galery'){
            $q="SELECT a.id,
                     a.*, b.*,c.publish_date as date, a.title,
                     c.galery_id as img,
                     a.content,
                     e.full_name as writer
                     FROM posts a 
                     JOIN posts_meta b ON a.id = b.posts_id 
                     JOIN content_galery c ON a.id = c.posts_id
                     LEFT JOIN user e ON c.writer = e.id
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
        if($type=='galery' && isset($q['id'])){
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

        $q = "  
            SELECT
                posts_id, ctn
                FROM
                (
                SELECT posts_id, SUM(count) as ctn 
                     FROM counter_hits
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
        $cat = isset($filter['cat'])?$filter['cat']:'';

        $q_where = '';
        if($q !=''){
            $q = explode(" ", $q);
            $q_s = array();
            foreach ($q as $v) {
                $q_s[] = " a.title LIKE '%$v%' ";
            }
            $q_s = implode(" || ", $q_s);
            $q_where .=" AND  ($q_s) ";
        }
        $type = 'article';
        if($cat!=''){
            $cat_id = '';
            foreach ($this->categories as $category) {
                if($cat == $category['link']){
                    $q_where = " AND h.id = ".$category['id'];
                    $cat_id = $category['id'];
                    break;
                }
            }
            if($cat_id == ''){
                $type ='galery';
            }
        }
        $q = $this->queryNews('',$type);

        $news_q = DB::select(DB::raw($q." $q_where ORDER BY publish_date DESC LIMIT $start,$limit "));
        $data = array();
        foreach ($news_q as $new_q) {
                if($type == 'article'){
                    $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                    $new_q->link = '/p/'.$new_q->id.'-'.$this->slug($new_q->title);
                    $new_q->comment_count = $this->getCommentCount($new_q->id);
                    
                }else{
                    $new_q->link = '/p/'.$new_q->id.'-galery-'.$this->slug($new_q->title);
                    $galery = explode(",", $new_q->img);
                    $img = DB::table('galery')->where('id',$galery[0])->first();
                    $new_q->img = $this->base_img.'/'.$img->img;
                    
                }
                $data[] = $new_q;
        }

        $news_q = DB::select(DB::raw($q." $q_where"));
        $count = count($news_q);

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

        $q = $this->queryNewsDetail($id,$type);
        $data = $q;
        $data = json_decode(json_encode($data),true);
        $data['type_page'] = $type;

        $data['meta'] = array(
            'title'=>$data['title'].' | Jacatranet',
            'description'=>isset($data['description'])?$data['description']: $data['title']." - ". substr(strip_tags($data['content']),0,100),
            'keywords'=>isset($data['key_word'])?$data['key_word']:'berita, artikel, foto, dan video Tentang Persija Jakarta, Jakmania, Urban Lifestyle',
            'img'=>isset($data['img'])?$data['img']:'',
        );

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
