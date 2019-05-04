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
  if (empty(trim($_POST["countryname"])))
		{
       echo "<p> Šalies pavadinimas yra privalomas! <p>";
		}
	else
		{
		  $countynameis = $_POST['countryname'];
			if (!preg_match("/^[a-z A-Z]*$/",$countynameis))
			{
				echo "<p> Neteisingai ivedėte šalies pavadinimą, ją gali sudaryti tik raidės ir tarpai! <p>";
			}
      elseif ( strlen($countynameis) < 2 )
      {
        echo "<p> Neteisingai ivedėte šalies pavadinimą, jis negali buti toks trumpas! <p>";
        $startregister--;
      }
      elseif ( strlen($countynameis) > 100)
      {
        echo "<p> Neteisingai ivedėte šalies pavadinimą, jis negali buti toks ilgas! <p>";
        $startregister--;
      }
			else
      {
				$startregister++;
			}
    }
    if (empty($_POST["countrycode"]))
  		{
         echo "<p> Šalies kodas yra privalomas! <p>";
  		}
    else
    	{
        $countrycodeis = $_POST['countrycode'];
    		if (!preg_match("/^[a-zA-Z]*$/",$countrycodeis))
    		{
    			echo "<p> Neteisingai ivedėte šalies koda! <p>";
    		}
        elseif ( strlen($countrycodeis) > 3 || strlen($countrycodeis) < 2 )
        {
          echo "<p> Neteisingai ivedėte šalies koda, jį gali sudaryti nuo dviejų iki trijų raidžių! <p> ";
          $startregister--;
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
  $sql5 = "SELECT * FROM apps_countries WHERE country_name='$countynameEND' OR country_code='$countrycodeEND'";
  if($sameresults = mysqli_query($con, $sql5))
  {
      $number_of_same_results = mysqli_num_rows($sameresults);
  }
  else
  {
    $number_of_same_results = 0;
  }
  if ( $number_of_same_results > 0 )
  {
    echo "<p> Šalis tokiu pavadinimu ar kodu jau yra duomenų bazėje! <p>";
  }
  else
  {
    $sql6 = "INSERT INTO apps_countries (country_name,  country_code) VALUES ('$countynameEND', '$countrycodeEND')";
    if (mysqli_query($con, $sql6))
    {
      echo "<br> Duomenys buvo sėkmingai įvesti <br>";
    }
    else
    {
      include('dbcreating.php'); // nezinau ar gerai
      if(mysqli_query($conect2, $sql6))
      {
        echo "<br> Duomenys buvo sėkmingai įvesti <br>";
      }
      else
      {
        echo "<br> Erroe: " . $sql6 . "<br>" . mysqli_error($conect2);
      }
    }
  }
  mysqli_close($con);
}
 ?>
