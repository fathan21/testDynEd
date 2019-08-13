<?php 
namespace App\Http\Middleware;
use Closure;
use App\User;

class ApiToken {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $token = $request->header('Token');
        if(empty($token)){
            return response()->json([
                'error_code'=>'401',
                'error' => 'Authorization Header is empty'
            ]);
        }
         //cek apakah access_token ini ada di database atau tidak
        $cek = User::where('token', $token)->first();
        if(empty($cek)){
            return response()->json([
                'error_code'=>'401',
                'error' => 'Forbidden : Invalid access token'
            ]);
        }
         //jika semua kondisi dipenuhi, lanjutkan request
        return $next($request);

    }

}