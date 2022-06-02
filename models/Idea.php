<?php

class Idea extends Model
{
    private $id;
    private $author_id;
    private $author_email;
    private $title;
    private $slug;
    private $description;
    private $publish_date;
    private $image;
    private $note;

    public function getId() : int{
        return $this->id;
    }

    public function setId($id) : void{
        $this->id = $id;
    }
    
    public function getAuthorId() : int{
        return $this->author_id;
    }

    public function setAuthorId($id) : void{
        $this->author_id = $id;
    }
    
    public function getAuthorEmail() : ?string{
        return $this->author_email;
    }

    public function setAuthorEmail($email) : void{
        $this->author_email = $email;
    }

    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle($title) : void{
        $this->title = $title;
    }

    public function getSlug() : ?string{
        return $this->slug;
    }

    public function setSlug($slug) : void{
        $this->slug = $slug;
    }
    
    public function getDescription() : string{
        return $this->description;
    }

    public function setDescription($description) : void{
        $this->description = $description;
    }

    public function getPublishDate() : DateTime{
        return new Datetime($this->publish_date);
    }

    public function getPublishDateToString() : string{
        $date = $this->getPublishDate();
        return "le ".$date->format("d/m/Y à H:i");
    }

    public function setPublishDate($publish_date) : void{
        $this->publish_date = $publish_date;
    }

    public function getImage() : string{
        return $this->image;
    }

    public function getPathImage() : string{
        return '/public/uploads/idea/'.$this->image;
    }

    public function setImage($image) : void{
        $this->image = $image;
    }

    public function getNote(): ?string{
        return $this->note;
    }
    public function setNote($note): void{
        $this->note = $note;
    }
    public function getPercent(): ?string{
        return $this->total > 0 ? round(($this->total_up / $this->total * 100)).'%' : '-';
    }


}