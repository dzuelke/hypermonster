<?php

namespace Dzuelke\Hypermonster;

class Response
{
	public function __construct(Guzzle\Http\Message\Response $response)
	{
		$this->response = $response;
	}
	
	public function getDocument()
	{
		$type = $this->response->getContentType();
		$payload = $this->response->getBody();
		
		// TODO: factor out into "formats" or "marshallers"
		if(preg_match('#^(application|text)/(.+\+)?xml$#', $matches, $type)) {
			$retval = new Xml\Document();
			$retval->loadXML($payload);
		} elseif(preg_match('#^application/(.+\+)?json$#', $matches, $type)) {
			$retval = new Json\Document($payload);
		}
		
		return $retval;
	}
}

?>