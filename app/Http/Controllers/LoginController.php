<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OauthClient;
use App\User;
use App\Utils\RequestToken;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Parser;

class LoginController extends Controller
{
    //
    public function create(Request $request)
    { 
        //query login
        $users = DB::table('users')->where([
            ['email', '=', $request->email],
            //['password', '=', bcrypt($request->password)],
        ])->first();

        $oauth_client =  DB::table('oauth_clients')->where('user_id', '=', $users->id)->first();
       // echo $users->password;
         //dd($oauth_client->secret); //ถ้าใช้ get()จะได้เป็น collection แต่ถ้า first() จะได้ object
        if($users != null && $oauth_client != null){
            return RequestToken::create_request($request, $oauth_client);
        } 
        else{
             $json = [
                'message' => '401 Unauthorized',
             ];
            return response()->json($json, '401');
        }
    }

    public function logout(Request $request)
    {
        $value = $request->bearerToken();
        $id= (new Parser())->parse($value)->getHeader('jti');

        $token=  DB::table('oauth_access_tokens')
            ->where('id', '=', $id)
            ->update(['revoked' => true]);

        $json = [
            'message' => 'You are Logged out.',
        ];
        return response()->json($json, '200');
    }
}
