<?php
$host = "localhost";
$dbname ="onthefly";
$username ="root";
$password = "";

$con = new PDO ( "mysql:host=$host;dbname=$dbname", $username, $password);

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        ul {
            list-style-type: none;
            margin: 10;
            padding: 10;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 15px 17px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }
    </style>
</head>
<body>

<ul>
    <li><a class="active" href="OnTheFly.php">Home</a></li>
    <li><a href="vliegtuigen.php">Vliegtuigen</a></li>
    <li><a href=".php"></a></li>
    <li><a href=".php"></a></li>
    <li><a href=".php"></a></li>
</ul>

<body bgcolor = lime>




	<form method=post>

Vliegtuignummer:<input type="text" name="txtVliegtuignummer"/><br/>
Type:<input type="text" name="txtType"/><br/>
Vliegmaatschapij:<input type="text" name="txtVliegmaatschapij"/><br/>
Status:<input type="text" name="txtStatus"/><br/>


<input type="submit" name="btnVerstuur" value="verstuur"/></br>	
</form>
<?php
if(isset($_POST['btnVerstuur']))
{
	$Vliegtuignummer = $_POST['txtVliegtuignummer'];
	$Type = $_POST['txtType'];
	$Vliegmaatschapij = $_POST['txtVliegmaatschapij'];
	$Status = $_POST['txtStatus'];
	
	//Opbouwen qeury
	$query = "INSERT INTO vliegtuig (Vliegtuignummer, Type, Vliegmaatschapij, Status) VALUES".
			"('$Vliegtuignummer','$Type','$Vliegmaatschapij','$Status')";
	
	var_dump($query);
	
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		echo "Statement correct uitgevoerd!";
		
	}else echo "Query mislukt!";	

	
	
	
	
	$lijst = array();
	array_push ($lijst,$Vliegtuignummer);
	array_push ($lijst,$Type);
	array_push ($lijst,$Vliegmaatschapij);
	array_push ($lijst,$Status);
	
	
	
	

	foreach($lijst as $key => $value)
	{
		echo $key . ":". $value . "<br/>";
	}
}

$query = "Select * FROM vliegtuig";
// inlezen query

$stm = $con->prepare($query);
//statement uitvoeren
if($stm->execute())
{
	echo "Query gelukt!"."<br/>";
	
}else echo "Qeury mislukt!";	
	// ophalen resultaten
	
	$result = $stm->fetchAll(PDO::FETCH_OBJ);
	
	foreach($result as $pers)
	{
		echo $pers->Vliegtuignummer ." ";
		echo $pers->Type ." ";
		echo $pers->Vliegmaatschapij ." ";
		echo $pers->Status ."<br/>";
	}
	
?>
    </body>
</html>	