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
    <style>
        body {
            width: 80%;
            margin: 0px auto;
            /* border: solid 1px #000; */
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center">
        <?= $nav ?>
    </div>

</body>

</html>