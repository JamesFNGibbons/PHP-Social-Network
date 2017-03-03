<div class="container">
    <div class="col-md-5 col-md-offset-3">
        <?php if(isset($vals['EmailUsedError']) && $vals['EmailUsedError']): ?>
            <div class="alert alert-danger">
                <b>
                    Error!
                </b>
                That email has already been used.
            </div>
        <?php endif; ?>
        <?php if(isset($vals['InvalidSchoolError']) && $vals['InvalidSchoolError']): ?>
            <div class="alert alert-danger">
                <b>
                    Error!
                </b>
                That school is not on this platform yet.
            </div>
        <?php endif; ?>
    </div>
</div>
    <div class="container">
         <div class="jumbotron" style="height: 300px;">
            <div class="col-md-8">
                <h2 style="margin: 0; padding: 0;">Register for StudentSharespace</h2>
                <img src="assets/img/connect.png" style="margin: 0; padding: 0; margin-left: -60px;" height="100%">
            </div>
            <div class="col-md-4">
                <form action="index.php?_p=register" method="post">
                    <input type="text" name="name" placeholder="Your Name" class="form-control"><br>
                    <input type="email" name="email" placeholder="Your Email" class="form-control"><br>
                    <input type="password" name="password" placeholder="Password" class="form-control"><br>
                    <input type="submit" value="Sign Up" class="form-control btn btn-primary">
                </form>
            </div>
        </div>
    </div>