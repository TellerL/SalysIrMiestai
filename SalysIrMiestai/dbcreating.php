<?php                                                         // reikia kai nera duomenu bazes, tuomet ja sukuria sitas failas
$conect = mysqli_connect("localhost","root","");
$query = "CREATE DATABASE database_123456789";
$query1 = "CREATE TABLE apps_countries (
  id int(11) NOT NULL AUTO_INCREMENT,
  country_code varchar(2) NOT NULL DEFAULT '',
  country_name varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$query2 = "CREATE TABLE cities (
  id int(11) NOT NULL AUTO_INCREMENT,
  city_name varchar(100) NOT NULL,
  countryID int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";
$returnResult = $conect->query($query);
$conect2 = mysqli_connect("localhost","root","","database_123456789");
$returnResult1 = $conect2->query($query1);
$returnResult2 = $conect2->query($query2);
//                                                             testavimui reikalingi
// if($returnResult)
// 	{
// 		echo "<p>Database created successfully .</p>";
// 	}
// else
// 	{
// 		echo "<p>Error occurred while creating the database. </p>";
// 		echo "<p>Exiting...</p>";
// 		exit();
// 	}
// if($returnResult1)
// 	{
// 		echo "<p>Table created successfully 1.</p>";
// 	}
// else
// 	{
// 		echo "<p>Error occurred while creating the table. 1</p>";
// 		echo "<p>Exiting...</p>";
// 		exit();
// 	}
// if($returnResult2)
//   {
//   	echo "<p>Table created successfully. 2</p>";
//   }
// else
// 	{
// 		echo "<p>Error occurred while creating the table. 2</p>";
// 		echo "<p>Exiting...</p>";
// 		exit();
// 	}
?>

<?php
//
// $conect = mysqli_connect("localhost","root","");
//
// $query = "CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
// USE `database`;
// CREATE TABLE IF NOT EXISTS `apps_countries` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `country_code` varchar(2) NOT NULL DEFAULT '',
//   `country_name` varchar(100) NOT NULL DEFAULT '',
//   PRIMARY KEY (`id`)
// ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;
// INSERT INTO `apps_countries` (`id`, `country_code`, `country_name`) VALUES
// (1, 'AF', 'Afghanistan');
// CREATE TABLE IF NOT EXISTS `cities` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `city_name` varchar(100) NOT NULL,
//   `countryID` int(11) NOT NULL,
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;
// INSERT INTO `cities` (`id`, `city_name`, `countryID`) VALUES
// (1, 'Palanga', 127);
// ";
//
// $results = mysqli_query($conect, $query);
?>
