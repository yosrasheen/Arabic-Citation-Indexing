<?php

include "bootstrap.php";

$options = array
(
    'hostname' => SOLR_SERVER_HOSTNAME,
    'login'    => SOLR_SERVER_USERNAME,
    'password' => SOLR_SERVER_PASSWORD,
    'port'     => SOLR_SERVER_PORT,
);

$client = new SolrClient($options);

$query = new SolrQuery();

$query->setQuery('mymum');

$query->setStart(0);

$query->setRows(50);

$query->addField('title')->addField('content')->addField('id')->addField('url');

$query_response = $client->query($query);

$response = $query_response->getResponse();

print_r($response);
?>
