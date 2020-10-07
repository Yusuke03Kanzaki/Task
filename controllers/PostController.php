<?php

class PostController extends Controller
{
    // protected $auth_actions = array('index', 'signout', 'follow');

    public function indexAction()
    {
        echo 111;
        $user = $this->session->get('user');  //NULL　ユーザー情報を取得するらしいが、何のためにあるの？
        // print_r($user);
        $statuses = $this->db_manager->get('Status')
            ->fetchAllPersonalArchivesByUserId($user['id']);  //エラーが出てheaderが消えてしまう
        // print_r($statuses);

        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
            '_token'   => $this->generateCsrfToken('status/post'),
        ));
    }

    public function aboutAction()
    {
        // echo 111;
        // $user = $this->session->get('user');
        $statuses = $this->db_manager->get('Status');
            // ->fetchAllPersonalArchivesByUserId($user['id']);  //エラーが出てheaderが消えてしまう
        // print_r($statuses);
        // var_dump($statuses);

        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
            '_token'   => $this->generateCsrfToken('status/post'),
        ));
    }
}