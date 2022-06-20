<?php
require __DIR__ . '/../autoload.php';

use EasyGithDev\Paginator\BootstrapPresenter;
use EasyGithDev\Paginator\Paginator as Paginator;
use EasyGithDev\Paginator\DataPresenter as DataPresenter;

$user = 'root';
$pass = 'root';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=paginator', $user, $pass);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$res = $pdo->query('SELECT count(*) from communes');
$count = $res->fetchColumn();

$limit = 10;
$offset = isset($_GET['page']) ? intval($_GET['page']) * $limit : 0;

$query = 'SELECT * from communes LIMIT ' . $offset . ',' . $limit;

$nav = new Paginator($count, $limit);
$nav->setPresenterClass(BootstrapPresenter::class)
    ->setMaxPageToDisplay(5);

?>
<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="d-flex h-100 text-center">

    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">

        <main class="px-3">

            <h1>Using Data</h1>

            <div class="row">
                <div class="col">
                    <table class="table table-striped table-bordered ">

                        <tr>
                            <th>Dep Num</th>
                            <th>Dep Name</th>
                            <th>City</th>
                        </tr>

                        <?php foreach ($pdo->query($query) as $row) : ?>
                            <tr>
                                <td><?= $row['COL1'] ?></td>
                                <td><?= $row['COL2'] ?></td>
                                <td><?= $row['COL3'] ?></td>
                            </tr>
                        <?php endforeach ?>

                    </table>
                </div>

            </div>

            <div class="row align-items-center">
                <div class="col">
                    <?= $nav ?>
                </div>
                <div class="col">
                    <div class="float-end">
                        <?= $nav->getCurrentPage() ?>
                        /
                        <?= $nav->getNbPage() ?>&nbsp;
                        pages

                    </div>
                </div>
            </div>

        </main>
    </div>

</body>

</html>