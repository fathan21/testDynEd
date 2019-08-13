<?php

namespace App\Http\Controllers\api\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Mail\ForgotPassword;
class AuthController extends Controller
{

    public function __construct()
    {
        $this->_model = new User;
    }
	public function login(Request $request)
	{
		$input = $request->all();
        
        /*
        $this->_model->find(1)->fill([
            'password' => Hash::make('admin')
        ])->save();
        return array();*/
        

        $input = $request->only(['email', 'password']);
        $validation = Validator::make($input, [
                'password' => 'required|min:2',
                'email' => 'required|email', // unique:users
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

        // $input = array('email'=>'redaksi.jacatra@gmail.com','password'=>'admin');
		$data = $this->_model->whereNull('deleted_at')->where('email',$input['email'])->first();
        
        if(!isset($data->email)){
            $res = array(
                "status"=>"400",
                "error"=>true,
                "msg"=>'email not found',
                'data'=>$data,
            );
            return $res;
        }
        if(!Hash::check($input['password'], $data->password)){
            $res = array(
                "status"=>"400",
                "error"=>true,
                "msg"=>'email or password not match',
                'data'=>array(),
            );
            return $res;
        }

        $data->last_login = date("Y-m-d H:i:s");
        $data->token = Str::random(60);

        $data->save();
        $res = array(
            "status"=>"200",
            "error"=>false,
            "msg"=>'success',
            'data'=>$data,
        );

		return $res;
	}

    public function forgot_password(Request $request)
    {
        $input = $request->all();
        
        /*
        $this->_model->find(1)->fill([
            'password' => Hash::make('admin')
        ])->save();
        return array();*/
        

        $input = $request->only(['email']);
        $validation = Validator::make($input, [
                'email' => 'required|email', // unique:users
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

        // $input = array('email'=>'redaksi.jacatra@gmail.com','password'=>'admin');
        $data = $this->_model->where('email',$input['email'])->first();
        
        if(!isset($data->email)){
            $res = array(
                "status"=>"400",
                "error"=>true,
                "msg"=>'email not found',
                'data'=>$data,
            );
            return $res;
        }

        $password = rand(1000,10000);
        $data->password =Hash::make($password);

        $data->save();

        $data->pwd = $password;
        Mail::to($data->email)->send(new ForgotPassword($data));
        $res = array(
            "status"=>"200",
            "error"=>false,
            "msg"=>'please chek your email',
            'data'=>array(),
        );

        return $res;
    }
    public function getNav(Request $request)
    {
        $token = $request->header('Token');
        $user = User::where('token', $token)->first();
        $data = array();
        if(!isset($user->id)){
            $res = array(
                "status"=>"200",
                "error"=>false,
                "msg"=>'user not found',
                'data'=>array(),
            );
            return $res;
        }


        $data = array(
            array(
                'name'=>'Content',
                'url'=>'/content',
                'icon'=>'fa fa-list',
                'badge'=>array(
                        'variant'=>'',
                        'text'=>''
                    )
            ),
            array(
                'name'=>'Headline',
                'url'=>'/headline',
                'icon'=>'fa fa-home',
                'badge'=>array(
                        'variant'=>'',
                        'text'=>''
                    )
            )
        );
        
        if($user->user_group_id == 1){
            $admin_data = array(

                array(
                    'name'=>'Gambar',
                    'url'=>'/galery',
                    'icon'=>'fa fa-image',
                    'badge'=>array(
                            'variant'=>'',
                            'text'=>''
                        )
                ),
                array(
                    'name'=>'Users',
                    'url'=>'/users',
                    'icon'=>'icon-user',
                    'badge'=>array(
                            'variant'=>'',
                            'text'=>''
                        )
                ),
                array(
                    'name'=>'Category',
                    'url'=>'/category',
                    'icon'=>'fa fa-cube',
                    'badge'=>array(
                            'variant'=>'',
                            'text'=>''
                        )
                ),
            );

            $data = array_merge($admin_data,$data);
        }

        $res = array(
                "status"=>"200",
                "error"=>false,
                "msg"=>'success',
                'data'=>$data,
        );
        return $res;

    }

    public function test(Request $request)
    {

        return view('emails.forgot_password');
    }
}
