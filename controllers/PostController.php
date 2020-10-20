<?php

class PostController extends Controller
{

    // 一覧表示。とトップページ表示
    function indexAction()
    {
        $statuses = $this->db_manager->get('Post')
            ->fetchAllPersonalArchivesByUserId();

        // print_r($statuses);
        // var_dump($statuses);
         return $this->render(array(
             'statuses'  => $statuses,
         ));
    }

     //詳細表示
    function showAction()
    {
        // print_r(111);
        $status = $this->db_manager->get('Post')
            ->fetchByIdAndUserName();
 
        // echo 222;
        // print_r($status);
        // var_dump($status);
        if (!$status) {
            $this->forward404();
        }
        // echo 333;
 
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

    function postAction()
    {
        if (!$this->request->isPost()) {
            $this->forward404();
        }

        $user_name = $this->request->getPost('name');
        $post_title = $this->request->getPost('post_title');
        $post_subtitle = $this->request->getPost('post_subtitle');
        $body = $this->request->getPost('body');
        // var_dump($user_name);

        $errors = array();

        //  保存処理です。セッションからユーザ情報を取得し、ユーザの id と投稿された データを PostRepository クラスの insert() メソッドに渡して保存しています。
        $this->db_manager->get('Post')->insert($user_name, $post_title, $post_subtitle, $body);

        return $this->render(array(
            'errors'   => $errors,
            'body'     => $body,
            // 'statuses' => $statuses,
            '_token'   => $this->generateCsrfToken('post/post'),
        )/*, 'index'*/);
    }

    function uploadAction()
    {
        // echo 111;
        // var_dump($this->request->isPost());
        if (!$this->request->isPost()) {
            $this->forward404();
        }

        $upfile = $_FILES["upload"]["tmp_name"];
        if ($upfile==""){
            print("ファイルのアップロードができませんでした。<BR>");
            exit;
        }

        // ファイル取得
        $imgdat = file_get_contents($upfile);
        // var_dump($imgdat);
        // echo 333;

        //  保存処理です。セッションからユーザ情報を取得し、ユーザの id と投稿された データを PostRepository クラスの insert() メソッドに渡して保存しています。
        $this->db_manager->get('Post')->imageinsert($imgdat);

        // 画像データ取得
        $image = $this->db_manager->get('Post')->fetchImage();

        echo $image;

        // $result = mysql_query($sql, $dbLink);
        // $row = mysql_fetch_row($result);

        return $this->render(array(
        ));


    }

    function imageAction()
    {
        // echo 111;
        return $this->render(array(
            // '_token'   => $this->generateCsrfToken('post/post'),
        ));
    }
}