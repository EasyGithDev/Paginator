<?php
require __DIR__ . '/../autoload.php';

use EasyGithDev\Paginator\Paginator as Paginator;
use EasyGithDev\Paginator\BoostrapPresenter as BoostrapPresenter;

$nav = new Paginator(100);
$nav->setPresenterClass(BoostrapPresenter::class);
?>
<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="d-flex h-100 text-center">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">


        <main class="px-3">
            <h1>Display Type</h1>

            <div class="row align-items-center">

                <h3>Paginator::ALL</h3>

                <div class="col">
                    <?= $nav ?>
                </div>
                <div class="col">
                    <?= $nav->getCurrentPage() ?>
                    /
                    <?= $nav->getNbPage() ?>&nbsp;
                    pages
                </div>
            </div>

            <?php
            $nav->setDisplayType(Paginator::DISPLAY_LIST | Paginator::DISPLAY_FIRST_LAST);
            ?>

            <div class="row align-items-center">

                <h3>Paginator::DISPLAY_LIST|Paginator::DISPLAY_FIRST_LAST</h3>

                <div class="col">
                    <?= $nav ?>
                </div>
                <div class="col">
                    <?= $nav->getCurrentPage() ?>
                    /
                    <?= $nav->getNbPage() ?>&nbsp;
                    pages
                </div>
            </div>

            <?php
            $nav->setDisplayType(Paginator::DISPLAY_LIST);
            ?>

            <div class="row align-items-center">

                <h3>Paginator::DISPLAY_LIST</h3>

                <div class="col">
                    <?= $nav ?>
                </div>
                <div class="col">
                    <?= $nav->getCurrentPage() ?>
                    /
                    <?= $nav->getNbPage() ?>&nbsp;
                    pages
                </div>
            </div>

            <?php
            $nav->setDisplayType(Paginator::DISPLAY_FIRST_LAST | Paginator::DISPLAY_PREV_NEXT);
            ?>

            <div class="row align-items-center">

                <h3>Paginator::DISPLAY_FIRST_LAST | Paginator::DISPLAY_PREV_NEXT</h3>

                <div class="col">
                    <?= $nav ?>
                </div>
                <div class="col">
                    <?= $nav->getCurrentPage() ?>
                    /
                    <?= $nav->getNbPage() ?>&nbsp;
                    pages
                </div>
            </div>

            <?php
            $nav->setDisplayType(Paginator::DISPLAY_PREV_NEXT);
            ?>

            <div class="row align-items-center">

                <h3>Paginator::DISPLAY_PREV_NEXT</h3>

                <div class="col">
                    <?= $nav ?>
                </div>
                <div class="col">
                    <?= $nav->getCurrentPage() ?>
                    /
                    <?= $nav->getNbPage() ?>&nbsp;
                    pages
                </div>
            </div>

        </main>

    </div>

</body>

</html>