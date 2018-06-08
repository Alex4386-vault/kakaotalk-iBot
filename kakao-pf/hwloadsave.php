<?php
  function loadhwlist()
  {
    $array = unserialize(file_get_contents('hwlist.bin'));
    return $array;
  }

  function writehwlist($list)
  {
    $success = file_put_contents('hwlist.bin', serialize($array));
    return $success;
  }

  function gethomework($today, $todate)
  {
    include "mysql.php";
    $get['_mysql'] = new mysqli($mysql['address'],$mysql['username'],$mysql['password'],$mysql['dbname']);
    mysqli_set_charset($get['_mysql'], $mysql['charset']);
    if ($get['_mysql']->connect_error) {
      respond("통신 오류가 발생하였습니다. 재시도 하세요.");
    } else {
      $get['sql'] = "SELECT * FROM `homework` WHERE `date` BETWEEN '".$today."' AND '".$todate."' ORDER BY `date`";
      $result = $get['_mysql']->query($get['sql']);
      $output = "";
        if ($result->num_rows > 0) {
            // output data of each row
            $output = date("오늘은 Y년m월d일 입니다.")."\n오늘부터 7일간 있는 숙제를 표시합니다.\n================\n";
            while($row = $result->fetch_assoc()) {
                $output = $output."제출 기한:" . $row["date"]. "\n숙제 이름:" . $row["title"]."\n=================\n";
            }
            $output = $output."숙제리스트의 끝입니다.";
        } else {
            $output = "7일 내에 숙제가 없거나, 업데이트 되지 않았습니다.".$get['sql'];
        }
        respond($output);
    }
  }
?>
