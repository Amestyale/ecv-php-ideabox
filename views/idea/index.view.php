<?php ob_start(); ?>
<h1>Idées proposées</h1>
<div class="l-container l-container--roomy js-cards">
    <?php include './views/idea/cards.view.php' ?>
</div>
<button class="o-btn o-btn--central js-showmore">Afficher plus</button>
<script src="/public/home.js"> </script> 
<?php $content = ob_get_clean(); ?>
