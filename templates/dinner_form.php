<!--
 |
 |  Shows the form for entering an action
 |	into the dinner schedule.
 |
 -->

<form role="form" class="form-inline" action="dinner.php" method="post">
	<fieldset>

		<div class="form-group">
			I will
			<select autofocus class="form-control" name="what">
				<option value="">Choose what...</option>
				<option value="1">cook</option>
				<option value="2">join dinner</option>
				<option value="3">NOT join dinner</option>
			</select>

			<select autofocus class="form-control" name="when">
				<option value="">Choose when...</option>
				<?php 
					foreach ($days as $i => $day) 
					{ 
				    	// store day in variable for easy storing in db
				    	$dayDate = $day->format('y-m-d');

				    	// show "Today" and "Tomorrow" instead of day of week
				    	echo "<option value=$dayDate>";
				    	switch ($i) 
				    	{
				    		case 0:
				    			echo ("Today");
				    			break;
				    		case 1:
				    			echo ("Tomorrow");
				    			break;
				    		default:
				    			echo ($day->format('l'));
				    			break;
				    	}
		    			echo(	" (" . 
		    					$day->format("F jS") .	    					 
		    					")");
				    	echo "</option>";
					} 	
				?>
			</select>
            <button type="submit" class="btn btn-primary">Submit</button>
		</div> <!-- ./ .form-group -->
		
	</fieldset>
</form>