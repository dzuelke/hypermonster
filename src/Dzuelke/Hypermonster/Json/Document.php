<?php

namespace Dzuelke\Hypermonster\Json;

class Document
{
	public function __construct($payload)
	{
		$this->payload = json_decode($payload, true);
		$this->payload = new Element($payload);
	}
	
	public function getRoot()
	{
		return $this->payload;
	}
}

?>