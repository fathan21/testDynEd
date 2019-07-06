<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Storage;
class InquiryController extends Controller
{
    /**
     * Send the error response.
     *
     * @param  string|\Exception $message
     * @param  int $httpCode
     * @return \Illuminate\Http\Response
     */
	 
	public $data = [];
    public function __construct() {


	}

    function slug($string)
    {
     $d = array (' ','-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
     $string = str_replace($d, '-', $string); // Hilangkan karakter yang telah disebutkan di array $d
     return $string;
    }
    public function inquiryUpload(Request $request)
    {

        $input = $request->all();
        // $input_data = $request->only(['company_address', 'company_name','cp_name','cp_phone','email','note','file']);
        $input_data = $request->only(['company_address', 'company_name','cp_name','cp_phone','email','note','product']);
        $validation = Validator::make($request->all(), [
                'company_address' => 'required|min:20',
                'company_name' => 'required|min:2',
                'cp_name' => 'required',
                'cp_phone' => 'required|numeric',
                'email' => 'required|email',
                'note' => 'required',
        ]);

        if ($validation->fails()) {
                $errorString = implode(",",$validation->messages()->all());
                $response = array(
                    "status"=>"400",
                    "error"=>true,
                    "message"=>"validation error ".$errorString,
                    'data'=>$validation->errors(),
            );
            return $response;
        }

        $file = $request->file("file");
        //$file->move('inquiry',$file->getClientOriginalName());
        $filename = $this->slug($input['company_name'])."-".$this->slug($input['cp_name'])."-".time().".".$file->getClientOriginalExtension(); //time().'.'.$file->getClientOriginalExtension();
        // $file->store('inquiry/'.$filename, ['disk' => 'public']);


        $file = $request->file("file");
        $file->move('/megakamera/backend/uploads/inquiry/', $filename);

        $res['data'] = $filename;
        $res['status'] = 'ok';
        $res['message'] = 'success send inquiry';

        return $res;
    }
    public function save(Request $request)
    {

        $input = $request->json()->all();
        //$input_data = $request->only(['company_address', 'company_name','cp_name','cp_phone','email','note','file']);
        $input_data = $request->only(['company_address', 'company_name','cp_name','cp_phone','email','note','product']);
        $validation = Validator::make($request->json()->all(), [
                'company_address' => 'required',
                'company_name' => 'required',
                'cp_name' => 'required',
                'cp_phone' => 'required',
                'email' => 'required',
                'note' => 'required',
                'product' => 'required',
        ]);

        if ($validation->fails()) {
                $response = array(
                    "status"=>"400",
                    "error"=>true,
                    "message"=>"validation error"
            );
            return $response;
        }
        $product = $input['product'];
        $file = '';//$input['file'];
        $input_db = [
            "INQ-".date("Ymdhis"),
            $input['cp_name'],
            $input['company_name'],
            $input['company_address'],
               $input['cp_phone'],
               $input['email'],
               $input['note'],
               $file,
               0,
               date("Y-m-d H:i:s")
        ];
        $d = DB::select(DB::raw(" select * from inquiry_ec  "));
        DB::insert('insert into inquiry_ec (
            inquiry_number,
            cp_name,
            company,
            address,
            phone,
            email,
            note,
            inquiry_file,
            is_read,
            created_time
            ) values(?,?,?,?,?,?,?,?,?,?)',[
                "INQ-".date("Ymdhis"),
                $input['cp_name'],
                $input['company_name'],
                $input['company_address'],
                $input['cp_phone'],
                $input['email'],
                $input['note'],
                $file,
                0,
                date("Y-m-d H:i:s")
            ]);
        $res['input'] = $d;
        $res['status'] = 'ok';
        $res['message'] = 'success send inquiry';

        return $res;
    }


}