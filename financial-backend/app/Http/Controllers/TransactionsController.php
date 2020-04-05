<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transactions::all();
        
        return response()->json([
            'status' => 'success',
            'transactions' => $transactions
        ], 200);
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $transactions = new Transactions ();
        $income->title = $inputs['title']; 
        $income->description = $inputs['description'];
        $income->amount = $inputs['amount'];
        $income->category_id =$inputs['category_id'];
        $income->start_date= $inputs['start_date'];
        $income->end_date= $inputs['end_date'];
        $income->user_id= $inputs['user_id'];
        $income->interval= $inputs['interval'];
        $income->type= $inputs['type'];
        $income->currency_id= $inputs['currecy_id'];
        $income->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions = Transactions::where('id',$id)->first();
        return response()->json([
           'status'=>'success',
           'transactions'=> $transactions

        ]);
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
        $inputs = $request->all();

        $transactions = Transactions::where('id',$id)->first();
        $income->title = $inputs['title']; 
        $income->description = $inputs['description'];
        $income->amount = $inputs['amount'];
        $income->category_id =$inputs['category_id'];
        $income->start_date= $inputs['start_date'];
        $income->end_date= $inputs['end_date'];
        $income->user_id= $inputs['user_id'];
        $income->interval= $inputs['interval'];
        $income->type= $inputs['type'];
        $income->currency_id= $inputs['currecy_id'];
        $income->save();
    }

   
}