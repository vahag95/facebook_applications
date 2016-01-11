<?php

namespace App\Contracts;

interface PostInterface{
	
	public function getAll();
	public function show($id);
	public function delete($id);
	public function create($request);
	public function update($request,$id);
}