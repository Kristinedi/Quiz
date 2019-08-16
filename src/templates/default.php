<?php

use Quiz\View;

/**
 * @var View $this
 * @var array $params
 */

$content = $this->renderContent($params);

$this->registerJsFile('https://code.jquery.com/jquery-3.3.1.slim.min.js');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
$this->registerJsFile('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
$this->registerJsFile('js/index.js');
$this->registerCssFile('assets/style.css');
$this->registerCssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
$this->registerCssFile('css/main.css');
$this->registerJsFile('https://kit.fontawesome.com/51493d6833.js');

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    <?php if ($this->cssFiles): ?>
        <?php foreach ($this->cssFiles as $cssFile): ?>
            <link rel="stylesheet" href="<?= $cssFile; ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($this->jsFiles): ?>
        <?php foreach ($this->jsFiles as $jsFile): ?>
            <script src="<?= $jsFile; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</head>
<body class="d-flex flex-column h=100 pt-5">

<div id="app">
    <?= $this->renderView('header'); ?>

    <?= $this->renderView('messages'); ?>

    <main role="main" class="flex-shrink-0">
        <div class="container text-center">
            <?= $content ?>
        </div>
    </main>

    <?= $this->renderView('footer'); ?>
</div>

<?php if ($this->js): ?>
    <script>
        <?= $this->js; ?>
    </script>
<?php endif; ?>

<script src="assets/scripts.js"></script>

</body>
</html>
