    <div class="container">
        <div class="col-md-5 col-md-offset-2">
            <?php if(isset($vals['loginError']) && $vals['loginError']): ?>
                <div class="alert alert-danger">
                    <b>Login Error</b>
                    Username or password is incorrect.
                </div>
            <?php endif; ?>
            <form action="index.php?_p=login" method="post">
                <input type="email" name="email" class="form-control" placeholder="Email"><br>
                <input type="password" name="password" class="form-control" placeholder="Password"><br>
            </form>
        </div>
    </div>