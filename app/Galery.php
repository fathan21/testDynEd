<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    //
    protected $table = 'galery';


    public static function slug($string)
    {
     $d = array (' ','-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
     $string = str_replace($d, '-', $string); // Hilangkan karakter yang telah disebutkan di array $d
     return $string;
    }
}
