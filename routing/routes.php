<?php



$router->get('/','IdeaController#index');
$router->scope('/authentification', function(Router $router){
    $router->get('/deconnexion','AuthController#logout');
    $router->get('/connexion','AuthController#login');
    $router->post('/connexion','AuthController#login_action');
    $router->get('/inscription','AuthController#create');
    $router->post('/inscription','AuthController#store');
    $router->get('/:id/profile','AuthController#show');
});


$router->get('/api/idees/:offset','IdeaController#showmore');
$router->scope('/idees', function(Router $router){
    $router->get('','IdeaController#index');
    $router->get('/mes-idees','IdeaController#mine');
    $router->get('/nouvelle-idee','IdeaController#create');
    $router->post('/nouvelle-idee','IdeaController#store');

    
    $router->get('/:slug','IdeaController#show');
    $router->get('/:slug/edition','IdeaController#edit');
    $router->post('/:slug/edition','IdeaController#update');
    $router->get('/:slug/vote/:vote','IdeaController#vote');
    $router->get('/:slug/suppression','IdeaController#destroy');
});
