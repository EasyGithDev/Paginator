<?php
require __DIR__ . '/../autoload.php';

use EasyGithDev\Paginator\Paginator as Paginator;
use EasyGithDev\Paginator\BoostrapPresenter as BoostrapPresenter;

function request()
{
    $val = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);
    return $val;
}

$nav = new Paginator(100);
$nav->setPresenterClass(BoostrapPresenter::class)
    ->setRequestFunction('request')
    ->setRequestParameter('p');

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