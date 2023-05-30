<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
<?php 
		session_start();
		session_destroy();
		echo "<script>window.location.href='../index1.php'</script>";
		
?>
</body>
</html>