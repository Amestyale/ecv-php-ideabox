<?php

class AuthController
{
    public static function getLoged() : ?User
    {
        $logedId = AuthController::getLogedId();
        if(!$logedId) return null;
        $dao = new UserDao();
        return $dao->fetch($logedId);
    }

    public static function getLogedId() : ?int
    {
        return $_SESSION["user_id"] ?? null;
    }

    public function show($id)
    {
        $dao = new UserDao();
        var_dump($dao->fetchByEmail("bob@coucou.com"));

        view("auth/profile","Profil", ["id" => $id]);
    }
    
    public function logout()
    {
        unset($_SESSION["user_id"]);
        return $this->login();
    }

    public function login()
    {
        view("auth/login","Connexion");
    }
    
    public function login_action($data)
    {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        $dao = new UserDao;
    
        if(!$email) add_error('email','miss');
        if(!$password) add_error('password','miss');
        if(has_errors()) return $this->login();

        $user = $dao->fetchByEmail($email);
        if($user && password_verify($password,$user->getPassword())){
            $_SESSION["user_id"] = $user->getId();
            header('location: /idees');
        } else {
            add_error('login','missmatch');
            return $this->login();
        }

    }
    
    public function create()
    {
        view("auth/register","Inscription");
    }

    public function store($data)
    {
        $email = isset($data['email']) ? $data['email'] : null;
        $email_regex = preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $email);
        $password = isset($data['password']) ? $data['password'] : null;
        $confirm_password =  isset($data['confirm-password']) ? $data['confirm-password'] : null;
        
        if(!$email) add_error('email','miss');
        if($email && !$email_regex) add_error('email','format');
        if(!$password) add_error('password','miss');
        if(!$confirm_password) add_error('confirm-password','miss');
        if($password != $confirm_password) {
            add_error('password','missmatch');
            add_error('confirm-password','missmatch');
        }

        if(has_errors()) return $this->create();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $userDao = new UserDao;
        try {
            $user = $userDao->store($email, $password);
            var_dump($user);
        } catch (\Throwable $th) {
            if($th->getCode() == SQL_ERROR_DUPLICATE_UNIQUE){
                add_error('email','used');
                return $this->create();
            }
        }

        die();
    }
}