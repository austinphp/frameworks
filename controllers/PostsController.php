<?php

namespace app\controllers;

use app\models\Post;
use app\models\User;
use app\models\Comment;

class PostsController extends \lithium\action\Controller {

	public function index() {
		$posts = Post::all(array(
			'conditions' => array('Post.deleted IS NULL'),
			'fields' => array(
				'Post.id',
				'Post.title',
				'Post.teaser',
				'Post.slug',
				'User.username'
			),
			'order' => array('created' => 'desc'),
			'with' => array('User', 'Comment'/*, 'Tag'*/)
		));
		
		$posts->each(function($post) {
			$post->comments = Comment::findCountByPostId($post->id, array(
				'conditions' => array('deleted IS NULL')
			));
			return $post;
		});
		
		return compact('posts');
	}
	
	public function view() {
		$post = Post::findBySlug($this->request->params['slug'], array(
			'conditions' => array('deleted IS NULL'),
			'fields' => array(
				'Post.id',
				'Post.title',
				'Post.body',
				'Post.slug',
				'User.username'
			),
			'order' => array('created' => 'desc'),
			'with' => array('User', 'Comment')
		));

		$post->comments = Comment::findAllByPostId($post->id, array(
			'conditions' => array('deleted IS NULL'),
			'with' => array('User')
		));

		return compact('post');
	}
	
	public function edit() {
		if (!($user = \lithium\security\Auth::check('user')) || !$user['is_admin']) {
			$this->redirect('/');
		}
		$post = Post::findById($this->request->params['id']);
		
		if ($this->request->data) {
			
			//Mark as deleted
			if (is_null($post->deleted) && !empty($this->request->data['deleted'])) {
				$this->request->data['deleted'] = date('Y-m-d H:i:s');
			}
			
			//Undelete
			if (!is_null($post->deleted) && empty($this->request->data['deleted'])) {
				$this->request->data['deleted'] = null;
			}

			$success = $post->save($this->request->data);
		}
		
		return compact('post', 'success');
	}
	
	public function delete() {
		if (!($user = \lithium\security\Auth::check('user')) || !$user['is_admin']) {
			$this->redirect('/');
		}
		$post = Post::findById($this->request->params['id']);
		$post->delete();
		$this->redirect('/');
	}
	
	public function create() {
		if (!($user = \lithium\security\Auth::check('user')) || !$user['is_admin']) {
			$this->redirect('/');
		}
		$post = Post::create();
		
		if ($this->request->data && $post->save($this->request->data)) {
			$this->redirect('/post/' . $post->slug);
		}
		
		return compact('post');
	}
}

?>