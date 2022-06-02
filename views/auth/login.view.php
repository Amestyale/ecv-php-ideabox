<?php ob_start(); ?>
    <div class="o-pres  o-pres--alone">
        <div class="o-pres__body">
            <div class="o-pres__content">
                <h1>Connexion</h1>
                <form method="POST">
                    <?php generate_errors("login"); ?>
                    <label>
                        <p>Adresse mail</p>
                        <?php generate_errors("email"); ?>
                        <input name="email" type="email" />
                    </label>
                    <label>
                        <p>Mot de passe</p>
                        <?php generate_errors("password"); ?>
                        <input name="password" type="password" />
                    </label>
                    <input class="o-btn" type="submit" value="Se connecter"/>
                </form>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
