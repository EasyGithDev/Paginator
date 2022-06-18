<?php
require __DIR__ . '/../autoload.php';

$nav = new Paginator(100);
$nav->setPresenterClass(BoostrapPresenter::class)
    ->setDisplay(Paginator::DISPLAY_FIRST_LAST | Paginator::DISPLAY_PREV_NEXT);
?>
<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        body {
            width: 80%;
            margin: 0px auto;
            /* border: solid 1px #000; */
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center"">
        <div class="row align-items-center">

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
    </div>

</body>

</html>