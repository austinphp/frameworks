<?php

namespace app\controllers;

use app\models\Post;
use app\models\User;
use app\models\Comment;

class CommentsController extends \lithium\action\Controller {
	
	public function delete() {
		if (!($user = \lithium\security\Auth::check('user')) || !$user['is_admin']) {
			$this->redirect('/');
		}
		$post = Post::findById($this->request->params['id']);
		$post->delete();
		$this->redirect('/');
	}
	
	public function create() {
		if (!($user = \lithium\security\Auth::check('user'))) {
			$this->redirect('/');
		}
		$comment = Comment::create();
		
		if ($this->request->data) {
			$this->request->data['user_id'] = $user['id'];
			$this->request->data['created'] = date('Y-m-d H:i:s');
			$comment->save($this->request->data);
		}
		$this->redirect($this->request->referer());
	}
}

?>