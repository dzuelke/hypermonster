<?php

namespace Dzuelke\Hypermonster\Json;

class Element implements Element/*, ArrayAccess*/
{
	protected $data;
	protected $name;
	
	public function __construct($data, $name = null)
	{
		$this->data = $data;
		$this->name = $name;
	}
	
	public function get($name)
	{
		return array_slice($this->getAll($name), 0, 1);
	}
	
	public function getAll($name)
	{
		if(isset($this->data[$name])) {
			$retval = $this->data[$name];
		} elseif(isset($this->data['_embedded'][$name])) {
			$retval = $this->data['_embedded'][$name];
		} elseif(isset($this->data['_links'][$name])) {
			$link = $this->data['_links'][$name]
		}
	}
	
	public function getValue()
	{
		$retval = $this->data;
		
		if(is_array($retval)) {
			array_walk($retval, function(&$value, $key) {
				$value = new Element($value, is_numeric($key) ? null : $key);
			})
		}
		
		return $retval;
	}
}

?>