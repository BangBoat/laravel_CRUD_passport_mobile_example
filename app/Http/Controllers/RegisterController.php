<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\OauthClient;
use Validator;
use App\Utils\RequestToken;

class RegisterController extends Controller
{
      public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            //$errors = $validator->errors();
             return [
                 'message' => 'user not created.'
                 ];
        }

        else {
        $email = $request->input('email');
        $name = $request->name;
        $password = $request->input('password');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            //'api_token' => str_random(60),
            'password' => bcrypt($password),
        ]);

        $oauth_client = new OauthClient();
        $oauth_client->user_id = $user->id;
        //$oauth_client->id =  crc32($email); 
        $oauth_client->name=$user->name;
        $oauth_client->secret=base64_encode(hash_hmac('sha256',$password, '$ecre+', true));
        $oauth_client->password_client=1;
        $oauth_client->personal_access_client=0;
        $oauth_client->redirect='';
        $oauth_client->revoked=0;
        $oauth_client->save();

        //return RequestToken::create_request($request, $oauth_client);
         return [
                 'message' => 'Register completed'
                 ];
        }
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
