<div class="row clearfix">

    <div class="col-md-6 column">

        <!-- leave dorm --> 
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

   ***REMOVED*****REMOVED***

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
            echo '<form action="profile.php" method="post">'; 

            

            echo '<label>Select Your Timezone</label><select id="timezone">';
            foreach($timezones as $region => $list)
            {
                echo '<optgroup label="' . $region . '">' . "\n";
                foreach($list as $timezone => $name)
                {
                    echo '<option name="' . $timezone . '">' . $name . '</option>' . "\n";
                }
                echo '<optgroup>' . "\n";
            }
            echo '</select>';
        ***REMOVED***


        <!--
        <form action="profile.php" method="post">
            <fieldset>
                <legend>Set Timezone</legend>
                <div class="form-group">

                <select autofocus class="form-control" name="settimezone">
                    <option value="">Set timezone...</option>
          ***REMOVED*****REMOVED*****REMOVED***
                        /*
                        $timezones = DateTimeZone::listIdentifiers();
                        foreach ($timezones as $timezone) 
                        {
                            echo(   '<option value="">' .
                                    $timezone .
                                    '</option>'
                                );  
                        }
              ***REMOVED*****REMOVED***/
                    ***REMOVED***
                </select>
                    
                </div>
            </fieldset>
        </form>
        -->

    </div>

    <div class="col-md-6 column">

    </div>

</div>