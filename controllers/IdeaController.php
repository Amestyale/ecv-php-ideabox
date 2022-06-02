<?php

class IdeaController
{

    public function index()
    {
        $dao = new IdeaDao;
        $ideas = $dao->fetchAll(6,0);

        view("idea/index","Liste des idées", ["ideas" => $ideas]);
    }

    public function mine()
    {
        $dao = new IdeaDao;
        $ideas = $dao->fetchByUser(AuthController::getLogedId());

        view("idea/mine","Liste des idées", ["ideas" => $ideas]);
    }


    public function show($slug)
    {
        $dao = new IdeaDao;
        $idea = $dao->fetchBySlug($slug);

        view("idea/show","Idées ".$idea->getTitle(), ["idea" => $idea]);
    }
    
    public function create()
    {
        AuthController::needToBeLoged();
        view("idea/create","Publier une nouvelle idée");
    }
    
    public function store($data)
    {
        $title = (isset($data['title'])) ? $data['title'] : null;
        $description = (isset($data['description'])) ? $data['description'] : null;
        $image = (isset($data['image'])) ? $data['image'] : null;

        
        if(!$title) add_error('title','miss');
        if(!$description) add_error('description','miss');
        if(!$image) add_error('image','miss');
        
        if(has_errors()) return $this->create();

        $image_name = $this->storeImage($image);
        $slug = to_slug($title);
        try {
            $dao = new IdeaDao;
            $idea = $dao->store($title,$slug,$description,$image_name,AuthController::getLogedId());
            header("location: /idees/".$idea->getSlug());
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
    
    public function edit($slug)
    {
        $dao = new IdeaDao;
        $idea = $dao->fetchBySlug($slug);
        view("idea/update","Éditer une idée",["idea" => $idea]);
    }

    public function storeImage($img, $name = null)
    {
        if($name && file_exists("/public/uploads/idea/$name")) unlink("/public/uploads/idea/$name");
        $name = uniqid("idea_").time();
        return upload_file('idea',$name,$img);
    }
    
    public function update($slug, $data)
    {
        $dao = new IdeaDao;
        $idea = $dao->fetchBySlug($slug);

        $title = (isset($data['title'])) ? $data['title'] : null;
        $description = (isset($data['description'])) ? $data['description'] : null;
        $image = (isset($data['image'])) ? $data['image'] : null;

        if(!$title) add_error('title','miss');
        if(!$description) add_error('description','miss');
        if(has_errors()) return $this->create();

        $slug = to_slug($title);
        if($image['size'] > 0) {
            $link = $this->storeImage($image, $idea->getImage());
            $dao->updateImage($idea->getId(),$link);
        }
        try {
            $dao = new IdeaDao;
            $data_dao = $dao->updateIdea($idea->getId(),$title,$slug,$description);
            header("location: /idees/".$data_dao['slug']);
        } catch (\Throwable $th) {
            return $th;
        }
        exit;
        view("idea/create","Publier une nouvelle idée");
    }
    
    public function destroy($slug){
        $dao = new IdeaDao;
        $idea = $dao->fetchBySlug($slug);
        if($idea->getAuthorId() != AuthController::getLogedId()) return error_404();
        $idea = $dao->deleteBySlug($slug);

        header("location: /idees");
    }

    public function vote($slug, $value)
    {
        AuthController::needToBeLoged();
        $dao = new IdeaDao;
        $idea = $dao->fetchBySlug($slug);
        
        $dao->updateVote($idea->getId(), AuthController::getLogedId(), $value);
        header("location: /idees/$slug");
    }

    public function showmore($offset){
        $dao = new IdeaDao;
        $ideas = $dao->fetchAll(6, $offset);
        if(count($ideas) == 0){
            die();
        }
        else require './views/idea/cards.view.php';
    }
    
}