<!DOCTYPE html>
<html>
<head>
	<title>AJAX Table Generator</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="script.js"></script>
</head>
<body>
	<h1>AJAX Table Generator</h1>
	<label for="num">Enter a number:</label>
	<input type="text" id="num">
	<button id="generate-btn">Generate Table</button>
	<div id="table-container"></div>
</body>
</html>
$(document).ready(function() {
	$('#generate-btn').click(function() {
		var num = $('#num').val();
		$.ajax({
			url: 'table.php',
			method: 'POST',
			data: {num: num},
			success: function(response) {
				$('#table-container').html(response);
			}
		});
	});
});
<?php

if(isset($_POST['num'])) {
	$num = $_POST['num'];
	$table = '<table>';
	for($i = 1; $i <= $num; $i++) {
		$table .= '<tr><td>' . $i . '</td></tr>';
	}
	$table .= '</table>';
	echo $table;
}

?>