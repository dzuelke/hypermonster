<?php

namespace Dzuelke\Hypermonster\Xml;

class Element extends \DOMElement implements \Dzuelke\Hypermonster\Element
{
	public function get($name)
	{
		$retval = $this->getAll($name);
		if($retval->length) {
			return $retval->item(0);
		}
	}
	
	public function getAll($name)
	{
		$result = $this->getElementsByTagNameNS($this->namespaceURI, $name);
		if($result->length) {
			return $result;
		}
	}
	
	public function getName()
	{
		return $this->localName;
	}
	
	public function getValue()
	{
		return $this->nodeValue;
	}
}