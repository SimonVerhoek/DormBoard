<script type="text/javascript">
    $(document).ready(function() {
 
        $('#create-dorm').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            live: 'enabled',
            submitButtons: 'button[name="create"]',
            submitHandler: null,
            trigger: 'blur',
            fields: {
                dormname: {
                    validators: {
                        notEmpty: {
                            message: "Please fill in a name for the dorm you want to create."
                        },
                        stringLength: {
                            min: 2,
                            max: 50,
                            message: "Please pick a name that is between 2 and 50 characters long."
                        }
                    }
                },
                dormpassword: {
                    validators: {
                        notEmpty: {
                            message: "Please provide a password."
                        },
                        stringLength: {
                            min: 8,
                            max: 30,
                            message: 'The password should be between 8 and 30 characters long.'
                        }
                    }
                },
                confirmation: {
                    validators: {
                        notEmpty: {
                            message: "Please repeat your password."
                        },
                        identical: {
                            field: 'dormpassword',
                            message: 'You filled in two different passwords!'
                        }
                    }
                }
            }
        })
    });
</script>

<div class="row clearfix">

    <div class="alert alert-info">
        <p>
            Before you can make use of DormBoard's features, you need to either join an existing dorm or create a new one.
        </p>
    </div>

    <div class="col-md-6 column">

        <!-- Join an existing dorm --> 
        <form id="join-dorm" role="form" action="getdorm.php" method="post">
            <fieldset>
                <legend>Join an existing dorm</legend>
                <div class="form-group">
                    <input autofocus class="form-control" name="dormname" placeholder="Dorm name" type="text"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="dormpassword" placeholder="Dorm's password" type="password"/>
                </div>
                <div class="form-group">
                    <button type="submit" name="join" class="btn btn-default">
                        Join
                    </button> 
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-md-6 column">

        <!-- Join an existing dorm -->
        <form id="create-dorm" role="form" action="getdorm.php" method="post">
            <fieldset>
                <legend>Create a new dorm</legend>
                <div class="form-group">
                    <input class="form-control" name="dormname" placeholder="Dorm name" type="text"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="dormpassword" placeholder="Dorm's password" type="password"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="confirmation" placeholder="Repeat password" type="password"/>
                </div>

                <div class="alert alert-danger" tabIndex="-1">
                    <p tabIndex="-1">
                        Write these down somewhere! Your roommates can only join your dorm if they have these credentials!                        
                    </p>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="create" class="btn btn-default">
                        Create
                    </button> 
                </div>
            </fieldset>
        </form>
    </div>

</div>