<?php

class PostController extends Controller
{

    // 一覧表示
    function indexAction()
    {
        $statuses = $this->db_manager->get('Post')
            ->fetchAllPersonalArchivesByUserId();

        // print_r($statuses);
         return $this->render(array(
             'statuses'  => $statuses,
         ));
    }

     // 詳細表示
    function showAction($params)
    {
        $status = $this->db_manager->get('Status')
            ->fetchByIdAndUserName($params['id'], $params['user_name']);
 
        if (!$status) {
            $this->forward404();
        }
 
        return $this->render(array('status' => $status));
    }

    // public function userAction($params)
    // {
    //     // getでRepositoryクラスを呼び出す。ここではPostRepositoryを呼び出している
    //     $user = $this->db_manager->get('Post')
    //         ->fetchByUserName($params['user_name']);
    //     if (!$user) {
    //         $this->forward404();
    //     }

    //     $statuses = $this->db_manager->get('Status')
    //         ->fetchAllByUserId($user['id']);
        
    //     $following = null;
    //     if ($this->session->isAuthenticated()) {
    //         $my = $this->session->get('user');
    //         if ($my['id'] !== $user['id']) {
    //             $following = $this->db_manager->get('Following')
    //                 ->isFollowing($my['id'], $user['id']);
    //         }
    //     }

    //     return $this->render(array(
    //         'user'      => $user,
    //         'statuses'  => $statuses,
    //         'following' => $following,
    //         '_token'    => $this->generateCsrfToken('account/follow'),
    //     ));
    // }

    function aboutAction()
    {
        $statuses = $this->db_manager->get('Status');
            // ->fetchAllPersonalArchivesByUserId($user['id']);  //エラーが出てheaderが消えてしまう

        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
            '_token'   => $this->generateCsrfToken('status/post'),
        ));
    }

    function sampleAction()
    {
        // $user = $this->session->get('user');
        $statuses = $this->db_manager->get('Status');
            // ->fetchAllPersonalArchivesByUserId($user['id']);  //エラーが出てheaderが消えてしまう

        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
            '_token'   => $this->generateCsrfToken('status/post'),
        ));
    }

    function contactAction()
    {
        // $user = $this->session->get('user');
        $statuses = $this->db_manager->get('Status');
            // ->fetchAllPersonalArchivesByUserId($user['id']);  //エラーが出てheaderが消えてしまう

        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
            '_token'   => $this->generateCsrfToken('status/post'),
        ));
    }

    function post_indexAction()
    {
        // $user = $this->session->get('user');
        $statuses = $this->db_manager->get('Status');
            // ->fetchAllPersonalArchivesByUserId($user['id']);  //エラーが出てheaderが消えてしまう

        return $this->render(array(
            'statuses' => $statuses,
            'body'     => '',
            '_token'   => $this->generateCsrfToken('status/post'),
        ));
    }

    //トークン。認証はスキップ
    function postAction()
    {
        echo 123456789;

        if (!$this->request->isPost()) {
            $this->forward404();
        }

        $body = $this->request->getPost('body');

        $errors = array();

        //  保存処理です。セッションからユーザ情報を取得し、ユーザの id と投稿された データを StatusRepository クラスの insert() メソッドに渡して保存しています。
        $user = $this->session->get('user');
        // print_r($user);
        // var_dump($user);
        $this->db_manager->get('Status')->insert($user['id'], $body);

        return $this->redirect('/');

        // if (count($errors) === 0) {  
        //     // echo 111;
        //     $user = $this->session->get('user');
        //     $this->db_manager->get('Status')->insert($user['id'], $body);

        //     return $this->redirect('/');
        // }

        // $user = $this->session->get('user');
        // $statuses = $this->db_manager->get('Status')
        //     ->fetchAllPersonalArchivesByUserId($user['id']);
        
        // echo 12345;

        return $this->render(array(
            'errors'   => $errors,
            'body'     => $body,
            'statuses' => $statuses,
            '_token'   => $this->generateCsrfToken('post/post'),
        )/*, 'index'*/);
    }
}