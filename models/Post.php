<?php

namespace app\models;

class Post extends \lithium\data\Model {
	
	public $validates = array(
		'title' => array('notEmpty', 'message' => 'You need a title'),
		'body' => array('notEmpty', 'message' => 'You need a body')
	);
	
//	public static function __init() {
//		parent::__init();
//		self::bind('hasOne', 'User');
//		self::bind('hasMany', 'Comment');
//	}
	
	public $belongsTo = array('User');
	public $hasMany = array('Comment');
	
}

?>
