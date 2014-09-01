<div class="col-xs-10 column">

    <!-- leave dorm --> 
    <div class="row clearfix">

        <!-- Button trigger modal -->
        <legend>Leave dorm</legend>
        
        <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">
            Leave dorm
        </button>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Leave dorm</h4>
                    </div> <!-- close modal-header -->

                    <form action="account.php" method="post">
                        <fieldset>

                            <div class="modal-body">
                                <p>
                                    BEWARE: If you leave your dorm, all the data of you as a roommate here, will be deleted!
                                </p>
                            </div> <!-- closes modal-body -->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Cancel
                                </button>
                                <input type="hidden" name="leave-dorm" value="leave-dorm" />
                                <button type="submit" class="btn btn-danger">Leave dorm</button> 
                            </div> <!-- closes modal-footer -->

                        </fieldset>
                    </form>

                </div> <!-- closes modal-content -->
            </div> <!-- closes modal-dialog -->
        </div> <!-- closes modal -->

    </div> <!-- closes row-clearfix -->

    <!-- change timezone -->
    <div class="row clearfix">

            <!-- timezone-form.php -->

    </div>

    <!-- change password -->
    <div class="row clearfix">
            
        <form action="account.php" class="form-horizontal" role="form"  method="post">
            <fieldset>
                <legend>Change password</legend>

                <?php
                    if ($passwordUpdated === true)
                    {
                        echo (  '<div class="alert alert-success" role="alert">' .
                                    'Password changed.' .
                                '</div>');
                    }
                ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Old password</label>
                    <div class="col-sm-4">
                        <input name="password-old" type="password" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">New password</label>
                    <div class="col-sm-4">
                        <input name="password-new" type="password" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Confirm new password</label>
                    <div class="col-sm-4">
                        <input name="password-new-confirm" type="password" class="form-control" >
                    </div>
                </div>

                <input type="hidden" name="change-password" value="change-password" />

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">Change password</button>
                    </div>
                </div>  
                
            </fieldset>
        </form>

    </div> <!-- closes change password row -->

</div> <!-- closes column -->