<?php
require_once 'config/config.php';

if(isset($_POST['submit'])){
	$conn = Database::getInstance();

	$pollTitle = $_POST['pollTitle'];

	$conn->query("insert into polls set title='{$pollTitle}', course=1");
	$lastInserted = $conn->lastInsertId();

	foreach ($_POST['questions'] as $qTitle) {
		$conn->query("insert into poll_questions('title', 'pollid'), value ('{$qTitle}', {$lastInserted}");
	}
}
?>

<html>
<head>
    <title>Add pool</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type='text/javascript'>
		$(document).ready(function() {
    		var max_fields      = 20;
    		var wrapper         = $(".qTitles");
    		var add_button      = $(".addQTittle");

    		var x = 1;
    		$(add_button).click(function(e){
        		e.preventDefault();
        		if(x < max_fields){
            		x++;
            		$(wrapper).append('<div><input type="text" name="questions[]"/><a href="#" class="delete">Delete</a></div>'); //add input box
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
<h1>Add pool</h1>
<form action="addpoll.php" method="post">
	<label>Poll title</label>
	<input type="text" name="pollTitle" /><br>
	<label>Poll questions:</label>
	<div class="qTitles">
		<button class="addQTittle">Add new question</button>
		<div><input type="text" name="questions[]"></div>
	</div>
	<input type="submit" name="submit">
</form>
</body>
</html>