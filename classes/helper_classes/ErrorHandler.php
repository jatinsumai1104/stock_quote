<?php

class ErrorHandler
{
	protected $errors;
	protected $di;

	public function __construct($di){
		$this->di = $di;
		$this->errors = [];
	}
	
	public function addError($error, $key = null)
	{
		if($key)
		{
			$this->errors[$key][] = $error;
		}
		else
		{
			$this->errors[] = $error;
		}
	}

	public function hasErrors()
	{
		return count($this->all()) ? true : false;
	}

	public function has($key)
	{
		return isset($this->errors[$key]);
	}

	public function all($key = null)
	{
		return isset($this->errors[$key]) ? $this->errors[$key] : $this->errors;
	}

	public function first($key)
	{
		return isset($this->all()[$key][0]) ? $this->all()[$key][0] : false;
	}
}