<!--
 |
 |  Shows the dorm's shopping list.
 |
 -->

<script type="text/javascript">

	$(document).ready(function() {

		// show Dinner tab
		$("#navshoplist").addClass("active");

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

		// directly validate input
		$('#shoplist-form').bootstrapValidator({
			
            live: 'enabled',
            submitButtons: 'button[name="submitButton"]',
            submitHandler: null,
            fields: {
            	item_name: {
            		validators: {
            			notEmpty: {
            				message: "You should give your item a name!"
            			},
            			regexp: {
            				// only accept values with at least two alphabetic characters in it
            				regexp: /([A-Za-z])\w+/,
            				message: "This looks a bit unclear for your roommates. Maybe you can think of a clearer name?"
            			}
            			
            		}
            	}
            }
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

<div class="row clearfix">
	<div class="col-md-9 column">

		<div class="panel" id="shoplist">

			<div class="panel-heading">
		    	
	    		<div class="panel-header-title">
	    			<p class="panel-title tab-header">Shopping List</p>
	    		</div>

	    		<div class="panel-header-rest">
					<!-- text input -->
					<form id="shoplist-form" role="form" action="shoplist.php" name="newitem" method="post">
						<div class="form-group">
							<div id="item_input" class="input-group">
					      		<input autofocus type="text" class="form-control" name="item_name" placeholder="What do we need?">
					      		<span class="input-group-btn">
					        		<button class="btn btn-primary" type="submit" name="submitButton">Add</button>
					      		</span>
					    	</div>
						</div>
					</form>
				</div>
				
			</div>
			<div class="panel-body">
				<!-- item list -->    
				<ol id="shoplistitems">
					<?php 
						foreach ($listItems as $item) 
						{
							$postDate = strtotime($item["post_date"]);
							$solveDate = strtotime($item["solve_date"]);

							// get name of this item's poster and solver
							foreach ($roommates as $roommate) 
							{
								if ($roommate["user_id"] == $item["user_id_poster"])
								{
									$namePoster = 	$roommate["first_name"] . 
													' ' . 
													$roommate["last_name"];
								}

								if ($roommate["user_id"] == $item["user_id_solver"])
								{
									$nameSolver =	$roommate["first_name"] .
													' ' .
													$roommate["last_name"];
								}
							}

							echo(	
									'<li>' .
										'<div class="text_holder">' 	
								);

							// if not solved yet
							if (empty($item["user_id_solver"]))
							{
								echo(
											// hidden value 	
											'<a type="submit" href="#myModal" ' .
												'data-id="' . $item["item_name"] . '" ' . 
									 			'data-value="' . $item["item_id"] . '"'  .
									 			'class="open-modal btn btn-success pull-right checkmark-todo"' . 
									 			'id="solve-button"' .
									 			'data-target="#myModal" >' .
								 				'<span class="glyphicon glyphicon-ok"></span>' .
							 				'</a>'
									);	
							}
							else
							{
								echo 		'<span class="glyphicon glyphicon-ok pull-right checkmark-done"></span>';
							}

							echo(	
											'<p class="lead">' . $item["item_name"] . '</p>' .
											'<em>' .
												'Posted by: ' .
												$namePoster .
												', at ' . 
												date('l F jS, H:i',$postDate)
								);

							// if solved
							if (!empty($item["user_id_solver"]))
							{
								echo( 			
												'<br>' .
												'Bought by: ' .
												$nameSolver . 
												', at ' .
												date('l F jS, H:i', $solveDate)
									);			
							}
							else
							{
								// add white line
								echo 			'<br>&nbsp<br>';
							}
							// placeholder
							echo(			'</em>' .
										'</div>' . 
									'</li>'
								);		
						}
					?>
				</ol>

			</div> <!-- /.panel-body --> 
		</div> <!-- /.panel -->


		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  		<div class="modal-dialog">
		    	<div class="modal-content">
		    		<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title" id="myModalLabel">Add spend</h4>
				    </div>
		      		<div class="modal-body">

		      			<form id="finances-form" role="form" class="form-horizontal" action="finances.php" name="newspend" method="post">
							<fieldset>
								<div class="form-group">
									<label class="col-sm-4 control-label">You bought:</label>
									<div class="col-sm-7">
										<input autofocus type="text" class="form-control" name="spend_name" id="spend_name">
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
									</div>
								</div>

								<input type="hidden" name="from-shoplist" id="from-shoplist" value="" />
				      		
						      	<div class="modal-footer">
						        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						        	<button name="submitButton" type="submit" class="btn btn-primary" id="submit-button">Add spend</button>
						      	</div>
				      		</fieldset>
						</form>
					</div> <!-- close modal-body -->
		    	</div> <!-- close modal-content -->
		  	</div> <!-- close modal-dialog -->
		</div> <!-- close modal -->

	</div> <!-- /.col-md-9 column -->
</div> <!-- /.row-clearfix -->