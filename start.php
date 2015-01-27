<?php

function profile_sync_init()
{
	if(false == function_exists('elgg_ws_expose_function'))
	{
		return;
	}
	
	elgg_ws_expose_function(
		'profile_sync.get_emails',
		'profile_sync_get_emails',
		"Get list of user emails on the site",
		'GET',
		false,
		false
	);	
}

function profile_sync_get_emails()
{
	$dbprefix = _elgg_services()->config->get('dbprefix');
	
	return elgg_get_entities(array(
		'type' => 'user',
		'limit' => 100000000,
		'joins' => array("join {$dbprefix}users_entity u on e.guid = u.guid"),
		'selects' => array('u.email'),
		'order_by' => "u.email"
	));
				
}


elgg_register_event_handler('init', 'system', 'profile_sync_init');