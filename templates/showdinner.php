<script type="text/javascript">

	// make Dinner tab active
	$(document).ready(function() {
		$("#navdinner").addClass("active");

	});
</script>

<!-- Dinner schedule -->
<div class="col-xs-10 column" id="dinner-column">

	<div class="tab-header">

		<h1>Dinner Schedule</h1>

		<div>
			<?php 
				build("dinner_form.php", [
					"days" => $days
					]) ;
			?>
		</div>
		
	</div>

	<div class="tab-content">

		<table class="table table-condensed" id="dinner-table">
			<thead id="dinner-table-header">
				<tr>
					<td></td>
					<?php 
						foreach ($days as $i => $day) 
						{
							echo "<th>";
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
					    	echo "<br>";

					    	echo $day->format("F jS");

					    	echo "</th>";
						}
					?>
				</tr>
			</thead>
			<tbody id="dinner-table-body">
				<?php
					// for every roommate
					foreach ($roommates as $roommate)
					{
						// print roommate's name
						echo "<tr id='dinner-row'>";
				    	echo(	"<td id='rm-names'>" . 
				    			$roommate["first_name"] .  
				    			"</td>"
			    			);

				    	// for every upcoming day
				    	foreach ($days as $day) 
						{ 
					    	echo "<td>";

					    	$today = $day->format('Y-m-d');

					    	// for every roommate's status
					    	foreach ($statuses as $status)
					    	{
					    		// if status is from this user &
					    		// status is from this day
						    	if (($status["user_id"] === $roommate["user_id"]) && 
						    		($status["action_date"] === $today))
						    	{
					    			// show appropriate text
					    			switch ($status["status"])
					    			{
					    				case '1':
					    					echo "<img class='icon' src=" . WEBSITEROOT . "/img/cook3.png>";
					    					break;
				    					case '2':
				    						echo "<img class='icon' src=" . WEBSITEROOT . "/img/join3.png>";
				    						break;
			    						case '3':
			    							echo "<img class='icon' src=" . WEBSITEROOT . "/img/notjoin.png>";
					    				default:
					    					// print nothing
					    					break;
					    			}
						    	}
					    	}

							echo "</td>";	
						} 

						echo "</tr>";
					}	
				?>
			</tbody>
		</table>

	</div> <!-- ./ .tab-content -->

</div> <!-- ./ dinner-column -->


