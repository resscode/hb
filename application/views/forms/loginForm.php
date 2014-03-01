<div class="container">
    <?php
    echo!empty($errorMessage) ? '<div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        ' . $errorMessage . '
    </div>'
    : '';
    ?>
    <form class="form-signin" action="/service/login" method="post">
        <h2 class="form-signin-heading">Please sign in Service</h2>
        <input name ="email" type="text" class="input-block-level" placeholder="Email address">
        <input name ="password" type="password" class="input-block-level" placeholder="Password">
        <label class="checkbox">
            <input name ="remember" type="checkbox" value="remember-me"> Remember me
        </label>
        <input name ="sbm" class="btn btn-large btn-primary" value="Sign in" type="submit"/>
    </form>

</div>
