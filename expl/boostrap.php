<?php
require __DIR__ . '/../autoload.php';

$nav = new Paginator(100);
$nav->setPresenterClass(BoostrapPresenter::class)
    ->setDisplay(Paginator::DISPLAY_FIRST_LAST | Paginator::DISPLAY_LIST);
?>
<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <?= $nav ?>

</body>

</html>