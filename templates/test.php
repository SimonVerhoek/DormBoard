<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  		<div class="modal-dialog">
			    	<div class="modal-content">
			    		<div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        <h4 class="modal-title" id="myModalLabel">Add spend for: <?= $itemID ?> </h4>
					    </div>
			      		<div class="modal-body">

			      			<form id="finances-form" role="form" class="form-horizontal" action="finances.php" name="newspend" method="post">
								<fieldset>
									<div class="form-group">
										<label class="col-sm-5 control-label">You bought:</label>
										<div class="col-sm-6">
											<input autofocus type="text" class="form-control" name="spend_name" placeholder="e.g. butter, bread and toilet paper">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-5 control-label">What did you spend?</label>
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
					      		
							      	<div class="modal-footer">
							        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        	<button name="submitButton" type="submit" class="btn btn-primary">Add as spend</button>
							      	</div>
					      		</fieldset>
							</form>
						</div> <!-- close modal-body -->
			    	</div> <!-- close modal-content -->
			  	</div> <!-- close modal-dialog -->
			</div> <!-- close modal -->






	<?php
			/*
			// create modals
			foreach ($listItems as $item) 
			{
				echo( 	'<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' .
							'<div class="modal-dialog">' .
								'<div class="modal-content">' .
									'<div class="modal-header">' .
										'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' .
										'<h4 class="modal-title" id="myModalLabel">Add spend for: ' . $item["item_name"] . ' </h4>' .
									'</div>' .
									'<div class="modal-body">' .
										'<form id="finances-form" role="form" class="form-horizontal" action="finances.php" name="newspend" method="post">' .
											'<fieldset>' .
												'<div class="form-group">' .
													'<label class="col-sm-5 control-label">You bought:</label>' .
													'<div class="col-sm-6">' .
														'<input autofocus type="text" class="form-control" name="spend_name" placeholder="e.g. butter, bread and toilet paper">' .
													'</div>' .
												'</div>' .
												'<div class="form-group">' .
													'<label class="col-sm-5 control-label">What did you spend?</label>' .
													'<div class="col-sm-2">' .
														'<div class="input-group">' .
															'<span class="input-group-addon">$</span>' .
															'<input type="text" class="form-control text-right" name="spend_cost_whole" placeholder="0">' .
														'</div>' .
													'</div>' .
													'<div class="col-sm-2">' .
														'<input type="text" class="form-control" name="spend_cost_cents" placeholder="00">' .
													'</div>' .
												'</div>' .
												'<div class="form-group">' .
													'<label class="col-sm-3 control-label">Who is it for?</label>' .
													'<div class="col-sm-6">'
					);
				
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

			echo(									// close col
													'</div>' .
												// close form-group
												'</div>' .
												'<div class="modal-footer">' .
													'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' .
													'<button name="submitButton" type="submit" value="' . $item["item_id"] . '" class="btn btn-primary">Add as spend</button>' .
												'</div>' .
											'</fieldset>' .
										'</form>' .
									// close modal-body 
									'</div>' .
								// close modal-content
								'</div>' .
							// close modal-dialog
							'</div>' .
						// close modal
						'</div>'
					);
			}
			*/
		?>