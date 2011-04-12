<?php

class AdminController extends Zend_Controller_Action
{

    public function preDispatch()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity() && $this->_request->getActionName() != 'login') {
            return $this->_forward('login');
        }
    }

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $postsTable = new Zend_Db_Table('posts');
        $this->view->posts = $postsTable->fetchAll();
    }

    public function loginAction()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->_redirect('/admin');
        }

        $loginForm = new Form_Login();
        if ($this->_request->isPost()) {
            if ($loginForm->isValid($_POST)) {
                $adap = new Zend_Auth_Adapter_DbTable();
                $adap->setIdentity($loginForm->getValue('username'))
                     ->setCredential(md5($loginForm->getValue('username')))
                     ->setCredentialColumn('password')
                     ->setIdentityColumn('username')
                     ->setTableName('users');
                $result = $auth->authenticate($adap);
                if ($result->isValid()) {
                    return $this->_redirect('/admin');
                }
           }
        }
        $this->view->loginForm = $loginForm;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        return $this->_redirect('/');
    }

    public function createAction()
    {
        $form = new Form_Post();
        if ($this->_request->isPost()) {
            if ($form->isValid($_POST)) {
                $values = $form->getValues();
                $values['created_at'] = time();
                $values['updated_at'] = $values['created_at'];
                $postsTable = new Zend_Db_Table('posts');
                $postsTable->insert($values);
                return $this->_redirect('/admin');
            }
        }
        $this->view->form = $form;
    }

    public function editAction()
    {
        $postsTable = new Zend_Db_Table('posts');
        if ($this->_request->isPost()) {
            $form = new Form_Post();
            if ($form->isValid($_POST)) {
                $values = $form->getValues();
                $values['updated_at'] = time();
                $where = $postsTable->getAdapter()->quoteInto("id = ?", $values['id']);
                $postsTable->update($values, $where);
                return $this->_redirect('/admin');
            }
        } else {
            $postId = $this->_getParam('id');
            $post = $postsTable->find($postId)->current();
            if ($post) {
                $values = $post->toArray();
            }
            $form = new Form_Post($values);
            $form->setAction('/admin/edit');
            $this->view->form = $form;
        }
    }

    public function deleteAction()
    {
        $postId = $this->_getParam('id');
        $postsTable = new Zend_Db_Table('posts');
        $where = $postsTable->getAdapter()->quoteInto('id = ?', $postId);
        $postsTable->delete($where);
        return $this->_redirect('/admin');
    }


}











