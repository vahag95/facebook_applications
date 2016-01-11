<?php

namespace App\Contracts;

interface CategoryInterface{
	
	public function getAll();
	public function show($id);
	public function delete($id);
	public function create($inputs);
	public function update($inputs,$id);

}