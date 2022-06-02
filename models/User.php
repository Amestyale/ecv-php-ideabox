<?php

class User extends Model
{
    private $id;
    private $email;
    private $password;

    public function getId() : int{
        return $this->id;
    }

    public function setId($id) : void{
        $this->id = $id;
    }
    
    public function getEmail() : string{
        return $this->email;
    }

    public function setEmail($email) : void{
        $this->email = $email;
    }

    public function getPassword() : string{
        return $this->password;
    }
    
    public function setPassword($password) : void{
        $this->password = $password;
    }

    public function getVoteOnIdea($idea) : string{
        $dao = new IdeaDao;
        
        return $this->password;
    }
    
}