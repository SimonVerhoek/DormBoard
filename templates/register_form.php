<script type="text/javascript">
    $(document).ready(function() {
/*
        // validate input
        $('#register-form').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            live: 'enabled',
            submitButtons: 'button[name="submitButton"]',
            submitHandler: null,
            fields: {
                firstname: {
                    validators: {
                        notEmpty: {
                            message: 'Please fill in your first name.'
                        },
                        stringLength: {
                            min: 2,
                            max: 20,
                            message: 'Invalid name length.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z -]+$/,
                            message: 'Your name can only consist of alphabetical characters and spaces.'
                        }
                    }
                },
                lastname: {
                    validators: {
                        notEmpty: {
                            message: 'Please fill in your last name.'
                        },
                        stringLength: {
                            min: 2,
                            max: 20,
                            message: 'Invalid name length.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z -]+$/,
                            message: 'Your name can only consist of alphabetical characters and spaces.'
                        }
                    }
                },
                email: {
                    threshold: 8,
                    validators: {
                        notEmpty: {
                            message: 'Please fill in an email address.'
                        },
                        emailAddress: {
                            message: 'Invalid email address.'
                        }
                    }
                },
                password: {
                    trigger: 'blur',
                    validators: {
                        notEmpty: {
                            message: 'Please provide a password.'
                        },
                        stringLength: {
                            min: 8,
                            max: 30,
                            message: 'Please fill in a password between 8 and 30 characters long.'
                        }
                    }
                },
                confirmation: {
                    trigger: 'blur',
                    validators: {
                        notEmpty: {
                            message: 'Please repeat your password.'
                        },
                        identical: {
                            field: 'password',
                            message: 'You filled in two different passwords!'
                        }
                    }
                }
            }
        });
*/
    });
</script>

<div class="row clearfix">
    <div class='col-md-3 column'></div>
    <div class='col-md-3 column'>
        <form id="register-form" role="form" action="register.php" method="post">
            <fieldset>
                <legend>Name</legend>
                <div class="form-group">
                    <input autofocus class="form-control" name="firstname" placeholder="First name" type="text"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="lastname" placeholder="Last name" type="text"/>
                </div>
            </fieldset>
               
            <fieldset>
                <legend>Date of birth</legend>
                <?php echo printDateDropdown(); ?>
                <br />
            </fieldset>
              
            <fieldset>
                <legend>Email & password</legend>
                <div class="form-group">
                    <input class="form-control" name="email" placeholder="Email address" type="text"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="password" placeholder="Password" type="password"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="confirmation" placeholder="Repeat password" type="password"/>
                </div>
                <div class="form-group">
                    <button type="submit" name="submitButton" class="btn btn-success">Register</button>
                </div>
            </fieldset> 
        </form>
        <a class="btn btn-default" href="login.php">< Back</a>
    </div> <!-- ./ col-md-3 column -->
   
</div> <!-- ./ row clearfix -->