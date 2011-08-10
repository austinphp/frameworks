<?php

use lithium\util\collection\Filters;

// Auto-hashing for User model
Filters::apply('app\models\User', 'save', function($self, $params, $chain){
    $record = $params['entity'];
    if (!$record->id) {
        $record->password = \lithium\security\Password::hash($record->password);
    }
    if (!empty($params['data'])) {
        $record->set($params['data']);
    }
    $params['entity'] = $record;
    return $chain->next($self, $params, $chain);
});

// Auto fields for Post
Filters::apply('app\models\Post', 'save', function($self, $params, $chain){
    $record = $params['entity'];
    
    if (!empty($params['data'])) {
        $record->set($params['data']);
    }
    
	if (!$record->id) {
    	// New Post
        $record->created = date('Y-m-d H:i:s');
        $record->user_id = \lithium\storage\Session::read('user.id');
        $record->slug = strtolower(\lithium\util\Inflector::slug($record->title));
    } else {
    	// Updating Post
    	$record->updated = date('Y-m-d H:i:s');
    }
    
    $params['entity'] = $record;
    return $chain->next($self, $params, $chain);
});

// Enable archiving as opposed to deleteing
Filters::apply('app\models\Post', 'delete', function($self, &$params, $chain){
    $params['entity']->deleted = date('Y-m-d H:i:s');
    return $params['entity']->save();
});

// Hash the password before proceeding with auth check
Filters::apply('lithium\security\Auth', 'check', function($self, $params, $chain) {
	$params['request']->data->password = \lithium\security\Password::hash(
		$params['request']->data['password']
	);
	return $chain->next($self, $params, $chain);
});