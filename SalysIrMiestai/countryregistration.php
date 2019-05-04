<!DOCTYPE html>
<html>
<head>
  <title> Šalių registracijos forma </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style>
</head>
<body>
<?php
include('dbconnect.php');

 $countynameisErr=$countrycodeisErr="";
?>

  <br>
  <div align="center">
    <h2>Šalies pridėjimas į duomenų bazę</h2>
    <form action="countryregistration.php" method="post">
      Šalies pavadinimas: <input type="text" name="countryname" placeholder="Įveskite šalies pavadinimą"  required=""><br> <br>
      Šalies kodas: <input type="text" name="countrycode" placeholder="Įveskite šalies kodą" required=""><br><br>
      <input type="submit" value="  Registuoti " name ="submit">
      <input type="reset" value= "   Ištrinti  " name="reset">
    </form>
  </div>
  <div align="right">
    <form action="index.php" method="post">
      <input type="submit" value="  Gryšti į pagrindinį puslapį  " name="goback2">
    </form>
  </div>
</body>
</html>

<?php
$startregister = 0;
if (isset($_POST['submit']))
{
  if (empty($_POST["countryname"]))
		{
       echo "Šalies pavadinimas yra privalomas! ";
		}
	else
		{
		  $countynameis = $_POST['countryname'];
			if (!preg_match("/^[a-zA-Z ]*$/",$countynameis))
			{
				echo "Neteisingai ivedėte šalies pavadinimą! ";
			}
			else
      {
				$startregister++;
			}
    }
    if (empty($_POST["countrycode"]))
  		{
         echo "Šalies kodas yra privalomas!";
  		}
    else
    	{
        $countrycodeis = $_POST['countrycode'];
    		if (!preg_match("/^[a-zA-Z ]*$/",$countrycodeis))
    		{
    			echo "Neteisingai ivedėte šalies koda!";
    		}
    		else
        {
    			$startregister++;
    		}
      }
}
if (isset($_POST['reset']))
{
  $countynameisErr = $countrycodeisErr = "";
  $countynameis = $countrycodeis = "";
}
if ( isset($_POST['submit']) && $startregister == 2)
{
  $startregister=0;
  $countynameEND = ucfirst(trim($_POST["countryname"]));
  $countrycodeEND = ucfirst(strtoupper(trim($_POST["countrycode"])));
  if (!$con)
  {
    die("Connect failed:" . mysqli_connect_error());
  }
  $sql = "INSERT INTO apps_countries (country_name,  country_code) VALUES ('$countynameEND', '$countrycodeEND')";
  if (mysqli_query($con, $sql))
  {
    echo "<br> Duomenys buvo sėkmingai įvesti <br>";
  }
  else {
    include('dbcreating.php'); // nezinau ar gerai
    if(mysqli_query($conect2, $sql))
    {
      echo "<br> Duomenys buvo sėkmingai įvesti <br>";
    }
    else
    {
      echo "<br> Erroe: " . $sql . "<br>" . mysqli_error($conect2);
    }
  }
  mysqli_close($con);
}
 ?>
