<?php

class MiniBlogApplication extends Application
{
    protected $login_action = array('account', 'signin');

    public function getRootDir()
    {
        // var_dump(dirname(__FILE__));
        return dirname(__FILE__);
    }

    protected function registerRoutes()
    {
        return array(
            '/'
                =>array('controller' => 'post', 'action' => 'index'),
            '/post/about'
                =>array('controller' => 'post', 'action' => 'about'),
            '/post/sample'
                =>array('controller' => 'post', 'action' => 'sample'),
            '/post/contact'
                =>array('controller' => 'post', 'action' => 'contact'),
            '/post/post_index'
                =>array('controller' => 'post', 'action' => 'post_index'),
            '/post/post'
                =>array('controller' => 'post', 'action' => 'post'),
            '/post/:user_name'
                =>array('controller' => 'post', 'action' => 'status'), 
            '/post/:user_name/status/:id'
                =>array('controller' => 'post', 'action' => 'show'),
        );
    }

    protected function configure()
    {
        $this->db_manager->connect('master', array(
            'dsn'      => 'mysql:dbname=Task;host=127.0.0.1;charset=utf8',
            'user'     => 'root',
            'password' => 'root',
        ));
    }
}
