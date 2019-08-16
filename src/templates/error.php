<?php

use Quiz\View;

/**
 * @var View $this
 * @var array $params
 */

$content = $this->renderContent($params);

$this->registerCssFile('css/error.css');

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

<?= $this->renderView('messages'); ?>

<main role="main" class="flex-shrink-0">
    <div class="container mt-4 ses">
        <?= $content ?>
    </div>
</main>

<?php if ($this->js): ?>
    <script>
        <?= $this->js; ?>
    </script>
<?php endif; ?>

</body>
</html>
