<?php

namespace app\controllers;

use lithium\analysis\Debugger;

use app\models\User;
use lithium\security\Auth;

class UsersController extends \lithium\action\Controller {

	public function login() {
		if ($this->request->data) {
			if ($user = Auth::check('user', $this->request)) {
	            return $this->redirect('/');
	        }
		}
		return array('showLogin' => false);
	}

	public function logout() {
        Auth::clear('user');
        return $this->redirect('/');
    }

	public function register() {
		if ($this->request->data) {
			if ($this->request->data['password'] === $this->request->data['confirm']) {
				unset($this->request->data['confirm']);
				$this->request->data['is_admin'] = false;
				$user = User::create($this->request->data);
				if ($user->save()) {
					Auth::check('user', $this->request);
					$this->redirect('/');
				}
			}
		}
	}
}

?>