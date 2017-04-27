<?php

namespace App\Utils;

use GuzzleHttp\Client;
use App\OauthClient;
use Illuminate\Http\Request;


/**
 * 
 */
class RequestToken 
{
    
   private function __construct()
    {
        # code...
    }
   public static function create_request(Request $request, $oauth_client){
          
              /***** for server with cert ********
               $http = new Client(['base_uri' => 'https://example.com'
                        , 'verify' => '/etc/ssl/certs/apache-selfsigned.crt']); 
                        $response = $http->post('/oauth/token', [
             *****/
                $http = new Client;
                $response = $http->post('http://localhost/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $oauth_client->id,
                    'client_secret' => $oauth_client->secret,
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                    ],
                ]);
           return json_decode((string) $response->getBody(), true);
   }
}
