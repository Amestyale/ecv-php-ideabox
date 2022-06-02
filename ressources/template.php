<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/public/general.css" />
    <link rel="stylesheet" href="/public/nav.css" />
</head>
<body>
      <nav class="o-navbar--responsive">
          <div class="navbar">
            <div class="container nav-container">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div class="hamburger-lines">
                  <span class="line line1"></span>
                  <span class="line line2"></span>
                  <span class="line line3"></span>
                </div>  
              <div class="menu-items">
                
                <li><a href="/idees">Idées</a></li>
                <?php if(AuthController::getLoged()): ?>
                <li><a href="/idees/mes-idees">Mes idées</a></li>
                <li><a href="/idees/nouvelle-idee">Poster une idée</a></li>
                <li><a href="/authentification/deconnexion">Déconnexion</a></li>
                <?php else: ?>
                <li><a href="/authentification/connexion">Connexion</a></li>
                <li><a href="/authentification/inscription">Inscription</a></li>
                <?php endif; ?>
              </div>
            </div>
          </div>
      </nav>
      <header class="navbar o-navbar--desktop">
        <?php if(AuthController::getLoged()): ?>
            <span>Bonjour <?= AuthController::getLoged()->getEmail() ?></span>
        <?php else: ?>
            <span></span>
        <?php endif; ?>
        <nav>
            <ul class="l-group l-group--end">
                <li><a href="/idees">Idées</a></li>
                <?php if(AuthController::getLoged()): ?>
                <li><a href="/idees/mes-idees">Mes idées</a></li>
                <li><a href="/idees/nouvelle-idee">Poster une idée</a></li>
                <li><a href="/authentification/deconnexion">Déconnexion</a></li>
                <?php else: ?>
                <li><a href="/authentification/connexion">Connexion</a></li>
                <li><a href="/authentification/inscription">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </nav>
      </header>
    <main>
        <?= $content ?>
    </main>
</body>
</html>