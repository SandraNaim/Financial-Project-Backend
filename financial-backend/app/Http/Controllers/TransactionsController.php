<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transactions;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class TransactionsController extends Controller
{

    protected $user;

    
    public function __construct()
    {
        try {
            $this->user = JWTAuth::parseToken()->authenticate();
        } catch ( JWTException $error ) {

        }
    }


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
            'data' => $transactions
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
        $transactions->title = $inputs['title']; 
        $transactions->description = $inputs['description'];
        $transactions->amount = $inputs['amount'];
        $transactions->category_id =$inputs['category_id'];
        $transactions->start_date= $inputs['start_date'];
        $transactions->end_date= $inputs['end_date'];
        $transactions->interval= $inputs['interval'];
        $transactions->type= $inputs['type'];
      

        $transactions->currency_id= $inputs['currency_id'];
        

        if ($this->user->transactions()->save($transactions))
            return response()->json([
                'success' => true,
                'data' => $transactions
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, income could not be added.'
            ], 500);
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
           'data'=> $transactions

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
        $transactions->title = $inputs['title']; 
        $transactions->description = $inputs['description'];
        $transactions->amount = $inputs['amount'];
        $transactions->category_id =$inputs['category_id'];
        $transactions->start_date= $inputs['start_date'];
        $transactions->end_date= $inputs['end_date'];
        $transactions->user_id= $inputs['user_id'];
        $transactions->interval= $inputs['interval'];
        $transactions->type= $inputs['type'];
        $transactions->currency_id= $inputs['currecy_id'];

        $transactions->save();
    }

   
}