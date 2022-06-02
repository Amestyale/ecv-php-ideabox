<?php ob_start(); ?>
    <div class="o-pres">
        <div class="o-pres__body">
            <img class="o-pres__img" src="<?= $idea->getPathImage() ?>" />
            <div class="o-pres__content">
                <form method="POST" enctype="multipart/form-data">
                    <label>
                        <p>Title</p>
                        <?php generate_errors("title"); ?>
                        <input name="title" type="title" value="<?= $idea->getTitle() ?>" />
                    </label>
                    <label>
                        <p>Description</p>
                        <?php generate_errors("description"); ?>
                        <textarea name="description"><?= $idea->getDescription() ?></textarea>
                    </label>
                    <label>
                        <p>Image</p>
                        <?php generate_errors("image"); ?>
                        <input name="image" type="file" />
                    </label>
                    <div class="l-group l-group--end l-topauto">
                        <input class="o-btn" type="submit" value="Enregistrer" />
                        <a href="/idees/<?= $idea->getTitle() ?>/suppression">
                            <button class="o-btn o-btn--danger" type="button">Supprimer</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

