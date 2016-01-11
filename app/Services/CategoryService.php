<?php 
namespace App\Services;
use App\Contracts\CategoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Auth\Guard;
use Carbon\Carbon ;


class CategoryService implements CategoryInterface
{
	protected $category;
	protected $user;

	public function __construct(Category $category,Guard $auth){
		$this->category = $category;
		$this->user = $auth;
	}

	public function getAll()
	{
		return $this->category->get();
	}

	public function getUsersCategories()
	{
		return $this->category->where('user_id', $this->user->id())->get();
	}

	public function show($id)
	{	
		return $this->category->find($id);
	}

	public function delete($id)
	{
		$this->category->find($id)->posts()->detach();
		 return $this->category
			->where('id', '=', $id)
			->delete();
	}

	public function update($fields,$id)
	{
		$inputs = $this->getInputs($fields);
		return $this->category
			->where('id', $id)
            ->update($inputs);
	}

	public function create($fields)
	{	
		
		return $this->category
			->create($this->getInputs($fields));
	}

	private function getInputs($data)
	{
		$inputs=array('title' => $data['title'],'user_id' => 1 );
		return $inputs;
	}


} 

