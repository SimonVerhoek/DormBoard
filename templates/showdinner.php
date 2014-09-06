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
		
	</div>

	<div class="tab-content">

		<table class="table table-condensed" id="dinner-table">
			<thead id="dinner-table-header">
				<tr>
					<td>
						<button class="btn btn-custom btn-lg" data-toggle="modal" data-target="#myModalCustom">
				            Add
				        </button>
					</td>
					<?php 
						foreach ($days as $i => $day) 
						{
							echo "<th>";
							// show "Today" and "Tomorrow" instead of day of week
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

<div class="modal custom fade" id="myModalCustom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" align="center">I will:</h4>
            </div> <!-- close modal-header -->

            <form role="form" class="form" action="dinner.php" method="post">
				<fieldset>

            		<div class="modal-body row" id="dinner-modal-body">

						<div class="col-xs-3 dinner-modal-column">
							<div class="form-group">

								<div class="btn-group dinner-buttons" data-toggle="buttons">
									<label class="btn btn-custom-dinner dinner-button">
										<input type="radio" class="dinner-radio-button" name="what" value="1">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/cook3.png">
									</label>
									<label class="btn btn-custom-dinner dinner-button">
										<input type="radio" class="dinner-radio-button" name="what" value="2">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/join3.png">
									</label>
									<label class="btn btn-custom-dinner dinner-button">
										<input type="radio" class="dinner-radio-button" name="what" value="3">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/notjoin.png">
									</label>
								</div> <!-- ./ .dinner-buttons -->

							</div> <!-- ./ form-group -->
						</div> <!-- ./ column -->

						<div class="col-xs-3" id="dinner-button-label-column">
							<div class="row-fluid dinner-button-label">
								<p>Cook</p>
							</div>
							<div class="row-fluid dinner-button-label">
								<p>Join dinner</p>
							</div>
							<div class="row-fluid dinner-button-label">
								<p>NOT join dinner</p>
							</div>
						</div>

						<div class="col-xs-6 dinner-modal-column">
							<div class="form-group">

								<div class="btn-group dinner-buttons" data-toggle="buttons">
								<?php
									foreach ($days as $i => $day) {
										// store day in variable for easy storing in db
										$dayDate = $day->format('y-m-d');

										echo(	'<label class="btn btn-custom-dinner dinner-button">' .
													'<input type="radio" class="dinner-radio-button" name="when"' .
													'value="' . $dayDate . '">'
											);

										// show "Today" and "Tomorrow" instead of day of week
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
								    	echo " (" . $day->format("F jS") . ")";
								    	echo "</label>";
									}
								?>
								</div> <!-- ./ btn-group .dinner-buttons -->
							</div> <!-- ./ form-group -->
						</div> <!-- ./ column -->

					</div> <!-- /. modal-body -->	

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Cancel
                        </button>
                        <input type="hidden" name="leave-dorm" value="leave-dorm" />
                        <button type="submit" class="btn btn-success">Add</button> 
                    </div> <!-- ./ modal-footer -->

                </fieldset>
            </form>

        </div> <!-- ./ modal-content -->
    </div> <!-- ./ modal-dialog -->
</div> <!-- ./ modal -->


