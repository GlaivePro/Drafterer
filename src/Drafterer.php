<?php

namespace GlaivePro\Drafterer;

use Illuminate\Database\Eloquent\Model;

class Drafterer
{
	private $model;
	private $draftibutes;
	
	public function __construct(Model $model) 
	{
		$this->model = $model;
		
		$this->draftibutes = [];
		
		foreach ($this->model->draftererDrafts as $draft)
			$this->draftibutes[$draft->attribute] = $draft->value;
	}
	
	public function __get($attribute)
	{
		if (array_key_exists($attribute, $this->draftibutes))
			return $this->draftibutes[$attribute];
		
		return $this->model->$attribute;
	}
	
	public function getAttributes()
	{
		$attributes = [];
		
		foreach ($this->model->getAttributes() as $attribute => $value)
			$attributes[$attribute] = $this->draftibutes[$attribute] ?? $value;
		
		return $attributes;
	}
	
	private function saveAttributes()
	{
		foreach ($this->model->draftererDrafts as $draft)
			if (!array_key_exists($draft->attribute, $this->model->getDirty()))
				$draft->delete();
		
		foreach ($this->model->getDirty() as $attribute => $value)
			$this->model->draftererDrafts()->updateOrCreate(['attribute' => $attribute], ['value' => $value]);
			
		$this->draftibutes = [];
	}
	
	public function save()
	{
		if (!$this->model->exists)
			return false;
		
		return $this->saveAttributes();
	}
	
	public function saveOrCreate()
	{
		if (!$this->model->exists)
			return $this->model->save();
		
		return $this->saveAttributes();
	}
	
	public function load()
	{
		foreach ($this->draftibutes as $attribute => $value)
			$this->model->$attribute = $value;
	}
	
	public function write()
	{
		if (!$this->model->exists)
			return $this->model->save();
		
		$this->load();
		
		$this->model->save();
		
		$this->discard();
	}
	
	public function discard()
	{
		$this->draftibutes = [];
		$this->model->draftererDrafts()->delete();
	}
}
