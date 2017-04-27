<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\GetScannedStock;

class ScanController extends Controller
{
    //
     public function show(int $id)
    {
        //
       return response()->json([ 'stock_function_data' => GetScannedStock::get_with_id($id)]);
    }
}
