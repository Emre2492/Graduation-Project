<?php
if(isset($_POST['submit'])){
    echo "{$_POST['polltitle']} <br>";
	foreach ($_POST["mytext"] as $key) {
		echo "{$key} : <br>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add poll</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type='text/javascript'>
		$(document).ready(function() {
    		var max_fields      = 10;
    		var wrapper         = $(".container1");
    		var add_button      = $(".add_form_field");

    		var x = 1;
    		$(add_button).click(function(e){
        		e.preventDefault();
        		if(x < max_fields){
            		x++;
            		$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="delete">Delete</a></div>'); //add input box
        		}
  				else
  				{
  					alert('You Reached the limits')
  				}
    		});

    		$(wrapper).on("click",".delete", function(e){
        		e.preventDefault(); $(this).parent('div').remove(); x--;
    		})
		});
	</script>
</head>
<body>
	<form method="POST" action="addpoll.php">
		<label>Poll title:</label>
		<input type="text" name="polltitle" />
		<div class="container1">
			<button class="add_form_field">Add New Field &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button>
			<div><input type="text" name="mytext[]"></div>
		</div>
		<input type="submit" name="submit">
	</form>
</body>
</html>
