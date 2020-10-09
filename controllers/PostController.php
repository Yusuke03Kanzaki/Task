<?php

class PostController extends Controller
{
    // protected $auth_actions = array('index', 'signout', 'follow');

    function indexAction()
    {
        // echo 111;
        $user = $this->session->get('user');  
        // print_r($user);
        // $statuses = $this->db_manager->get('Status')
        //     ->fetchAllPersonalArchivesByUserId($user['id']);  //エラーが出てheaderが消えてしまう
        // print_r($statuses);

        return $this->render(array(
        //     // 'statuses' => $statuses,
        //     'body'     => '',
        //     '_token'   => $this->generateCsrfToken('status/post'),
        ));
    }

    function aboutAction()
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

    function sampleAction()
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

    function contactAction()
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

    function post_indexAction()
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

    //トークン。認証はスキップ
    function postAction()
    {
        // echo 123456789;

        if (!$this->request->isPost()) {
            $this->forward404();
        }

        // echo 111;
        // $token = $this->request->getPost('_token');
        // // var_dump($token);        
        // if (!$this->checkCsrfToken('post/post', $token)) {  //$token = NULL
            // return $this->redirect('/');
        // }

        $body = $this->request->getPost('body');
        // echo 111;
        // var_dump($body);

        $errors = array();

        // var_dump($body);
        // echo 111;
        // print_r(strlen($body));
        if (!strlen($body)) {
            $errors[] = 'ひとことを入力してください';
        } else if (mb_strlen($body) > 200) {
            $errors[] = 'ひとことは200 文字以内で入力してください';
        }
        // echo 111;

        // if (count($errors) === 0) {
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

    function testAction()
    {
        // return $this->render(array(
        //     //     // 'statuses' => $statuses,
        //     //     'body'     => '',
        //     //     '_token'   => $this->generateCsrfToken('status/post'),
        //     ));

        // echo 11111;
    }


}