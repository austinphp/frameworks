<?php

class PostController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $slug = $this->_getParam('slug');
        $postsTable = new Zend_Db_Table('posts');
        $where = $postsTable->getAdapter()->quoteInto('slug = ?', $slug);
        $post = $postsTable->fetchRow($where);
        $this->view->post = $post;
    }
}

