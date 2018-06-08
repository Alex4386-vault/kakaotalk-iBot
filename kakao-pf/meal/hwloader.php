<?php
    include "../mysql.php";
    $today = date("Y-m-d");
    $toDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($today)) . " +10 day"));
    $mysqli = new mysqli($mysql['address'],$mysql['username'],$mysql['password'],$mysql['dbname']);
    mysqli_set_charset($mysqli, $mysql['charset']);
    if ($mysqli->connect_error) {
      echo "통신 오류가 발생하였습니다. 재시도 하세요.";
    } else {
      $sql = "SELECT * FROM `homework` WHERE `date` BETWEEN '".$today."' AND '".$toDate."' ORDER BY `date`";
      $result = $mysqli->query($sql);
      $output = "";
      echo "SQL구문 : ".$sql."<hr />\n";
      if ($result->num_rows > 0) {
      	 while($row = $result->fetch_assoc())
	 {
	   echo "<h3>".$row['date']."</h3> ".str_replace("\n","<br>",$row['title'])."<hr />";
	   echo "\n";
	 }
      } else {
        echo "통신 오류가 발생했습니다.";
      }
    }


?>