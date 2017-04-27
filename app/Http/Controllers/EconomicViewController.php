<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EconomicView;

class EconomicViewController extends Controller
{
    //
    public function index()
    {
        $economic_view = EconomicView::select('Date', 'GDP Growth Rate(%) as gdp_growth_rate_percent'
        , 'Inflation(%) as inflation_percent', 'Coreinflation(%) as coreinflation_percent'
        , 'Nominal Rate(%) as 	nominal_rate_percent', 'Real Rate(%) as real_rate_percent'
        , 'GDP-Inflation(%) as gdp_inflation_percent' )
        ->where('Date', 'like', '%09')
        ->orWhere('Date', 'like', '%10')
        ->orWhere('Date', 'like', '%11')
        ->orWhere('Date', 'like', '%12')
        ->orWhere('Date', 'like', '%13')
        ->orWhere('Date', 'like', '%14')
        ->orWhere('Date', 'like', '%15')
        ->orWhere('Date', 'like', '%16')
        ->get();

        return response()->json([
            'economic_data'=> $economic_view]) ;
    }
}
