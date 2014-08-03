<!--
 |
 |  Shows a cash balance of the dorm's inhabitants.
 |
 -->

 <script type="text/javascript">

	// show Dinner tab on default
	$(document).ready(function() {

		$("#navfinances").addClass("active");

		$('#finances-form').bootstrapValidator({
			
            live: 'enabled',
            submitButtons: 'button[name="submitButton"]',
            submitHandler: null,
            fields: {
            	spend_name: {
            		validators: {
            			notEmpty: {
            				message: 'Please fill in a name for the spend.'
            			},
            			stringLength: {
            				max: 30,
            				message: "That's a long name! Maybe you can think of a shorter, clearer name?"
            			},
            			regexp: {
            				// only accept values with at least two alphabetic characters in it
            				regexp: /([A-Za-z])\w+/,
            				message: "This looks a bit unclear for your roommates. Maybe you can think of a clearer name?"
            			}
            		}
            	},
            	spend_cost_whole: {
            		validators: {
            				notEmpty: {
            					message: 'Please fill in the costs.'
            				},
	            			digits: {
	            				message: 'Please only fill in digits here.'
	            			}
            		}
            	},
            	spend_cost_cents: {
            		validators: {
	            			digits: {
	            				message: 'Please only fill in digits here.'
	            			}
            		}
            	},
            	'check_list[]': {
            		validators: {
            			notEmpty: {
	            			message: 'Please check at least one roommate who the spend is for.'
	            		}
            		}
            		
            	}
            }
		});
	});
	
</script>

<div class="row clearfix">
	<div class="col-md-12 column">
		<p class="lead">Finances</p>
	</div>
</div>

<div class="row clearfix">

	<!-- add new spend -->
	<div class="col-md-9 column">

		<form id="finances-form" role="form" class="form-horizontal" action="finances.php" name="newspend" method="post">
			<fieldset>
				<div class="form-group">
					<label class="col-sm-3 control-label">What did you buy?</label>
					<div class="col-sm-5">
						<input autofocus type="text" class="form-control" name="spend_name" placeholder="e.g. butter, bread and toilet paper">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">What did you spend?</label>
					<div class="col-sm-2">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control text-right" name="spend_cost_whole" placeholder="0">
						</div>
					</div>

					<div class="col-sm-2">
						<input type="text" class="form-control" name="spend_cost_cents" placeholder="00">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Who is it for?</label>
					<div class="col-sm-6">
						***REMOVED***
							foreach ($roommates as $roommate)
							{
								$rmID = $roommate["user_id"];

								echo(	'<div class="checkbox">' .
											'<label>' . 
												'<input type="checkbox" name="check_list[]"' . 
											'	value="' . $roommate["user_id"] . '" checked>'
									);
								// print "me" instead of own name
								if ($roommate["user_id"] == $_SESSION["user_id"])
								{
									echo 		"Me";
								}
								else
								{
									echo(		$roommate["first_name"] .
												" " .
												$roommate["last_name"]
										);
								};
								echo( 		'</label>' .
										'</div>'
									);
							}
						***REMOVED***
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
  						<button name="submitButton" type="submit" class="btn btn-primary" value="from-finances">Add</button>
					</div>
				</div>	
			</fieldset>
		</form>
	</div> <!-- close add new spend column -->

	<!-- roommates' cash balances -->
	<div class="col-md-3">
		<table class="table" id="rm-balances">
			<tbody>
				***REMOVED***
					foreach ($roommates as $roommate) 
					{
						echo	"<tr>"; 
						// apply cell based on balance level
						if ($roommate["cash_balance"] < 0)
						{
							echo '<td class="danger">';
						}
						else if ($roommate["cash_balance"] > 0)
						{
							echo '<td class="success">';
						}
						else
						{
							echo '<td>';
						}
						echo(	$roommate["first_name"] .
								" " .
								$roommate["last_name"] .
								"</td>" 
							);

						// color cell based on balance level
						if ($roommate["cash_balance"] < 0)
						{
							echo '<td class="danger text-right">';
						}
						else if ($roommate["cash_balance"] > 0)
						{
							echo '<td class="success text-right">';
						}
						else
						{
							echo '<td class="text-right">';
						}
						
						echo "$ ";
							
						if ($roommate["cash_balance"] > 0) 
						{
							echo "+";
						};
						echo(	$roommate["cash_balance"] .
								"</td>" .
								"</tr>"
							);
					}
				***REMOVED***
			</tbody>
		</table>
	</div> <!-- close cash balances column -->

	<!-- spends table -->
	<div class="col-md-9">
		<div class="table-responsive">
			<table class="table table-hover" id="spendstable">
				<thead>
					<tr>
						<th id="th-date">Date</th>
						<th id="th-spendname">Name</th>
						<th id="th-whopaidwhat" class="text-right">Who paid what</th>
					</tr>
				</thead>
				<tbody id="spendstable-body">
					***REMOVED***
						// for each spend
						foreach ($spends as $spend)
						{
							echo "<tr>";

							// post date
							echo(	"<td class='td-date'>" .
									date('l F jS', strtotime($spend["date_added"])) .
									"<br>" .
									date('H:i', strtotime($spend["date_added"])) .
									"</td>"
								);

							// spend name
							echo(	"<td class='td-spendname'>" .
									$spend["spend_name"] .
									"</td>"
								);

							// who paid what
							echo(	"<td class='td-whopaidwhat text-right'>" .
									$spend["first_name"] .
									" paid" .
									"<br>" .
									" $ " .
									$spend["spend_cost"] .
									"</td>"
								);

							echo "</tr>";
						}
					***REMOVED***
				</tbody>
			</table>
		</div>
	</div> <!-- close spend table column -->

</div> <!-- close row clearfix -->