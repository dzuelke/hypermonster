<?php

namespace Dzuelke\Hypermonster\Xml;

class Document extends \DOMDocument implements \Dzuelke\Hypermonster\Document
{
	/**
	 * @var        DOMXPath A DOMXPath instance for this document.
	 */
	protected $xpath = null;
	
	/**
	 * @var        array A map of DOM classes and extended Agavi implementations.
	 */
	protected $nodeClassMap = array(
		// 'DOMAttr'                  => 'Dzuelke\Hypermonster\Xml\Attr',
		// 'DOMCharacterData'         => 'Dzuelke\Hypermonster\Xml\CharacterData',
		// 'DOMComment'               => 'Dzuelke\Hypermonster\Xml\Comment',
		// yes, even DOMDocument, so we don't get back a vanilla DOMDocument when doing $node->documentElement etc
		'DOMDocument'              => 'Dzuelke\Hypermonster\Xml\Document',
		// 'DOMDocumentFragment'      => 'Dzuelke\Hypermonster\Xml\DocumentFragment',
		// 'DOMDocumentType'          => 'Dzuelke\Hypermonster\Xml\DocumentType',
		'DOMElement'               => 'Dzuelke\Hypermonster\Xml\Element',
		// 'DOMEntity'                => 'Dzuelke\Hypermonster\Xml\Entity',
		// 'DOMEntityReference'       => 'Dzuelke\Hypermonster\Xml\EntityReference',
		// 'DOMNode'                  => 'Dzuelke\Hypermonster\Xml\Node',
		// 'DOMNodeList'                  => 'Dzuelke\Hypermonster\Xml\NodeList',
		// 'DOMNotation'              => 'Dzuelke\Hypermonster\Xml\Notation',
		// 'DOMProcessingInstruction' => 'Dzuelke\Hypermonster\Xml\ProcessingInstruction',
		// 'DOMText'                  => 'Dzuelke\Hypermonster\Xml\Text',
	);
	
	/**
	 * The constructor.
	 * Will auto-register all DOM node classes and create an XPath instance.
	 *
	 * @param      string The XML version.
	 * @param      string The XML encoding.
	 *
	 * @see        DOMDocument::__construct()
	 *
	 * @author     David Zülke <dzuelke@gmail.com>
	 */
	public function __construct($version = "1.0", $encoding = "UTF-8")
	{
		parent::__construct($version, $encoding);
		
		foreach($this->nodeClassMap as $domClass => $ourClass) {
			$this->registerNodeClass($domClass, $ourClass);
		}
		
		$this->xpath = new \DOMXPath($this);
	}
	
	public function getRoot()
	{
		return $this->documentElement;
	}
	
	public function registerNamespace($prefix, $uri)
	{
		
	}
	
	public function registerRel($shortcut, $rel)
	{
		
	}
	
	public function registerResource($xmlnsPrefix, $xmlnsUri, $name)
	{
		
	}
	
	public function registerLinkElement($xmlnsUri, $name, callable $handler)
	{
		
	}
}

?>