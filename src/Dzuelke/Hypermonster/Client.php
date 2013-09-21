<?php

namespace Dzuelke\Hypermonster;

class Client
{
	protected static $instance;
	
	protected $guzzle;
	protected $types = array();
	
	public static function getInstance()
	{
		if(!self::$instance) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
	
	public function getGuzzle()
	{
		if(!$this->guzzle) {
			$this->guzzle = new Guzzle\Http\Client;
		}
		
		return $this->guzzle;
	}
	
	public function addType(Type $type)
	{
		
	}
	
	public function get($url, $type = null)
	{
		$opts = array();
		if($type) {
			$opts['Accept'] = $type;
		}
		
		$req = $this->getGuzzle()->get($url, $opts);
		$res = $req->send();
		
		return new Response($res);
	}
}

?>