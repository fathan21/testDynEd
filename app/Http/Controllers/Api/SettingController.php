<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class SettingController extends Controller
{

    public function __construct()
    {
        $this->base_img = url('assets/img/galery/');
        
    }
    public function get()
    {
        $data = DB::table('company')->first();
        $data->logo = url($data->logo);

        $data->menu = array(
            array('name'=>'Beranda','link'=>'/','meta_desc'=>'','meta_keywords'=>'','meta_title'=>'jacatranet'),
            array('name'=>'Berita Persija','link'=>'/c/berita-persija','meta_desc'=>'','meta_keywords'=>'','meta_title'=>'Berita Persija | jacatranet'),
            array('name'=>'Artikel','link'=>'/c/artikel','meta_desc'=>'','meta_keywords'=>'','meta_title'=>'Artikel | jacatranet'),
            array('name'=>'Acara','link'=>'/c/acara','meta_desc'=>'','meta_keywords'=>'','meta_title'=>'Acara | jacatranet'),
            array('name'=>'Galeri','link'=>'/c/galery','meta_desc'=>'','meta_keywords'=>'','meta_title'=>'Galeri | jacatranet'),
        );

        $return['data'] = $data;
        $return['error'] = false;
        $return['msg'] = "success";
        return $return;
    }
    public function categoryHome()
    {
        $categories = array(
            array('name'=>'Berita Persija', 'link'=>'berita-persija', 'id'=>'3','class'=>'red'),
            array('name'=>'Artikel', 'link'=>'artikel', 'id'=>'4','class'=>'blue'),
            array('name'=>'Acara', 'link'=>'acara', 'id'=>'16','class'=>'teal'),
        );
        $data = array();
        foreach ($categories as $category) {
            $q = $this->queryNews(" AND h.id = '".$category['id']."' ORDER BY publish_date DESC LIMIT 1,4 ");
            $news_q = DB::select(DB::raw($q));
            $news = array();
            foreach ($news_q as $new_q) {
                $new_q->content_prev = substr(strip_tags($new_q->content_prev),0,50)." ...";
                $new_q->link = 'p/'.$new_q->id.'-'.$this->slug($new_q->title);
                $news[] = $new_q;
            }
            $category['news'] = $news;

            $q = $this->queryNews(" AND h.id = '".$category['id']."' ORDER BY publish_date DESC LIMIT 1 ");
            $news_q = DB::select(DB::raw($q));
            $news_q[0]->content_prev = substr(strip_tags($news_q[0]->content_prev),0,50)." ...";
            $news_q[0]->link = 'p/'.$news_q[0]->id.'-'.$this->slug($news_q[0]->title);
            $category['news_header'] = $news_q[0];

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
                $new_q->link = 'p/'.$new_q->id.'-galery-'.$this->slug($new_q->title);
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
}
