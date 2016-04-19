<!DOCTYPE html>
<html>
<head>
	<title>My Webpage</title>
</head>
<body>
		<h1>Customers</h1>
		<pre>
		
		{{ "hello" }}

		<?php
			//print_r($customers);
			foreach($customers as $customer) {
				echo $customer->name;
				echo "<pre>";
			}
		 ?>
</body>
</html>