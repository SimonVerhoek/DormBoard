<!--
 |
 |  Shows the navigation bar.
 |
 -->

<div class="row clearfix">
	<div class="col-md-2 column">

		<!-- navigation -->
		<div class="nav nav-pills nav-stacked" role="navigation">
		    <li id="navdinner">   <a href="dinner.php">	  dinner		</a></li>
		    <li id="navshoplist"> <a href="shoplist.php"> Shopping List </a></li>
		    <li id="navfinances"> <a href="finances.php"> finances		</a></li>
		</div>

		<div class="panel" id="roommates-panel">
			<div class="panel-heading">

				<?= $dorm[0]["dorm_name"] ?>
				
			</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					<?php
						foreach ($roomMates as $roommate) 
						{
							echo(	'<li>' .
									$roommate["first_name"] .
									'</li>'
								);
						}
					?>
				</ul>
			</div>
		</div>

	</div> <!-- close navbar column -->