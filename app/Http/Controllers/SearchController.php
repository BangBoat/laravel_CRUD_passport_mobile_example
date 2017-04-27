<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Search2013;
use App\Models\Search2014;
use App\Models\Search2015;
use App\Models\Search2016;

class SearchController extends Controller
{
     private $data_name = array();

     public function search(Request $request)
    {
        //
      $search_2013 = Search2013::select(  'stock_name as name', 
                                            'rev as revenue',
                                            'sale',
                                            'cost_sale',
                                            'netpf as net_profit',
                                            'eps',
                                            'gfm(%) as gfm_percent',
                                            'npm(%) as npm_percent',
                                            'roe(%) as roe_percent',
                                            'dps',
                                            've as as fair_price_pe',
                                            'vbv as fair_price_pbv'
                                         )->where('stock_name', '=', $request->search)->get(); 

      $search_2014 = Search2014::select(  'stock_name as name', 
                                            'rev as revenue',
                                            'sale',
                                            'cost_sale',
                                            'netpf as net_profit',
                                            'eps',
                                            'gfm(%) as gfm_percent',
                                            'npm(%) as npm_percent',
                                            'roe(%) as roe_percent',
                                            'dps',
                                            've as as fair_price_pe',
                                            'vbv as fair_price_pbv'
                                         )->where('stock_name', '=', $request->search)->get(); 

      $search_2015 = Search2015::select(  'stock_name as name', 
                                            'rev as revenue',
                                            'sale',
                                            'cost_sale',
                                            'netpf as net_profit',
                                            'eps',
                                            'gfm(%) as gfm_percent',
                                            'npm(%) as npm_percent',
                                            'roe(%) as roe_percent',
                                            'dps',
                                            've as as fair_price_pe',
                                            'vbv as fair_price_pbv'
                                         )->where('stock_name', '=', $request->search)->get();

      $search_2016 = Search2016::select(  'stock_name as name', 
                                            'rev as revenue',
                                            'sale',
                                            'cost_sale',
                                            'netpf as net_profit',
                                            'eps',
                                            'gfm(%) as gfm_percent',
                                            'npm(%) as npm_percent',
                                            'roe(%) as roe_percent',
                                            'dps',
                                            've as as fair_price_pe',
                                            'vbv as fair_price_pbv'
                                         )->where('stock_name', '=', $request->search)->get();
                                                                          
      $array1 = $search_2013->toArray();
      $array2 = $search_2014->toArray();
      $array3 = $search_2015->toArray();
      $array4 = $search_2016->toArray();
      $result = array_merge($array1, $array2, $array3, $array4);
        if($search_2013->isEmpty() && $search_2014->isEmpty() && $search_2015->isEmpty() 
        && $search_2016->isEmpty())
      {
          return response()->json(
           [ 'exist' => false,
               'stock_search' => $result
           ]
       );                
      } 

       return response()->json(
           [ 'exist' => true,
               'stock_search' => $result
           ]
       );                             
    }
    
    public function index(){
      global $data_name;  
      foreach(Search2013::select('stock_name as name')
                                         ->orderBy('name')
                                         ->cursor() as $search) {
                                            $data_name[] = $search->name;
                                         }
     foreach(Search2014::select('stock_name as name')
                                         ->orderBy('name')
                                         ->cursor() as $search) {
                                            $data_name[] = $search->name;
                                         }
     foreach(Search2015::select('stock_name as name')
                                         ->orderBy('name')
                                         ->cursor() as $search) {
                                            $data_name[] = $search->name;
                                         }   
     foreach(Search2016::select('stock_name as name')
                                         ->orderBy('name')
                                         ->cursor() as $search) {
                                            $data_name[] = $search->name;
                                         }                                                                                                                                                                           
      $unique = collect($data_name)->unique();
      return response()->json([ 'name' => $unique->values()->all() ]);                    
    }
}
