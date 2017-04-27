<?php

namespace App\Utils;

use App\Models\ScanStock;

class GetScannedStock{
    private function __construct()
    {
        # code...
    }
    public static function get_with_id(int $id){
        if($id == 1){
            $scan_stock = ScanStock::select('stock_name as name', 'eps_growth_2015(%) as eps_growth_2015_percent'
            , 'roe(%) as roe_percent')
            ->where([['eps_growth_2015(%)', '>', '12']
                    ,['roe(%)', '>', '20']])
            ->get();
        }
        elseif($id == 2){
            $scan_stock = ScanStock::select('stock_name as name', 'dps_growth_2015(%) as dps_growth_2015_percent'
            , 'dps_growth_2014(%) as dps_growth_2014_percent', 'dividend_yield(%) as dividend_yield_percent'
            , 'pay_out_ratio(%) as pay_out_ratio_percent')
            ->where([['dps_growth_2015(%)', '>', '0']
                    ,['dps_growth_2014(%)', '>', '0']
                    ,['dividend_yield(%)', '>', '3.0']])
            ->whereBetween('pay_out_ratio(%)', [50, 100])
            ->get();
        }
        elseif($id == 3){
            $scan_stock = ScanStock::select('stock_name as name', 'eps_growth_2015(%) as eps_growth_2015_percent'
            , 'roe(%) as roe_percent', 'gpm')
            ->where([['eps_growth_2015(%)', '>', '20']
                    ,['roe(%)', '>', '15']
                    ,['gpm', '>', '20']])
            ->get();
        }
        elseif($id == 4){
            $scan_stock = ScanStock::select('stock_name as name', 'eps_growth_2015(%) as eps_growth_2015_percent'
            , 'eps_growth_2014(%) as eps_growth_2014_percent', 'gpm', 'npm(%) as npm_percent'
            , 'dividend_yield(%) as dividend_yield_percent', 'roe(%) as roe_percent')
            ->where([['eps_growth_2015(%)', '>', '0']
                    ,['eps_growth_2014(%)', '>', '0']
                    ,['dividend_yield(%)', '>', '3']
                    ,['roe(%)', '>', '12']
                    ,['gpm', '>', '20']
                    ,['npm(%)', '>', '15']])
            ->get();
        }
        elseif($id == 5){
            $scan_stock = ScanStock::select('stock_name as name', 'last_price'
            , 'vbv', 'roe(%) as roe_percent', 'p/e')
            ->where([['p/e', '<', ScanStock::avg('p/e')]
                    ,['roe(%)', '>', '12']])
            ->whereColumn('vbv', '>', 'last_price')                  
            ->get();
        }
        
        
        return $scan_stock;
    }
}