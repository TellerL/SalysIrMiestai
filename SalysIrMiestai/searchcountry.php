<!--  paieskos puslapis   -->
<!DOCTYPE html>
<html>
<head>
  <title> Šalių paieška </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
</style>
</head>
<body>
<h1>Šalių paieškos puslapis</h1>
<form  action="index.php" method="POST">
  <input type="submit" value="  Gryšti į pagrindinį puslapį  " name="goback">
</form>
<br>
<?php
include('header1.php');
$corecktseartch=0;
if(isset($_POST['searchbut']))
{
  if(empty($_POST["searchtxt"]))
  {
    ?>
    <div align="center">
        <span class="error"> <?php echo "<br>Norėdami atlikti paieška turite ivesti tekstą";?></span>
    </div>
    <?php
  }
  else
  {
    $searchtext = mysqli_real_escape_string($con, $_POST['searchtxt']);
    $sql2 = "SELECT * FROM apps_countries WHERE country_name LIKE '%$searchtext%' OR country_code LIKE '%$searchtext%'";
    //$result2 = mysqli_query($con, $sql2);
    if($result2 = mysqli_query($con,$sql2))
    {
        $queryresult2 = mysqli_num_rows($result2);
    }
    else
    {
        $queryresult2 =0;
    }
    // $queryresult2 = mysqli_num_rows($result2);
    if ($queryresult2 > 0)
    {
        ?>
        <!--countries list -->
        <div align="center">
          <table>
            <tr>
               <th width=\"40%\">  Šalies pavadinimas  </th>
               <th width=\"30%\">  Šalies trumpinys  </th>
            </tr>
          <form action="" method="post" role="form">
        <?php while ($row = mysqli_fetch_array($result2))
          {
            $countryidis = $row['id'];
            ?>
            <tr>
                <td align="center"> <a href='countrytocity.php?countryidisthisome=<?php echo $countryidis; ?>' target="_blank"> <?php echo $row['country_name']; ?> </a> </td>
                <!-- <td align="center"><?php// echo $row['country_name'] ?></td> -->
                <td align="center"><?php echo $row['country_code'] ?></td>
            </tr>
            <br>
        <?php } ?>
          </table>
          </form>
          <br>
        </div>
        <?php
    }
    else
    {
      ?>
      <div align="center">
          <span class="error"> <?php echo "<br>Duomenų bazėje nėra šalies su tokiu pavadinimu ar kodu!<br>";?></span>
      </div>
      <?php
    }
  }
}
 ?>
</body>
</html>
