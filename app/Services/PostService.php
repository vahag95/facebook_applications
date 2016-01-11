<?php 
namespace App\Services;
use App\Contracts\PostInterface;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Contracts\Auth\Guard;

class PostService implements PostInterface
{

	public function __construct(Post $post,Category $category,Guard $auth)
	{
		$this->post = $post;
		$this->category = $category;
		$this->user = $auth;
	}

	public function getAll()
	{
		return $this->post->with('categories')->get();
	}

	public function getUsersPosts()
	{	
		return $this->post->where('user_id', $this->user->id())->get();
	}

	public function show($id)
	{
		return $this->post->with('categories')->find($id);
	}


	public function delete($id)
	{
		$this->post->find($id)->categories()->detach();
		$image_name = $this->post->find($id)->image;

		if($this->post->where('id',$id)->delete($id))
		{
			return $image_name;
		}
		return false;

	}

	public function getPostsByCategoriesIds($ids)
	{
		$ids_arr = explode(',', $ids);
		$categories_posts = array();
		foreach ($ids_arr as  $id) {
			$categories_posts[] = $this->category->find($id)->posts->toArray();
		}
		$posts=array();
		foreach ($categories_posts as  $category_post) {
			foreach ($category_post as $post) {
				$posts[] = $post;
			}
		}
		return $posts;
	}


	public function update($fields,$id)
	{
        $inputs = $this->getinputs($fields);
        $result = $this->post
			->where('id', $id)
            ->update($inputs);
        if($result)
        {	
        	$ids = array();
			$ids = isset($fields['categories_ids'])?$fields['categories_ids']:[];
			if(count($ids)){
	        	$post=$this->post->find($id);
	        	$post->categories()->detach();
	        	$post->categories()->attach($ids);
	        }
        	return $result;
        }
        else return false;
	}

	public function create($fields)
	{	
        $inputs = $this->getInputs($fields);
        
        $id = $this->post
			->insertGetId($inputs);
		
		if($id){
			// if ok do this block and return last inserted id
        	$ids = array();
			$ids = isset($fields['categories_ids'])?$fields['categories_ids']:[];
			if(count($ids)){
				$this->post 	//attach ralation to category
				->find($id)
				->categories()
				->attach($ids);	
			}

			return $id;	
		} else return false;		
	}

	private function getinputs($data)
	{
		$inputs = array('title' => $data['title'],'user_id' =>1 ,'description' => $data['description'], 'image' => $data['image']  );
		return $inputs;
	}
} 

