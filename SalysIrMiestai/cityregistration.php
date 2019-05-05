<!DOCTYPE html>
<html>
<head>
  <title> Miestų registracijos forma </title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
</style>
</head>
<body>
<?php
include('dbconnect.php');
$citynameisErr="";
$file2=fopen("countryindex.txt" , "r");
$data2=file("countryindex.txt");
$countryisid2 = implode($data2);
?>
  <br>
  <div align="center">
    <h2>Miesto pridėjimas į duomenų bazę</h2>
    <form action="cityregistration.php" method="post">
      Miesto pavadinimas: <input type="text" name="cityname" placeholder="Įveskite Miesto pavadinimą"  required=""><br> <br>
      <!-- Šalies kodas: <input type="text" name="countrycode" placeholder="Įveskite šalies kodą" ><br><br> -->
      <input type="submit" value="  Registuoti " name ="submit">
      <input type="reset" value= "   Ištrinti  " name="reset">
    </form>
  </div>
  <div align="right">
    <form  action="index.php" method="POST">
      <input type="submit" value="  Gryšti į pagrindinį puslapį  " name="goback">
    </form>
  </div>
</body>
</html>
<?php
$startregister4 = 0;
if (isset($_POST['submit']))
{
  if (empty(trim($_POST["cityname"])))
		{
       echo "<p> Miesto pavadinimas yra privalomas! <p>";
		}
	else
		{
		  $citynameis = $_POST['cityname'];
			if (!preg_match("/^[a-zA-Z ]*$/",$citynameis))
			{
				echo "<p> Neteisingai ivedėte miesto pavadinimą! <p>";
			}
      elseif ( strlen($citynameis) < 2 )
      {
        echo "<p> Neteisingai ivedėte miesto pavadinimą, jis negali buti toks trumpas! <p>";
        $startregister4--;
      }
      elseif ( strlen($citynameis) > 100)
      {
        echo "<p> Neteisingai ivedėte miesto pavadinimą, jis negali buti toks ilgas! <p>";
        $startregister4--;
      }
			else
      {
				$startregister4++;
			}
    }
}
if (isset($_POST['reset']))
{
  $citynameisErr = "";
  $citynameis =  "";
}
if ( isset($_POST['submit']) && $startregister4 == 1)
{
  $startregister4=0;
  $citynameEND = ucfirst(trim($_POST["cityname"]));
  if (!$con)
  {
    die("Connect failed:" . mysqli_connect_error());
  }
  $sql4 = "SELECT * FROM cities WHERE countryID='$countryisid2'  AND city_name='$citynameEND' ";
  if($sameresults4 = mysqli_query($con, $sql4))
  {
      $number_of_same_results4 = mysqli_num_rows($sameresults4);
  }
  else
  {
    $number_of_same_results4 = 0;
  }
  if ( $number_of_same_results4 > 0 )
  {
    echo "<p> Miestas tokiu pavadinimu jau yra duomenų bazėje! <p>";
  }
  else
  {
    $sql4 = "INSERT INTO cities (city_name, countryID) VALUES ('$citynameEND', '$countryisid2')";
    if (mysqli_query($con, $sql4))
    {
      echo "<br> Duomenys buvo sėkmingai įvesti <br>";
    }
    else
    {
        echo "<br> Erroe: " . $sql4 . "<br>" . mysqli_error($con);
    }
  }
}
 ?>
