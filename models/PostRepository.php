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

    // public function hashPassword($password)
    // {
    //     return sha1($password . 'SecretKey');
    // }

    //ユーザの投稿一覧ではユーザ ID からデータを取得する
    public function fetchAllByUserId($user_id)
    {
        $sql = "
            SELECT a.*, u.user_name
                FROM Post a
                    LEFT JOIN user u ON a.user_id = u.id
                WHERE u.id = :user_id
                ORDER BY a.created_at DESC
        ";

        return $this->fetchAll($sql, array(':user_id' => $user_id));
    }

    //ログインしているユーザーの情報を取得する
    public function fetchByIdAndUserName($id, $user_name)
    {
        $sql = "
            SELECT a.* , u.user_name
                FROM status a
                    LEFT JOIN user u ON u.id = a.user_id
                WHERE a.id = :id
                    AND u.user_name = :user_name
        ";

        return $this->fetch($sql, array(
            ':id'        => $id,
            ':user_name' => $user_name,
        ));
    }
}