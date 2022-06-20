<?php
require __DIR__ . '/../autoload.php';

use EasyGithDev\Paginator\Paginator as Paginator;
use EasyGithDev\Paginator\BoostrapPresenter as BoostrapPresenter;

$nav = new Paginator(100);
$nav->setPresenterClass(BoostrapPresenter::class)
    ->setMaxPageToDisplay(3);
?>
<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="d-flex h-100 text-center">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">

        <main class="px-3">

            <h1>Max Page To Display</h1>

            <?= $nav ?>
        </main>
    </div>

</body>

</html>