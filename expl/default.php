<?php
require __DIR__ . '/../autoload.php';

use EasyGithDev\Paginator\Paginator as Paginator;

$nav = new Paginator(100);
?>
<html>

<head></head>

<body>

    <?= $nav ?>

</body>

</html>