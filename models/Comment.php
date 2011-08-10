<?php

namespace app\models;

class Comment extends \lithium\data\Model {

	public $validates = array(
		'comment' => array('notEmpty', 'message' => 'Please enter your comment.'),
	);
	
	public $belongsTo = array('User');
}
?>
