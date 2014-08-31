<?php
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
    echo '<form action="account.php" role="form" class="form-horizontal" method="post">'; 
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
?>