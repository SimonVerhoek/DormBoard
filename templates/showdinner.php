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
					<?php printUpcomingDays(6) ?>
				</tr>
			</thead>
			<tbody id="dinner-table-body">
				<?php printDinnerSchedule() ?>
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
									<label class="btn btn-custom-dinner dinner-button" id="button-cook">
										<input type="radio" class="dinner-radio-button" name="what" value="1">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/cook3.png">
									</label>
									<label class="btn btn-custom-dinner dinner-button" id="button-join">
										<input type="radio" class="dinner-radio-button" name="what" value="2">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/join3.png">
									</label>
									<label class="btn btn-custom-dinner dinner-button" id="button-notjoin">
										<input type="radio" class="dinner-radio-button" name="what" value="3">
										<img class='dinner-modal-icon' src="<?= WEBSITEROOT ?>/img/notjoin.png">
									</label>
								</div> <!-- ./ .dinner-buttons -->

							</div> <!-- ./ form-group -->
						</div> <!-- ./ column -->

						<div class="col-xs-3" id="dinner-button-label-column">
							<div class="row-fluid dinner-button-label" id="label-cook">
								<p>Cook</p>
							</div>
							<div class="row-fluid dinner-button-label" id="label-join">
								<p>Join dinner</p>
							</div>
							<div class="row-fluid dinner-button-label" id="label-notjoin">
								<p>NOT join dinner</p>
							</div>
						</div> <!-- ./ #dinner-button-label-column -->

						<div class="col-xs-6 dinner-modal-column">
							<div class="form-group">

								<div class="btn-group dinner-buttons" data-toggle="buttons">
								<?php printDinnerOptions(6) ?>
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


