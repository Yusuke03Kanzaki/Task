<?php

class PostRepository extends DbRepository
{

    //  レコードの新規作成を行う
    public function insert($user_name, $post_title, $post_subtitle, $body)  
    {
        $now = new DateTime();

        $sql = "
            INSERT INTO post(user_name, post_title, post_subtitle, body, created_at)
                VALUES(:user_name, :post_title, :post_subtitle, :body, :created_at)   
        "; 

        $stmt = $this->execute($sql, array(
            ':user_name'      => $user_name,
            ':post_title'     => $post_title,
            ':post_subtitle'  => $post_subtitle,
            ':body'           => $body,
            ':created_at'     => $now->format('Y-m-d H:i:s'),
        ));
    }

    function imageinsert($imgdat)
    {
        $sql = "
            INSERT INTO image(image) 
                VALUES(:imgdat)
        ";

        $stmt = $this->execute($sql, array(
            ':imgdat' => $imgdat,
        ));
        // echo 444;
    }

    //ユーザの投稿一覧ではユーザ ID からデータを取得する
    public function fetchAllByUserId($user_id)
    {
        $sql = "
            SELECT user_name
                FROM post
                ORDER BY created_at DESC
        ";

        return $this->fetchAll($sql, array(':user_id' => $user_id));
    }

    public function fetchByUserName($user_name)
    {
        $sql = "SELECT * FROM user WHERE user_name = :user_name";

        return $this->fetch($sql, array(':user_name' => $user_name));
    }

    //投稿を新しい順で取得。自作目メソッド
    public function fetchAllPersonalArchivesByUserId()  
    {
        $sql = "
            SELECT *
            FROM post
                ORDER BY created_at DESC
        ";

    return $this->fetchAll($sql, array());
    }

    function fetchByIdAndUserName()
    {
        // echo 222;
        $sql = "
            SELECT *
                FROM post
        ";

        return $this->fetch($sql, array(/*
            ':id'        => $id,
            ':user_name' => $user_name,
        */));
    }
}

    