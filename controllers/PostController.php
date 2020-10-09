<?php

class PostController extends Controller
{
    // protected $auth_actions = array('index', 'signout', 'follow');

    public function indexAction()
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

    public function sampleAction()
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

    public function contactAction()
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

    public function post_indexAction()
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

    public function postAction()
    {
        // echo 111;

        if (!$this->request->isPost()) {
            $this->forward404();
        }

        // echo 111;
        $token = $this->request->getPost('_token');
        if (!$this->checkCsrfToken('status/post', $token)) {
            return $this->redirect('/');
        }

        $body = $this->request->getPost('body');

        $errors = array();

        if (!strlen($body)) {
            $errors[] = 'ひとことを入力してください';
        } else if (mb_strlen($body) > 200) {
            $errors[] = 'ひとことは200 文字以内で入力してください';
        }

        if (count($errors) === 0) {
            $user = $this->session->get('user');
            $this->db_manager->get('Status')->insert($user['id'], $body);

            return $this->redirect('/');
        }

        $user = $this->session->get('user');
        $statuses = $this->db_manager->get('Status')
            ->fetchAllPersonalArchivesByUserId($user['id']);

        return $this->render(array(
            'errors'   => $errors,
            'body'     => $body,
            'statuses' => $statuses,
            '_token'   => $this->generateCsrfToken('status/post'),
        ), 'index');
    }


}