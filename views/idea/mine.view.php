<?php ob_start(); ?>
<h1>Mes idées</h1>
<div class="l-container l-container--roomy js-cards">
    <?php include './views/idea/cards.view.php' ?>
</div>
<?php $content = ob_get_clean(); ?>
