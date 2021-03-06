<?php

error_reporting(E_ALL ^ (E_NOTICE | E_STRICT));
ini_set('display_errors',true);

require_once __DIR__ . '/../../vendor/autoload.php';

use Tipsy\Tipsy;

Tipsy::router()
	->get('item/:id/json', function($Params, $Request) {
		header('Content-Type: application/json');
		echo json_encode([id => $Params->id, key => $Request->key, method => 'get']);
	})
	->get('item/:id/plain', function($Params, $Request) {
		echo $Params->id.'.'.$Request->key.'.get';
	})
	->post('item/:id/json', function($Params, $Request) {
		header('Content-Type: application/json');
		echo json_encode([id => $Params->id, key => $Request->key, method => 'post']);
	})
	->post('item/:id/plain', function($Params, $Request) {
		echo $Params->id.'.'.$Request->key.'.post';
	})

	->otherwise(function() {
		http_response_code(404);
	});

Tipsy::start();
