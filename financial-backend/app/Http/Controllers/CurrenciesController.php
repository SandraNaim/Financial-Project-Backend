<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currencies;

class CurrenciesController extends Controller
{
    public function index()
    {
        $currencies = Currencies::all();
        
        return response()->json([
            'success' => true,
            'data' => $currencies
        ], 200);
        
        
    }

    public function store(Request $request)
    {
        $inputs = $request->all();

        // dd($inputs);
        $currencies = new Currencies();
        $currencies->symbol = $inputs['symbol'];
        $currencies->country = $inputs['country']; 

        $currencies->name = $inputs['name'];
        $currencies->code= $inputs['code'];
     
        $currencies->save();

        return response()->json([
            'success'=> true,
            'data' => $currencies->get()
 
         ]);
    }

    public function show($id)
    {
        $currencies = Currencies::where('id',$id)->first();
        return response()->json([
           'success'=> true,
           'data'=> $currencies

        ]);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();

        $currencies = Currencies::where('id',$id)->first();
        $currencies->country = $inputs['country']; 
        $currencies->symbol = $inputs['symbol'];
        $currencies->name = $inputs['name'];
        $currencies->code= $inputs['code'];
        
        $currencies->save();

        return response()->json([
            'success'=> true,
            'data'=> $currencies
 
         ]);
    }
}
