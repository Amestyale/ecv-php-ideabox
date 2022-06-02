<?php

class UserDao extends Dao
{
    public function fetch($id)
    {
        $stmt = $this->db()->query("SELECT id, email, password FROM user WHERE id = '$id' ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    public function fetchByEmail($email)
    {
        $stmt = $this->db()->query("SELECT id, email, password FROM user WHERE email = '$email' ");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch();
    }

    public function store($email, $password)
    {  
        $sql = "INSERT INTO user(email, password) VALUES (:email, :password) ";
        $req = $this->db()->prepare($sql);
        try {
            $req->execute(array(
                "email" => $email, 
                "password" => $password
            ));
        
            $user = new User;
            $user->setId($this->db()->lastInsertId());
            $user->setEmail($email);
            $user->setPassword($password);
    
            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}