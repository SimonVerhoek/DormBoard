		            	<!-- if logged in, closes tab div -->
						<?php 
							if (!preg_match("{(?:login|register)\.php$}", $_SERVER["PHP_SELF"]))
							{
								echo "</div>";
							}
						?> 
	            	
	            </div> <!-- closes middle -->
	        </div> 
	        <div class="push"></div>
	    </div> <!-- closes container -->

        <div id="footer">
            <div id="row-footer" class="row clearfix text-center">
		        <h1>Made by Simon Verhoek</h1>
		        <h3>Minor Programmeren - Programmeren 2</h3>
		    </div>
        </div> <!-- closes bottom -->

    </body>
</html>
