<!--
 |
 |  Shows the navigation bar.
 |
 -->

<div class="col-xs-2 column" id="nav-column">

	<div id="nav-and-dorm">

		<h2 id="dorm-name" align="center"><?= $dorm[0]["dorm_name"] ?></h2>

		<!-- navigation -->
		<div class="nav nav-pills nav-stacked" id="nav-tab-buttons" role="navigation">
		    <li id="navdinner">   <a href="dinner.php">	  dinner		</a></li>
		    <li id="navshoplist"> <a href="shoplist.php"> Shopping List </a></li>
		    <li id="navfinances"> <a href="finances.php"> finances		</a></li>
		</div>

	</div>

	<div id="roommates-list">
		<legend align="center">Roommates</legend>
		<ul class="list-unstyled">
			<?php
				foreach ($roomMates as $roommate) 
				{
					echo(	'<li>' .
								$roommate["first_name"] .
								' ' .
								$roommate["last_name"] .
							'</li>'
						);
				}
			?>
		</ul>

	</div>

</div> <!-- close navbar column -->