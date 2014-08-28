<ul class="nav navbar-nav navbar-right" id="session-dropdown">
	<li class="dropdown">
		<a href="#" data-toggle="dropdown" class="dropdown-toggle">
			<?= $user[0]["first_name"] . " " . $user[0]["last_name"] ?>	
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li><a href="account.php">Your account</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</li>
</ul>