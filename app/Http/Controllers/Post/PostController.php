<?php
namespace App\Http\Controllers\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Contracts\PostInterface;
use App\Contracts\CategoryInterface;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

    }
    public function index(PostInterface $post_service)
    {
        return response()->json($post_service->getAll());
        /*return view('posts.index',['posts' => $post_service->getAll(),'title' => 'Posts']);*/
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPostsByCategoriesIds($ids,PostInterface $post_service)
    {
        $posts = $post_service->getPostsByCategoriesIds($ids);
        //dd($posts);
        return response()->json($posts);
    }

    public function create(CategoryInterface $category_service)
    {
        return view('posts.form',['title' => 'Create New Post','categories' => $category_service->getAll()]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,PostInterface $post_service)
    {
        
        if($post_service->create($request->all())){
            return response()->json( true);
            /*return redirect('/post')->with('status', 'Post Added');*/
        }else{   
            return response()->json(false);
            /*return redirect('/post/')->with('status', 'Unknown error!');*/
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,PostInterface $post_service)
    {
        $post = $post_service->show($id);
        return response()->json( $post_service->show($id));
        /*return view('posts.show',['post'=>$post,'title' => $post->name]);*/
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,PostInterface $post_service,CategoryInterface $category_service)
    {
        if(!$post_service->show($id))
            return redirect('/post/')->with('status', 'Unknown error!');
        $post = $post_service->show($id);
        $categories = $category_service->getAll();
        return view('posts.form',['title'=>"Edit Post",'id'=>$id,'post' => $post,'categories'=>$categories]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,PostInterface $post_service)
    {
        //
        if($post_service->update($request->all(),$id))
        {
            return response()->json(true);
            //return redirect('/post')->with('status', 'Post Edited');
        }
        else
        {
            return response()->json(false);
            //return redirect('/post/')->with('status', 'Unknown error!');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,PostInterface $post_service)
    {
        $image_name = $post_service->delete($id);
        
        if($image_name){
            /*return redirect('/category')->with('status', 'Category Deleted');*/
            return response()->json( $image_name);
        } else{
            /*return redirect('/category/'.$id)->with('warning', 'Unknown error!');*/
            return response()->json(NULL);
        }
    }
}