 <script type="text/javascript">

	// show Dinner tab on default
	$(document).ready(function() {

		$("#navfinances").addClass("active");

		$(document).on("click", ".open-modal", function (e) {

			e.preventDefault();

			var _self = $(this);

			// autofill item name in modal
			var _itemName = _self.data('id');
			$("#spend_name").val(_itemName);

			// add item id to form for solving
			var _itemID = _self.data('value');
			$("#from-shoplist").val(_itemID);			

			$(_self.attr('href')).modal('show');
		});

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

<div class="col-xs-7 column" id="finances-column">

		<div class="tab-header">

			<h1>Finances</h1>

			<button class="btn btn-custom btn-lg pull-right" id="add-spend-button" data-toggle="modal" data-target="#myModalCustom">
				Add
			</button>

		</div>

		<div class="tab-content">

			<div class="table-responsive">
				<table class="table" id="spendstable">
					<!--
					<thead>
						<tr>
							<th id="th-date">Date</th>
							<th id="th-spendname">Name</th>
							<th id="th-whopaidwhat" class="text-right">Who paid what</th>
						</tr>
					</thead>
				-->
					<tbody id="spendstable-body">
						<?php
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
						?>
					</tbody>
				</table>
			</div> <!-- ./ table-responsive -->

		</div> <!-- ./ tab-content -->

</div> <!-- ./ spends column -->


<!-- roommates' cash balances -->
<div class="col-xs-3 column right-column">
	<table class="table" id="rm-balances">
		<legend align="center">Balances</legend>
		<tbody>
			<?php
				foreach ($roommates as $roommate) 
				{
					echo	"<tr>"; 
					// apply cell based on balance level
					if ($roommate["cash_balance"] < 0)
					{
						echo '<td class="negative-balance">';
					}
					else if ($roommate["cash_balance"] > 0)
					{
						echo '<td class="positive-balance">';
					}
					else
					{
						echo '<td class="neutral-balance">';
					}
					
					echo $roommate["first_name"] . "</td>";

					// color cell based on balance level
					if ($roommate["cash_balance"] < 0)
					{
						echo '<td class="negative-balance text-right">';
					}
					else if ($roommate["cash_balance"] > 0)
					{
						echo '<td class="positive-balance text-right">';
					}
					else
					{
						echo '<td class="neutral-balance text-right">';
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
			?>
		</tbody>
	</table>
</div> <!-- close cash balances column -->


<div class="modal custom fade" id="myModalCustom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
    		<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel" align="center">Add spend</h4>
		    </div>

		    <form id="finances-form" role="form" class="form-horizontal" action="finances.php" name="newspend" method="post">
				<fieldset>

      				<div class="modal-body">
      			
						<div class="form-group">
							<label class="col-sm-4 control-label">What did you buy?</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" name="spend_name" placeholder="e.g. butter, bread and toilet paper">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-4 control-label">What did you spend?</label>
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
							<label class="col-sm-4 control-label">Who is it for?</label>
							<div class="col-sm-7">
								<?php
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
								?>
							</div> <!-- ./ column -->
						</div> <!-- ./ form-group -->
					</div> <!-- ./ modal-body -->
	      		
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			        	<button name="submitButton" type="submit" class="btn btn-success" value="from-finances">Add</button>
			      	</div>
			      	
	      		</fieldset>
			</form>
					
    	</div> <!-- close modal-content -->
  	</div> <!-- close modal-dialog -->
</div> <!-- close modal -->