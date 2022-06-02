<?php
session_start();

$url = isset($_GET['url']) ? $_GET['url'] : '/';

include_once './errors.php';
include_once './db/manager.php';

include_once './daos/Dao.php';
include_once './daos/UserDao.php';
include_once './daos/IdeaDao.php';

include_once './controllers/AuthController.php';
include_once './controllers/IdeaController.php';

include_once './models/Model.php';
include_once './models/User.php';
include_once './models/Idea.php';

include_once './functions.php';

include_once './routing/route.php';
include_once './routing/router.php';

$router = new Router($url);
include './routing/routes.php';

$router->render($url);

reset_errors();