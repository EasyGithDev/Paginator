<?php
require 'Pagination.php';
$nav = new Pagination(100);
?>
<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

</body>
<?= $nav ?>

<?php
$nav->setPresenterClass(BoostrapPresenter::class)
    ->setDisplay(Pagination::DISPLAY_FIRST_LAST | Pagination::DISPLAY_LIST)
    ->applyPresenter();
?>

<?= $nav ?>

</html>