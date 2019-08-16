<header>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-dark px-5">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/"><i class="fas fa-home pr-2"></i>Home<span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <?php if (\Quiz\ActiveUser::isLoggedIn()): ?>
                <ul class="nav navbar-nav flex-fill justify-content-center">
                    <li><a href="/newQuiz">Make New Quiz</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/logout">Logout <i class="fas fa-sign-out-alt pl-1"></i></a></li>
                </ul>
            <?php else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="pr-3 text-white"><a href="/register">Register <i class="fa fa-user-plus"></i></a></li>
                    <li><a href="/login">Login  <i class="fa fa-user"></i></a></li>
                </ul>
            <?php endif; ?>

        </div>
    </nav>
</header>


