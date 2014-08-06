<!-- leave dorm --> 
<div class="row clearfix">

        <form action="profile.php" method="post">
            <fieldset>
                <legend>Leave dorm</legend>
                <div class="form-group">

                    <button type="submit" name="leave" class="btn btn-danger">
                        Leave
                    </button>
                    <span class="help-block">
                        BEWARE: If you leave your dorm, all the data of you as a roommate here, will be deleted!
                    </span> 
                </div>
            </fieldset>
        </form>

</div>

<!-- change timezone -->
<div class="row clearfix">

   ***REMOVED*****REMOVED***
            /*

            // create option menu with timezones
            $regions = array(
                'Africa' => DateTimeZone::AFRICA,
                'America' => DateTimeZone::AMERICA,
                'Antarctica' => DateTimeZone::ANTARCTICA,
                'Aisa' => DateTimeZone::ASIA,
                'Atlantic' => DateTimeZone::ATLANTIC,
                'Europe' => DateTimeZone::EUROPE,
                'Indian' => DateTimeZone::INDIAN,
                'Pacific' => DateTimeZone::PACIFIC
            );

            $timezones = array();
            foreach ($regions as $name => $mask)
            {
                $zones = DateTimeZone::listIdentifiers($mask);
                foreach($zones as $timezone)
                {
                    // Lets sample the time there right now
                    $time = new DateTime(NULL, new DateTimeZone($timezone));

                    // Us dumb Americans can't handle millitary time
                    $ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';

                    // Remove region name and add a sample time
                    $timezones[$name][$timezone] = substr($timezone, strlen($name) + 1) . ' - ' . $time->format('H:i') . $ampm;
                }
            }


            // View
            echo '<form action="profile.php" role="form" class="form-horizontal" method="post">'; 
            echo    '<legend>Change timezone</legend>';

            

            echo    '<label class="col-sm-3 control-label">Select Your Timezone</label>';
            echo    '<select id="timezone">';

            foreach($timezones as $region => $list)
            {
                echo        '<optgroup label="' . $region . '">' . "\n";
                foreach($list as $timezone => $name)
                {
                    echo        '<option name="' . $timezone . '">' . $name . '</option>' . "\n";
                }
                echo    '</optgroup>' . "\n";
            }
            echo    '</select>';
            echo '</form>';

  ***REMOVED*****REMOVED***/
        ***REMOVED***
</div>

<!-- change password -->
<div class="row clearfix">
        
        <form action="change-password.php" class="form-horizontal" role="form"  method="post">
            <fieldset>
                <legend>Change password</legend>

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

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button name="submitButton" type="submit" class="btn btn-primary" value="">Change password</button>
                    </div>
                </div>  
                
            </fieldset>
        </form>

</div>