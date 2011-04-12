<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initAutoloaders()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('My_');
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array('basePath'  => APPLICATION_PATH,
                                                                    'namespace' => ''));
        $resourceLoader->addResourceType('form', 'forms/', 'Form_');
        $loader->pushAutoloader($resourceLoader, '');
        return $loader;
    }


    public function _initRoutes()
    {
        $router = $this->getPluginResource('frontController')
                       ->getFrontController()
                       ->getRouter();
        $router->addRoute('post_route', new Zend_Controller_Router_Route('/post/:slug/', array("controller" => "post",
                                                                                               "action"     => "index")));
    }
}

