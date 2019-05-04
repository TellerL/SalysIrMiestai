<!--  paieskos puslapis  -->
<!DOCTYPE html>
<html>
<head>
  <title> Miestų paieška </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
</style>
</head>
<body>
<h1>Miestų paieškos puslapis</h1>
<form  action="index.php" method="POST">
  <input type="submit" value="  Gryšti į pagrindinį puslapį  " name="goback">
</form>
<br>
<?php
$file5=fopen("countryindex.txt" , "r");
$data5=file("countryindex.txt");
$countryisid5 = implode($data5);

include('header2.php');
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
    $sql2 = "SELECT * FROM cities WHERE city_name LIKE '%$searchtext%' AND countryID='$countryisid5' ";
    $result2 = mysqli_query($con, $sql2);
    $queryresult2 = mysqli_num_rows($result2);
    if ($queryresult2 > 0)
    {
        ?>
        <!--countries list -->
        <div align="center">

          <table>
            <tr>
               <th width=\"40%\">  Miesto pavadinimas  </th>
            </tr>
        <?php while ($row = mysqli_fetch_array($result2))
          {?>
            <tr>
                <td align="center"><?php echo $row['city_name'] ?></td>
            </tr>
            <br>
        <?php } ?>
          </table>
          <br>
        </div>
        <?php
    }
    else
    {
      ?>
      <div align="center">
          <span class="error"> <?php echo "<br>Duomenų bazėje nėra miesto su tokiu pavadinimu!<br>";?></span>
      </div>
      <?php
    }
  }
}?>
</body>
</html>
