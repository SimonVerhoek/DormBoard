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
					<tbody id="spendstable-body">
						<?php printSpends() ?>
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
			<?php printCashBalances() ?>
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
								<?php printRoommatesChecklist() ?>
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