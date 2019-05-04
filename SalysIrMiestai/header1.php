<!--
paieskos laukas
-->
<?php
include('dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.error {color: #FF0000;}
body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.search input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.search button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.search button:hover {
  background: #0b7dda;
}

form.search::after {
  content: "";
  clear: both;
  display: table;
}
</style>
</head>
<body>
<form class="search" action="searchcountry.php" method="POST" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Paieška.." name="searchtxt">
  <button type="submit" name="searchbut"><i class="fa fa-search"></i></button>
</form>
</body>
</html>
