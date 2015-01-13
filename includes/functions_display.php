<?php
	/*************************************************
     *   functions_display.php
     *
     *   Shows all functions purely for displaying
     *   HTML elements.
     *   
     **************************************************/

    /**
     * Puts input data in HTML image element and
     * adds class.
     *
     *  - $class should be a string.
     *  - $src should be the filepath to the image file.
     */
    function putImage($class, $src)
    {
        print(sprintf("<img class=%s src=%s>", $class, $src));
    }

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

    /**
     * Prints the specified number of upcoming days inside
     * table headers.
     */
    function printUpcomingDays($numberOfDays)
    {
        foreach (getUpcomingDays($numberOfDays) as $day) 
        {
            putTableHeader(" ", returnDay($day->format('l')) . "<br>" . $day->format("F jS"));
        }
    }

    /**
     * Prints the appropriate dinner icon regarding
     * the specified dinner status.
     * 
     * Status should be the number stored under
     * dinner["status"] in the mySQL db.
     */
    function putDinnerIcon($status)
    {
        switch ($status) 
        {
            case 1:
                putImage("icon", WEBSITEROOT . "/img/cook3.png");
                break;
            case 2:
                putImage("icon", WEBSITEROOT . "/img/join3.png");
                break;
            case 3:
                putImage("icon", WEBSITEROOT . "/img/notjoin.png");
                break;           
            default:
                // print nothing
                break;
        }
    }

    /**
     * Creates a dropdown menu for picking a date of birth.
     */
    function date_dropdown($year_limit = 1900)
    {
        $html_output = '<div id="date_select" >'."\n";

        // days
        $html_output .= '<select name="date_day" id="day_select">'."\n";
            for ($day = 1; $day <= 31; $day++) {
                $html_output .= '<option>' . $day . '</option>'."\n";
            }
        $html_output .= '</select>'."\n";

        // months
        $html_output .= '<select name="date_month" id="month_select" >'."\n";
        $months = array("", "January", "February", "March", "April", 
                            "May", "June", "July", "August", 
                            "September", "October", "November", "December");
            for ($month = 1; $month <= 12; $month++) {
                $html_output .= '<option value="' . $month . '">' . $months[$month] . '</option>'."\n";
            }
        $html_output .= '</select>'."\n";

        // years
        $html_output .= '<select name="date_year" id="year_select">'."\n";
            for ($year = date("Y"); $year >= $year_limit; $year--) {
                $html_output .= '<option>' . $year . '</option>'."\n";
            }
        $html_output .= '</select>'."\n";

        $html_output .= '</div>'."\n";
        return $html_output;
    }
?>