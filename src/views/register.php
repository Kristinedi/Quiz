<?php
use Quiz\View;

?>


<div class="container mt-3  col-md-4 text-center">
    <h3 class="mb-4">Please, register!</h3>
    <form action="/registerPost" method="POST">
        <div class="form-group">
            <input required type="text" name="name" placeholder="Name" class="form-control">
        </div>
        <div class="form-group">
            <input required type="email" name="email" placeholder="Email" class="form-control">
        </div>
        <div class="form-group">
            <input required type="password" name="password" placeholder="Password" class="form-control">
        </div>
        <div class="form-group">
            <input required type="password" name="password_confirmation" placeholder="Repeat password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
