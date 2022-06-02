<?php ob_start(); ?>
    <div class="o-pres">
        <div class="o-pres__body">
            <img class="o-pres__img" src="/public/images/interrogation-mark.jpg" />
            <div class="o-pres__content">
                <form method="POST" enctype="multipart/form-data">
                    <label>
                        <p>Title</p>
                        <?php generate_errors("title"); ?>
                        <input name="title" type="title" />
                    </label>
                    <label>
                        <p>Description</p>
                        <?php generate_errors("description"); ?>
                        <textarea name="description"></textarea>
                    </label>
                    <label>
                        <p>Image</p>
                        <?php generate_errors("image"); ?>
                        <input name="image" type="file" />
                    </label>
                    <input class="o-btn" type="submit" value="S'enregistrer" />
                </form>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

