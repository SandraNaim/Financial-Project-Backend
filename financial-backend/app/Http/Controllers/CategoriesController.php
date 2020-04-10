<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class CategoriesController extends Controller
{
    protected $user;

    
    public function __construct()
    {
        try {
            $this->user = JWTAuth::parseToken()->authenticate();
        } catch ( JWTException $error ) {

        }
    }


    public function index()
    {
        $categories = $this->user->categories()->get()->toArray();
        
        return response()->json([
            'success' => true,
            'data' => $categories
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
                'message' => 'Sorry, category could not be added.'
            ], 500);
    }

    public function show($id)
    {
        $categories = Categories::where('id',$id)->first();
        return response()->json([
           'success'=> true,
           'data'=> $categories

        ]);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();

        $category = Categories::where('id',$id)->first();
        $category->name = $inputs['name'];
        
        $category->save();

        return response()->json([
            'success'=> true,
            'data'=> $category
 
         ]);
    }
}
