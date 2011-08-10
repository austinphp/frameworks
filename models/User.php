<?php

namespace app\models;

class User extends \lithium\data\Model {

	public $validates = array(
		'username' => array('notEmpty', 'message' => 'Please provide a username'),
		'password' => array('notEmpty', 'message' => 'Please enter a password')
	);
}
?>
