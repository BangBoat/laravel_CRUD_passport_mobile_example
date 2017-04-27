<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    //
    protected $hidden = [ 
        'secret', 'id', 'user_id', 'personal_access_client',
     ];
     //default จะ mass assign ไม่ได้อยู่แล้วไม่ต้องใส่ guarded 
}
