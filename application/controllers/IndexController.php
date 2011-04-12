<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $postsTable = new Zend_Db_Table('posts');
        $posts = $postsTable->fetchAll();
        $this->view->posts = $posts;
    }
}



