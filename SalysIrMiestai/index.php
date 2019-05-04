<?php
include('dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
<title> Šalys ir Miestai </title>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="30">
<style>
.error {color: #FF0000;}
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: LightGoldenRodYellow;
   color: black;
   text-align: center;
}
</style>
</head>
<body bgcolor="#FFF5EE">
<?php
include('header1.php');
//paping
$results_per_page = 5;
$sql = "SELECT * FROM apps_countries";
if($result = mysqli_query($con,$sql))
{
    $number_of_results = mysqli_num_rows($result);
    $number_of_pages = ceil($number_of_results/$results_per_page);
}
else
{
    $number_of_results =0;
    $number_of_pages =0;
}
//echo "$number_of_results<br>";
//echo "$number_of_pages<br>";
if(!isset($_GET['page']))
{
  $page = 1;
}
else
{
  $page = $_GET['page'];
}
$this_page_first_result = ($page-1)*$results_per_page;
//echo "$this_page_first_result<br>";
$sql = "SELECT * FROM apps_countries LIMIT " . $this_page_first_result . ',' . $results_per_page;
$result = mysqli_query($con, $sql);
?>
<!--countries list -->
<div align="center">
  <?php
  //delete button
    if(isset($_POST['deletebtn']))
    {
      if(isset($_POST['checkbox']))
      {
        $key = $_POST['checkbox'];
        foreach ($key as $id)
        {
          mysqli_query($con, "DELETE FROM apps_countries WHERE id=" .$id);         // istrinu saliu lenteleji sali
          mysqli_query($con, "DELETE FROM cities WHERE countryID=" .$id);          // istrinu mistu lenteleje miesta
        }
      }
        else
        {
            ?><span class="error"> <?php echo "<br> Jeigu norite ištrinti turite pažymėti <br>";?></span><?php
        }
    }
if( $number_of_results > 0)
{
  ?>
  <table>
    <tr>
       <th align="right" width=\"100%\">  Šalies pavadinimas &emsp;</th>
  	   <th width=\"100%\">  Šalies trumpinys &emsp;</th>
       <th width=\"100%\">  Pažymėti  </th>
    </tr>
    <form action="" method="post" role="form">
<?php
while ($row = mysqli_fetch_array($result))
  {
    $countryidis = $row['id'];
    ?>
    <tr>
        <td align="center"> <a href='countrytocity.php?countryidisthisome=<?php echo $countryidis; ?>' target="_blank"> <?php echo $row['country_name']; ?> </a> </td>       <!-- pakeiciau is miestai.php i countrytocity.php  ,pridedu linka i miestus naujame puslapije kartu issaugau salies id url -->
        <td align="center"><?php echo $row['country_code']; ?></td>
        <td align="center">
          <input type="checkbox" name="checkbox[]" value="<?php echo $countryidis;?>" >
        </td>
    </tr>
    <br>
<?php }
}
else
{
  ?>
  <div align="center">
      <span class="error"> <?php echo "<br>Duomenų bazėje nėra duomenų!<br>";?></span>
  </div>
  <?php
}
?>
  </table>
  <br>
  <input type="submit" name="deletebtn" value=" IŠTRINTI "> <!-- naujai prirasiau -->
</form>
</div>
<!--Register form-->
<div  align="center">
  <br>
  <form  action="countryregistration.php" method="post">
    <input type="submit" value=" Registracijos forma " name="registerform">
  </form>
</div>
<?php
//include('register1.php');
?>
<!--footer-->
 <div class="footer">
  <p>
      <?php
        for($page=1; $page<=$number_of_pages; $page++)
        {
          echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';
        }
        echo "<br> Page auto refresh every 30 seconds. <br>"
      ?>
  </p>
</div>
</body>
</html>
