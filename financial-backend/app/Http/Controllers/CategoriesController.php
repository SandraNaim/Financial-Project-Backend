<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class CategoriesController extends Controller
{
    protected $user;

    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        try {
            $this->user = JWTAuth::parseToken()->authenticate();
        } catch ( JWTException $error ) {

        }
    }


    public function index()
    {
        $categories = Categories::all();
        
        return response()->json([
            'status' => 'success',
            'categories' => $categories
        ], 200);
        
        
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $category = new Categories();
        $category->name = $inputs['name']; 


        if ($this->user->categories()->save($category))
            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, task could not be added.'
            ], 500);
    }

    public function show($id)
    {
        $categories = Categories::where('id',$id)->first();
        return response()->json([
           'status'=>'success',
           'data'=> $categories

        ]);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();

        $categories = categories::where('id',$id)->first();
        $categories->country = $inputs['country']; 
        $categories->symbol = $inputs['symbol'];
        $categories->name = $inputs['name'];
        $categories->code= $inputs['code'];
        
        $categories->save();
    }
}
