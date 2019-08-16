<?php

use Quiz\View;
?>

<div class="container mt-3  col-md-4 text-center">
    <h3 class="mb-4">Please, log in!</h3>
    <form action="/loginPost" method="POST">
        <div class="form-group">
            <input required type="email" name="email" class="form-control" placeholder="Enter email">
        </div>
        <div class="form-group">
            <input required type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login </button>
    </form>
</div>

