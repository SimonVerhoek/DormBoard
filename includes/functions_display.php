<?php
	/*************************************************
     *   functions_display.php
     *
     *   Shows all functions purely for displaying
     *   HTML elements.
     *   
     **************************************************/

	/**
     * Puts input data in HTML table cell and
     * adds class.
     *
     *  - $class should be a string.
     *  - $text should be the value to output.
     */
    function putTableHeader($class, $text)
    {
        print(sprintf("<th class=%s>" . $text . "</th>", $class));
    }

    /**
     * Puts input data in HTML table cell and
     * adds class.
     *
     *  - $class should be a string.
     *  - $text should be the value to output.
     */
    function putTableCell($class, $text)
    {
        print(sprintf("<td class=%s>" . $text . "</td>", $class));
    }

    /**
     * Puts input data in HTML paragraph element.
     *
     *  - $class should be a string.
     *  - $text should be the value to output.
     */
    function putParagraph($class, $text)
    {
        print(sprintf("<p class=%s>" . $text . "</p>", $class));
    }

    /**
     * Puts input data in HTML checkbox element.
     *
     *  - $name     = value for "name" characteristic
     *  - $value    = value for "value" characteristic
     *  - $checked  = whether box should be checked or not. 
     *                input must be either "checked" or 
     *                "unchecked".
     */
    function putCheckbox($name, $value, $checked)
    {
        if ($checked == "checked" ||
            $checked == "unchecked") 
        {
            print(sprintf('<input type="checkbox" name=%s value=%s %s>', $name, $value, $checked));
        }
    }

    /**
     * Returns solved item in HTML format.
     *
     * Prints a checkmark glyphicon first, then prints the item's name,
     * posting data (who & when) and solving data (who & when).
     *
     * Requires:
     *  - $itemName     = string of the item's name
     *  - $namePoster   = string of the name of the poster
     *  - $nameSolver   = string of the name of the solver
     *  - $postDate     = date of posting in date() format
     *  - $solveDate    = date of solving in date() format
     */
    function putSolvedItem($itemName, $namePoster, $nameSolver, $postDate, $solveDate)
    {
        echo '<span class="glyphicon glyphicon-ok pull-right checkmark-done shoplist-checkmark-done"></span>' ;

        putParagraph(   "shoplist-item-name", $itemName);
        putParagraph(   "shoplist-item-data", "Posted by: " . $namePoster . ", at " . $postDate .
                        "<br>" .
                        'Bought by: ' . $nameSolver . ', at ' . $solveDate);
    }


    function printUpcomingDays()
    {
        // create dates of upcoming days
        $days = new DatePeriod(new DateTime, new DateInterval('P1D'), NRDAYSINCALENDAR);

        foreach ($days as $day) 
        {
            echo "<th>";
            // show "Today" and "Tomorrow" instead of day of week
            echo returnDay($day->format('l'));

            echo "<br>";

            echo $day->format("F jS");

            echo "</th>";
        }
    }
?>