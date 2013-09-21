<?php

namespace Dzuelke\Hypermonster;

class Link
{
	public $href, $type, $rel;
	
	public function __construct($href, $type = null, $rel = null)
	{
		$this->setHref($href);
		$this->setType($type);
		$this->setRel($rel);
	}
	
	public function setHref($href)
	{
		$this->href = $href;
	}
	
	public function setRel($rel)
	{
		$this->rel = $rel;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
	
	public function getHref()
	{
		return $this->href;
	}
	
	public function getRel()
	{
		return $this->rel;
	}
	
	public function getType()
	{
		return $this->type;
	}
}

?>