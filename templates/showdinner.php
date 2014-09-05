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

		<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">
            Add
        </button>
		
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title">Add action</h4>
            </div> <!-- close modal-header -->

            <form role="form" class="form" action="dinner.php" method="post">
				<fieldset>

            		<div class="modal-body row">

						<div class="col-md-6">
							<div class="form-group">
								I will:
								<div class="radio dinner-radio">
									<label>
										<input type="radio" class="dinner-radio-button" name="what" value="1">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/cook3.png">
										Cook
									</label>
								</div>
								<div class="radio dinner-radio">
									<label>
										<input type="radio" class="dinner-radio-button" name="what" value="2">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/join3.png">
										Join dinner
									</label>
								</div>
								<div class="radio dinner-radio">
									<label>
										<input type="radio" class="dinner-radio-button" name="what" value="3">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/notjoin.png">
										NOT join dinner
									</label>
								</div>
							</div>
						</div> <!-- ./ column -->

						<div class="col-md-6">
							<div class="form-group">
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
							</div> <!-- ./ form-group -->
						</div> <!-- ./ column -->

					</div> <!-- /. modal-body -->	

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <input type="hidden" name="leave-dorm" value="leave-dorm" />
                        <button type="submit" class="btn btn-primary">Add</button> 
                    </div> <!-- closes modal-footer -->

                </fieldset>
            </form>

        </div> <!-- closes modal-content -->
    </div> <!-- closes modal-dialog -->
</div> <!-- closes modal -->


