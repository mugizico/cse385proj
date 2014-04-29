<script type="text/javascript">
	function promote(instName){
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("POST", "promote.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("name=" + instName);

		var check = document.getElementById(instName);
		check.style.display="none"; 
		//return false;
	}	
</script>

<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);

	$db = new SQLite3('finProject.db');
	if($_SERVER['REQUEST_METHOD'] === 'GET'){

	}
    	else if($_POST['courseCode'] != ""){
	$result = $db->query("SELECT Code, AVG(AvgGpa) AS AvgGrade, InstName, Rating FROM Class, Instructor WHERE Code = '".$_POST['courseCode']."' AND Name = InstName GROUP BY InstName ORDER BY AvgGrade DESC");
	while($row = $result->fetchArray()){
		//var_dump($row);
		$instName = $row['InstName'];
		echo ($instName . "<br>");
		$avgGrade = $row['AvgGrade'];
		echo($row['InstName'] . "--" . $row['Rating'] . "<label id = '$instName'><input type = 'checkbox' onClick='promote(\"$instName\")'>Promote</label><br>");
	}
	//echo(var_dump($result->fetchArray()));
	//if(sqlite_num_rows($result) == 0){
	//echo('<h2> No class found with code ' . $_POST['courseCode'] . '</h2>');

	//}
    }

    else{ ?>
    <h2>Please enter a courseCode!</h2>
	<?php } ?>

	<form name="sendData" action="index.php" method="POST">
		Enter a course code (Ex. CSE101): <input type="text" name="courseCode">
		<input type="submit" value="Submit">	
	</form>

<?php
?>

