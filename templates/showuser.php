<ul class="nav navbar-nav navbar-right" id="session-dropdown" role="navigation">
	<li class="dropdown">
		<a href="#" data-toggle="dropdown" class="dropdown-toggle" role="button">
			<?= $user[0]["first_name"] . " " . $user[0]["last_name"] ?>	
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu" id="session-dropdown-box">
			<li><a href="account.php">Your account</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</li>
</ul>