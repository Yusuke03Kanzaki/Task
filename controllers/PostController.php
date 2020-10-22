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

    //　画像投稿
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

    //画像一覧表示
    function imageAction()
    {
        $statuses = $this->db_manager->get('Post')->fetchImage();
        // $image = $this->db_manager->get('Post')->fetchImage();

        // $statuses = base64_encode($image['image']);
        // print_r($statuses);
        // var_dump($statuses);
        // var_dump($images);
        return $this->render(array(
            'statuses'  => $statuses,
        ));
    }

    //　文章の編集
    function editingAction()
    {
        $status = $this->db_manager->get('Post')
            ->editing();
        
        $id = $this->request->getReferer();

        $count = strrpos($id, '/');
    
        $id = substr($id, $count + 1);
        // var_dump($id);

        // var_dump($status);
        // echo $status;
        
        return $this->render(array(
            'statuses'  => $status,
            'id' => $id,
        ));
    }

    // 削除
    function deletionAction()
    {
        $id = $this->request->getReferer();

        $count = strrpos($id, '/');

        $id = substr($id, $count + 1);
        session_start();  
        $_SESSION['id'] = $id;  //idをスーパーグローバル変数で取得。編集の際に渡す 

        $this->db_manager->get('Post')->deletion($id);

    }

    // 文章書き換え
    function changeAction()
    {
        if (!$this->request->isPost()) {
            $this->forward404();
        }
        
        session_start();
        $id = $_SESSION['id'];
        var_dump($id);
  

        $body = $this->request->getPost('body');
        // // var_dump($body);

        $errors = array();

        //  保存処理です。セッションからユーザ情報を取得し、ユーザの id と投稿された データを PostRepository クラスの insert() メソッドに渡して保存しています。
        $this->db_manager->get('Post')->change($body, $id);

        return $this->render(array(
            'errors'   => $errors,
            'body'     => $body,
            // 'statuses' => $statuses,
            '_token'   => $this->generateCsrfToken('post/post'),
        )/*, 'index'*/);
    }
}