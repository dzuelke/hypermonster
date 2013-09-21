<?php

require('../vendor/autoload.php');

function standardXmlLocator(DOMElement $e, $xmlnsUri, $name) {
	return $e->parentDocument->getXPath()->query(sprintf('child:element()[namespace-uri()="%s" and name()="%s"]', $xmlnsUri, $name));
}

$client = Dzuelke\Hypermonster\Client::getInstance();

$client->registerResourceType(
	'ticket', // name
	'application/vnd.collection+json;profile=urn:something.ticket', // media type
	'http://helpdesk.hackday.2012.restfest.org/rels/ticket', // link rel
	function(Dzuelke\Hypermonster\Node $node) { // locator
		return $node->ownerDocument->getXPath()->query(sprintf('child::*[namespace-uri()="%s" and local-name()="%s"]', 'urn:org.restfest.2012.hackday.helpdesk.ticket', 'ticket'), $node);
	}
);

$client->registerCollectionType(
	'tickets', // name
	 'application/vnd.org.restfest.2012.hackday+xml', // media type
	'http://helpdesk.hackday.2012.restfest.org/rels/tickets', // link rel
	'ticket', // element type
	function(Dzuelke\Hypermonster\Node $node) { // locator
		return $node->ownerDocument->getXPath()->query(sprintf('child::*[namespace-uri()="%s" and local-name()="%s"]', 'urn:org.restfest.2012.hackday.helpdesk.tickets', 'tickets'), $node);
	}
);

$client->registerLinkHandler('http://www.w3.org/2005/Atom', 'link', function(DOMElement $link) {
	return new Dzuelke\Hypermonster\Link(
		$link->getAttribute('rel'),
		$link->getAttribute('href'),
		$link->getAttribute('type')
	);
});

$response = $client->go('http://localhost/restblah/');

$tickets = $response->getDocument()->get('tickets');
foreach($tickets->tickets->getAll('ticket') as $ticket) {
	echo $ticket->get1('summary');
	if($comments = $ticket->fetchFirst('comments')) {
		foreach($comments->fetchAll('comment') as $comment) {
			echo $comment->get1('body');
		}
	}
}

?>