<?php

class IdeaDao extends Dao
{
    public function fetchAll($limit = 6, $offset = 0)
    {
        $offset = intval($offset);
        
        $sql = "
        SELECT 
            i.id, u.id AS author_id, u.email AS author_email, i.title, i.description, i.publish_date, i.image, i.slug,
            COUNT(iu.vote) AS total,
            SUM(iu.vote) AS note,
            AVG(iu.vote) AS avg, 
            SUM (
            CASE
              WHEN vote == 1 THEN 1
              ELSE 0
            END) AS total_up,
            SUM (
            CASE
              WHEN vote == -1 THEN 1
              ELSE 0
            END) AS total_down FROM idea AS i 
        LEFT JOIN idea_user AS iu ON iu.idea_id = i.id 
        INNER JOIN user AS u ON i.author_id = u.id 
        GROUP BY i.id
        ORDER BY avg DESC
        LIMIT $limit
        OFFSET $offset 
        ; ";
        $stmt = $this->db()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Idea');
    }

    public function fetchByUser($user)
    {
        
        $sql = "
        SELECT 
            i.id, u.id AS author_id, u.email AS author_email, i.title, i.description, i.publish_date, i.image, i.slug,
            COUNT(iu.vote) AS total,
            SUM(iu.vote) AS note,
            AVG(iu.vote) AS avg, 
            SUM (
            CASE
              WHEN vote == 1 THEN 1
              ELSE 0
            END) AS total_up,
            SUM (
            CASE
              WHEN vote == -1 THEN 1
              ELSE 0
            END) AS total_down FROM idea AS i 
        LEFT JOIN idea_user AS iu ON iu.idea_id = i.id 
        INNER JOIN user AS u ON i.author_id = u.id
        WHERE u.id = '$user'  
        GROUP BY i.id; ";
        $stmt = $this->db()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Idea');
    }

    /*
    $sql = "
        SELECT 
            COUNT(iu.vote) AS total,
            SUM(iu.vote) AS note,
            AVG(iu.vote) AS avg, 
            SUM (
            CASE
              WHEN vote == 1 THEN 1
              ELSE 0
            END) AS total_up,
            SUM (
            CASE
              WHEN vote == -1 THEN 1
              ELSE 0
            END) AS total_down,
            * FROM idea AS i 
        LEFT JOIN idea_user AS iu ON iu.idea_id = i.id 
        GROUP BY i.id; 

    " */

    public function fetchBySlug($slug)
    {
        $sql = "
        SELECT 
            i.id, u.id AS author_id, u.email AS author_email, i.title, i.description, i.publish_date, i.image, i.slug,
            COUNT(iu.vote) AS total,
            SUM(iu.vote) AS note,
            AVG(iu.vote) AS avg, 
            SUM (
            CASE
              WHEN vote == 1 THEN 1
              ELSE 0
            END) AS total_up,
            SUM (
            CASE
              WHEN vote == -1 THEN 1
              ELSE 0
            END) AS total_down,
            MAX(CASE WHEN iu.author_id = '".AuthController::getLogedId()."' THEN iu.vote ELSE NULL END) AS my_vote
        FROM idea AS i 
        LEFT JOIN idea_user AS iu ON iu.idea_id = i.id 
        INNER JOIN user AS u ON i.author_id = u.id 
        WHERE i.slug = '$slug'
        GROUP BY i.id; ";
        $stmt = $this->db()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Idea');
        return $stmt->fetch();
    }

    public function store($title, $slug, $description, $image, $author)
    {  
        $i = 1;
        $valid_slug = $slug;
        while($this->fetchBySlug($valid_slug)){
            $valid_slug = $slug."-".++$i;
        }

        $sql = "INSERT INTO idea(author_id, title, slug, description, publish_date, image) VALUES (:author_id, :title, :slug, :description, :date, :image) ";
        $date = date('Y-m-d H:i:s');
        
        $req = $this->db()->prepare($sql);
        try {
            $req->execute(array(
                "author_id" => $author, 
                "title" => $title, 
                "slug" => $valid_slug, 
                "description" => $description, 
                "image" => $image, 
                "date" => $date
            ));
        
            $idea = new Idea;
            $idea->setId($this->db()->lastInsertId());
            $idea->setTitle($title);
            $idea->setSlug($valid_slug);
            $idea->setDescription($description);
            $idea->setPublishDate($date);
            $idea->setImage($image);
    
            return $idea;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateIdea($id, $title, $slug, $description)
    {  
        $i = 1;
        $valid_slug = $slug;
        
        $idea = $this->fetchBySlug($valid_slug);
        while($idea && $idea->getId() != $id){
            $valid_slug = $slug."-".++$i;
        }

        $sql = "UPDATE idea SET title = :title, slug = :slug, description = :description WHERE id = :id ";
        
        $req = $this->db()->prepare($sql);
        try {
            $req->execute(array(
                "id" => $id, 
                "title" => $title, 
                "slug" => $valid_slug, 
                "description" => $description
            ));
    
            return true;
        } catch (\Throwable $th) {
            var_dump($th);
            throw $th;
        }
    }

    public function updateImage($id, $image)
    {  
        $sql = "UPDATE idea SET image = :image WHERE id = :id ";
        
        $req = $this->db()->prepare($sql);
        try {
            $req->execute(array(
                "id" => $id, 
                "image" => $image
            ));
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    
    public function updateVote($idea, $author, $vote = 0)
    {  
         try {

             $sql = "SELECT vote FROM idea_user WHERE idea_id = :idea AND author_id = :user ;";
             $req = $this->db()->prepare($sql);
             $req->execute(array(
                 "idea" => $idea, 
                 "user" => $author
             ));
    
             $fetch = $req->fetch();
             if(!$fetch){
                $sql = "INSERT INTO idea_user(author_id, idea_id, vote) VALUES (:user, :idea, :vote);";
                $req = $this->db()->prepare($sql);
                $req->execute(array(
                    "idea" => $idea, 
                    "user" => $author,
                    "vote" => $vote/abs($vote)
                ));
             } else if($vote == 0 || $vote == $fetch['vote'] ){
                $sql = "DELETE FROM idea_user WHERE idea_id = :idea AND author_id = :user ;";
                $req = $this->db()->prepare($sql);
                $req->execute(array(
                    "idea" => $idea, 
                    "user" => $author
                ));
                 
             } else {
                $sql = "UPDATE idea_user SET vote = :vote WHERE idea_id = :idea AND author_id = :user ;";
                $req = $this->db()->prepare($sql);
                $req->execute(array(
                    "idea" => $idea, 
                    "user" => $author,
                    "vote" => $vote/abs($vote)
                ));
             }
             return true;
         } catch (\Throwable $th) {
             throw $th;
         }
    }

    
    public function getVoteByUserAndId($user, $id)
    {  
    }
}