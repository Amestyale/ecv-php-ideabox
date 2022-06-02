<?php ob_start(); ?>
    <div class="o-pres">
        <div class="o-pres__body">
            <img class="o-pres__img" src="<?= $idea->getPathImage() ?>" />
            <div class="o-pres__content">
                <p class="o-annotation">Idée soumise par <?= $idea->getAuthorEmail() ?>, <?= $idea->getPublishDateToString() ?></p>
                <h1> <?= $idea->getTitle() ?> </h1>
                <p> <?= $idea->getDescription() ?> </p>
                <div class="c-stats">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 400C64 408.8 71.16 416 80 416H480C497.7 416 512 430.3 512 448C512 465.7 497.7 480 480 480H80C35.82 480 0 444.2 0 400V64C0 46.33 14.33 32 32 32C49.67 32 64 46.33 64 64V400zM342.6 278.6C330.1 291.1 309.9 291.1 297.4 278.6L240 221.3L150.6 310.6C138.1 323.1 117.9 323.1 105.4 310.6C92.88 298.1 92.88 277.9 105.4 265.4L217.4 153.4C229.9 140.9 250.1 140.9 262.6 153.4L320 210.7L425.4 105.4C437.9 92.88 458.1 92.88 470.6 105.4C483.1 117.9 483.1 138.1 470.6 150.6L342.6 278.6z"/></svg>
                        <p class="c-stats__number"><?= $idea->total ?></p>
                        <p>vote<?= ($idea->total > 1) ? 's' : '' ?> au total</p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z"/></svg>
                        <p class="c-stats__number"><?= $idea->total_up ?></p>
                        <p>vote<?= ($idea->total_up > 1) ? 's' : '' ?>  positif<?= ($idea->total_up > 1) ? 's' : '' ?> </p>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 32.04H32c-17.67 0-32 14.32-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64c17.67 0 32-14.33 32-31.1V64.03C128 46.36 113.7 32.04 96 32.04zM467.3 240.2C475.1 231.7 480 220.4 480 207.9c0-23.47-16.87-42.92-39.14-47.09C445.3 153.6 448 145.1 448 135.1c0-21.32-14-39.18-33.25-45.43C415.5 87.12 416 83.61 416 79.98C416 53.47 394.5 32 368 32h-58.69c-34.61 0-68.28 11.22-95.97 31.98L179.2 89.57C167.1 98.63 160 112.9 160 127.1l.1074 160c0 0-.0234-.0234 0 0c.0703 13.99 6.123 27.94 17.91 37.36l16.3 13.03C276.2 403.9 239.4 480 302.5 480c30.96 0 49.47-24.52 49.47-48.11c0-15.15-11.76-58.12-34.52-96.02H464c26.52 0 48-21.47 48-47.98C512 262.5 492.2 241.9 467.3 240.2z"/></svg>
                        <p class="c-stats__number"><?= $idea->total_down ?></p>
                        <p>vote<?= ($idea->total_up > 1) ? 's' : '' ?> négatif<?= ($idea->total_up > 1) ? 's' : '' ?></p>
                    </div>
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M374.6 73.39c-12.5-12.5-32.75-12.5-45.25 0l-320 320c-12.5 12.5-12.5 32.75 0 45.25C15.63 444.9 23.81 448 32 448s16.38-3.125 22.62-9.375l320-320C387.1 106.1 387.1 85.89 374.6 73.39zM64 192c35.3 0 64-28.72 64-64S99.3 64.01 64 64.01S0 92.73 0 128S28.7 192 64 192zM320 320c-35.3 0-64 28.72-64 64s28.7 64 64 64s64-28.72 64-64S355.3 320 320 320z"/></svg>
                        <p class="c-stats__number"><?= $idea->getPercent() ?></p>
                        <p>d'appréciation</p>
                    </div>
                </div>
                
                <?php if(AuthController::getLogedId()  ): ?>
                    <div class="o-card__buttons l-group l-group--end">
                        <a href="/idees/<?= $idea->getSlug()?>/vote/1">
                            <button class="o-btn">
                                <?php if($idea->my_vote == 1): ?>
                                    Je n'approuve plus
                                <?php else: ?>
                                    J'approuve
                                <?php endif; ?>
                            </button>
                        </a>
                        <a href="/idees/<?= $idea->getSlug()?>/vote/-1">
                            <button class="o-btn">
                                <?php if($idea->my_vote == -1): ?>
                                    Je ne refuse plus
                                <?php else: ?>
                                    Je refuse
                                <?php endif; ?>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>
