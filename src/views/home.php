<?php
/**
 * @var \Quiz\View $this
 * @var array $quizData
 */

use Quiz\ActiveUser;
$userName = ActiveUser::getLoggedInUser()->name;
?>
    <div class="text-center">
        <div class="col-md-12">
             <quiz :name='<?= json_encode($userName); ?>' :quizzes-prop='<?= json_encode($quizData); ?>' ></quiz>
        </div>
    </div>



