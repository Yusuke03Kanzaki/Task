<?php

class PostRepository extends DbRepository
{
    public function fetchAllPersonalArchivesByUserId($user_id)  //ログインしているユーザーの情報を取得する
    {
        $sql = "
            SELECT a.*, u.user_name
            FROM status a
                LEFT JOIN user u ON a.user_id = u.id
                LEFT JOIN following f ON f.following_id = a.user_id
                    AND f.user_id = :user_id
                WHERE f.user_id = :user_id OR u.id = :user_id
                ORDER BY a.created_at DESC
        ";

        return $this->fetchAll($sql, array(':user_id' => $user_id));
    }

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

}