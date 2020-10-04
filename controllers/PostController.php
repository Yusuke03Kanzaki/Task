<?php

class PostController extends Controller
{
    // protected $auth_actions = array('index', 'signout', 'follow');

    // public function indexAction()
    // {

    // }


    public function indexAction()
    {
        $user = $this->session->get('user');
        $followings = $this->db_manager->get('User')
            ->fetchAllFollowingsByUserId($user['id']);

        return $this->render(array(
            'user'       => $user,
            // 'followings' => $followings,
        ));
    }
}