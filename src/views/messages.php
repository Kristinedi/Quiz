<?php

use Quiz\Session;
use Quiz\View;
/**
 * @var View $this
 */

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php if(Session::getInstance()->hasErrors()): ?>
                <div class="alert alert-danger mb-0">
                    <ul class="mb-0">
                        <?php foreach (Session::getInstance()->getErrors(true) as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if(Session::getInstance()->hasMessages()): ?>
                <div class="alert alert-info  mb-0">
                    <ul class="mb-0">
                        <?php foreach (Session::getInstance()->getMessages(Session::TYPE_MESSAGE, true) as $message): ?>
                            <li><?= $message; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
