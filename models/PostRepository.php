<?php

class PostRepository extends DbRepository
{

    //  レコードの新規作成を行う
    //  $user_name  ユーザーID
    //  $password  パスワード
    public function insert($user_name/*, $password*/)  
    {
        // $password = $this->hashPassword($password);
        $now = new DateTime();

        $sql = "
            INSERT INTO post(user_name, created_at)
                VALUES(:user_name, :created_at)  
        ";  // password, INSERT INTO post無いから削除。:password, VALUES無いから削除

        $stmt = $this->execute($sql, array(
            ':user_name'  => $user_name,
            // ':password'   => $password,
            ':created_at' => $now->format('Y-m-d H:i:s'),
        ));
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

    return $this->fetchAll($sql, array(/*':user_id' => $user_id*/));
    }

    function fetchByIdAndUserName()
    {
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

    