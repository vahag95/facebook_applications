<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryInterface;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    

    public function __construct()
    {
    
       // $this->middleware('auth',[ 'except' => ['index','show'] ]);  

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryInterface $category_service)
    {   
        return response()->json($category_service->getAll() );
        //return view('categories.index',['categories'=>$category_service->getAll(),'title' => 'Categories']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('categories.form',['title' => "Add New Category"]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request,CategoryInterface $category_service)
    {
        
        if($category_service->create($request->all()))
        {
            return response()->json(true);
            //return redirect('/category')->with('status', 'Category Added');
        }
        else
        {
            return response()->json(false);
            //return redirect('/category')->with('warning', 'Category Added');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,CategoryInterface $category_service)
    {
        /*$category = $this->category->show($id);
        return view('posts.index',['posts'=>$category->posts,'title' => $category->title]);*/
        return response()->json( $category_service->show($id));
    }

    public function user(CategoryInterface $category_service)
    {
        return view('categories.index',['categories'=>$category_service->getUsersCategories(true),'title' => 'My categories']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,CategoryInterface $category_service)
    {
        
        $category = $category_service->show($id);
        return view('categories.form',['title'=>"Edit Category",'id' => $id,'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id,CategoryInterface $category_service)
    {   
        
        if($category_service->update($request->all(),$id))
        {
            /*return redirect('/category')->with('status', 'Category Edited');*/
            return response()->json(true);
        }
        else
        {
            /*return redirect('/category/')->with('warning', 'Unknown error!');*/
            return response()->json(false);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,CategoryInterface $category_service)
    {   
        
        if($category_service->delete($id))
        {
            /*return redirect('/category')->with('status', 'Category Deleted');*/
            return response()->json(true);
        }
        else
        {
            /*return redirect('/category/'.$id)->with('warning', 'Unknown error!');*/
            return response()->json(false);
        }
    }
}
