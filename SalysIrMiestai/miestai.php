<?php                              // prisijungimas prie duomenu bazes per headerio faila kur yra ir paieskos mygtukas ir pasiemimas salies id is tekstinio failo
include ('header2.php');
$file4=fopen("countryindex.txt" , "r");
$data4=file("countryindex.txt");
$countryisid4 = implode($data4);
?>
<!DOCTYPE html>
<html>
<head>
<title> Miestai </title>
<meta charset="UTF-8">
<meta name="author" content="Lukas Štreimikis">
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
 $results_per_page4 = 5;
 $sql4 = ("SELECT * FROM cities WHERE countryID=" .$countryisid4);
 $result4 = mysqli_query($con,$sql4);
 $number_of_results4 = mysqli_num_rows($result4);                                //echo "rezultatu skaicius: $number_of_results4<br>";
 $number_of_pages4 = ceil($number_of_results4/$results_per_page4);               //echo "puslapiu skaicius: $number_of_pages4<br>";
 if(!isset($_GET['page4']))
 {
   $page4 = 1;
 }
 else
 {
   $page4 = $_GET['page4'];
 }
 $this_page_first_result4 = ($page4-1)*$results_per_page4;                       //echo "pirmo rezultato indeksas siame puslapije: $this_page_first_result4<br>";
 $sql4 = "SELECT * FROM cities WHERE countryID='$countryisid4' LIMIT " . $this_page_first_result4 . ',' . $results_per_page4;       //  imta tik tos salies miestus
 $result4 = mysqli_query($con, $sql4);
 ?>
 <!--countries list -->
 <div align="center">
   <?php
   //delete button
     if(isset($_POST['deletebtn4']))
     {
       if(isset($_POST['checkbox']))
       {
         $key4 = $_POST['checkbox'];
         foreach ($key4 as $id4)
         {
           mysqli_query($con, "DELETE FROM cities WHERE id=" .$id4);
         }
       }
         else
         {
             ?><span class="error"> <?php echo "<br> If you want to delete, you must check the Pažymėti <br>";;?></span><?php
         }
     }
  if ($number_of_results4==0)      // tikrinu ar duomenu bazeje yra miestu priklausanciu saliai jeigu ne isvedu kad nera
  {
       echo "<br> Miestų duomenų bazėje nėra! <br>";
  }
  else                             // veikia kai duomenu bazeje yra miestu su pasirinktos salies id
    {
      ?>
        <table>
          <tr>
             <th>  Miesto pavadinimas &emsp; </th>
             <th>  Pažymėti  </th>
          </tr>
          <form action="" method="post" role="form">
      <?php while ($row = mysqli_fetch_array($result4))
        {
          $cityidis = $row['id'];
          ?>
          <tr>
              <td align="center">  <?php echo $row['city_name']; ?> </a> </td>
              <td align="center">
                <input type="checkbox" name="checkbox[]" value="<?php echo $cityidis;?>" >
              </td>
          </tr>
          <br>
      <?php } ?>
   </table>
   <br>
   <input type="submit" name="deletebtn4" value=" IŠTRINTI ">
 <?php }                                                          // baigiasi else
 ?>
 </form>
 </div>
 <!--Register form-->
 <div  align="center">
   <br>
   <form  action="cityregistration.php" method="get">
     <button type="submit" value="<?php $countryisid4 ?>" name="registerform"> Registracijos forma </button>
   </form>
 </div>
 <!--footer-->
  <div class="footer">
   <p>
       <?php
         for($page4=1; $page4<=$number_of_pages4; $page4++)
         {
           echo '<a href="miestai.php?page4=' . $page4 . '">' . $page4 . '</a> ';
        } ?>
   </p>
 </div>
 </body>
 </html>
