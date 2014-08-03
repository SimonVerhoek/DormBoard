<script type="text/javascript">
    // validate input live
    $(document).ready(function() {

        $('#login-form').bootstrapValidator({
            message: 'Invalid email and/or password.',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            live: 'enabled',
            submitButtons: 'button[name="submitButton"]',
            submitHandler: null,
            fields: {
                email: {
                    validators: {
                        trigger: "blur",
                        notEmpty: {
                            message: 'You must provide your email address.'
                        },
                        emailAddress: {
                            message: 'Invalid email address.'
                        }
                    }
                },
                password: {
                    threshold: 8,
                    validators: {
                        trigger: "blur",
                        notEmpty: {
                            message: 'You must enter your password.'
                        },
                        stringLength: {
                            min: 8,
                            max: 30,
                            message: 'Invalid password.'
                        }
                    }
                }

            }
        });

    });
</script>

<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <button type="button" data-toggle="dropdown" class="btn btn-default navbar-btn dropdown-toggle" id="login-toggle-autofocus">
            Log in
        </button>
        <ul class="dropdown-menu" id="login-dropdown">

            <form id="login-form" action="login.php" method="post">
                
                    <div class="form-group">
                        <input id="login-autofocus" type="text" class="form-control" name="email" placeholder="Email address"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="password" placeholder="Password" type="password"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submitButton" class="btn btn-primary btn-block">
                            Log In
                        </button>
                    </div>
                 
             </form>

        </ul>
    </li>
    <li>
        <p id="header-or">or</p>
    </li>
    <li>
        <div>
            <a type="button" href="register.php" class="btn btn-default navbar-btn">
                Sign up
            </a>
        </div>
    </li>
</ul>



