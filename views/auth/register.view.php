
<?php ob_start(); ?>
    <div class="o-pres  o-pres--alone">
        <div class="o-pres__body">
            <div class="o-pres__content">
                <h1>Inscription</h1>
                <form method="POST">
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
                    <label>
                        <p>Confirmer le mot de passe</p>
                        <?php generate_errors("confirm-password"); ?>
                        <input name="confirm-password" type="password" />
                    </label>
                    <input class="o-btn" type="submit" value="S'enregistrer"/>
                </form>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
