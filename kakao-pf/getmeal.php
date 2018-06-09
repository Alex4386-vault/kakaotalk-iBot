<?php
  //급식 정보 불러오기 및 급식 정보 저장
  function getmeal($type)
  {
    include "mysql.php";
    //respond("NEIS 데이터 처리방식 변경으로, \n지원이 일시적으로 중지되었습니다.\n이점 양해 부탁드립니다.");
    switch($type)
    {
      case 'lunch':
      case '점심':
      case '중식':
        $meal_type = "중식";
        $type = 'lunch';
        break;
      case 'dinner':
      case '저녁':
      case '석식':
        $meal_type = "석식";
        $type = 'dinner';
        break;
      default:
        $meal_type = "에러";
        $type = "error";
        break;
    }
    $today = date("Y-m-d");
    $get['_mysql'] = new mysqli($mysql['address'],$mysql['username'],$mysql['password'],$mysql['dbname']);
    mysqli_set_charset($get['_mysql'], $mysql['charset']);
    if ($get['_mysql']->connect_error) {
      respond("통신 오류가 발생하였습니다. 재시도 하세요.");
    } else {
      $get['sql'] = "SELECT * FROM `meal` WHERE `date`='".$today."' AND `type`='".$type."'";
      $result = $get['_mysql']->query($get['sql']);
      $output = "";
      if ($result->num_rows > 0) {
      	 $row = $result->fetch_assoc();
          // output data of each row
          $output = date("오늘은 Y년m월d일 입니다.")."\n오늘 ".$meal_type."을 표시합니다.\n================\n";
          $output .= str_replace(",","\n",$row['meal']);
      } else {
          $output = "급식이 없거나, 등록되지 않았습니다.";
      }
      return $output;
    }
  }

  function setmeal($type, $date, $menu)
  {
    include "mysql.php";
    $meal['mysql_date'] = str_replace(".","-",$date);
    //respond("NEIS 데이터 처리방식 변경으로, \n지원이 일시적으로 중지되었습니다.\n이점 양해 부탁드립니다.");
    switch($type)
    {
      case 'lunch':
      case '점심':
      case '중식':
        $meal_type = "중식";
        $type = 'lunch';
        break;
      case 'dinner':
      case '저녁':
      case '석식':
        $meal_type = "석식";
        $type = 'dinner';
        break;
      default:
        $meal_type = "에러";
        $type = "error";
        break;
    }
      $meal['_mysql'] = new mysqli($mysql['address'],$mysql['username'],$mysql['password'],$mysql['dbname']);
      mysqli_set_charset($meal['_mysql'], $mysql['charset']);
      if ($meal['_mysql']->connect_error) {
        respond("통신 오류가 발생하였습니다. 재시도 하세요.". $meal['_mysql']->connect_error);
        $alternative_keyboard = true;
        $alternative_keyboard_data = '{
          "type" : "text"
        }';
      } else {
        $meal['sql'] = "INSERT INTO meal (`date`, `meal`, `type`) VALUES ('".$meal['mysql_date']."','".$menu."','".$type."')";
        if ($meal['_mysql']->query($meal['sql']) === TRUE) {
          respond("날짜: ".$date."\n종류: ".$meal_type."\n식단: ".$menu."\n작성 성공 여부: 성공");
        } else {
          respond("날짜: ".$date."\n종류: ".$meal_type."\n식단: ".$menu."\n작성 성공 여부: 실패 \n오류 로그:". $meal['_mysql']->error."\nSQL:". $meal['sql']);
        }
      }

    }


  function setmeal_sibal($type, $date, $menu)
  {
    include "mysql.php";
    $meal['mysql_date'] = str_replace(".","-",$date);
    //respond("NEIS 데이터 처리방식 변경으로, \n지원이 일시적으로 중지되었습니다.\n이점 양해 부탁드립니다.");
    switch($type)
    {
      case 'lunch':
      case '점심':
      case '중식':
        $meal_type = "중식";
        $type = 'lunch';
        break;
      case 'dinner':
      case '저녁':
      case '석식':
        $meal_type = "석식";
        $type = 'dinner';
        break;
      default:
        $meal_type = "에러";
        $type = "error";
        break;
    }
      $meal['_mysql'] = new mysqli($mysql['address'],$mysql['username'],$mysql['password'],$mysql['dbname']);
      mysqli_set_charset($meal['_mysql'], $mysql['charset']);
      if ($meal['_mysql']->connect_error) {
        respond("통신 오류가 발생하였습니다. 재시도 하세요.". $meal['_mysql']->connect_error);
        $alternative_keyboard = true;
        $alternative_keyboard_data = '{
          "type" : "text"
        }';
      } else {
        $meal['sql'] = "INSERT INTO meal (`date`, `meal`, `type`) VALUES ('".$meal['mysql_date']."','".$menu."','".$type."')";
        if ($meal['_mysql']->query($meal['sql']) === TRUE) {
          return "날짜: ".$date."\n종류: ".$meal_type."\n식단: ".$menu."\n작성 성공 여부: 성공";
        } else {
          return "날짜: ".$date."\n종류: ".$meal_type."\n식단: ".$menu."\n작성 성공 여부: 실패 \n오류 로그:". $meal['_mysql']->error."\nSQL:". $meal['sql'];
        }
      }

    }


  function chkmeal($type, $date)
  {
    include "mysql.php";
    //respond("NEIS 데이터 처리방식 변경으로, \n지원이 일시적으로 중지되었습니다.\n이점 양해 부탁드립니다.");
    switch($type)
    {
      case 'lunch':
      case '점심':
      case '중식':
        $meal_type = "중식";
        $type = 'lunch';
        break;
      case 'dinner':
      case '저녁':
      case '석식':
        $meal_type = "석식";
        $type = 'dinner';
        break;
      default:
        $meal_type = "에러";
        $type = "error";
        break;
    }
    $today = str_replace(".","-",$date);
    $get['_mysql'] = new mysqli($mysql['address'],$mysql['username'],$mysql['password'],$mysql['dbname']);
    mysqli_set_charset($get['_mysql'], $mysql['charset']);
    if ($get['_mysql']->connect_error) {
      return false;
    } else {
      $get['sql'] = "SELECT * FROM `meal` WHERE `date`='".$today."' AND `type`='".$type."'";
      $result = $get['_mysql']->query($get['sql']);
      $output = "";
      if ($result->num_rows > 0) {
      	 return true;
      } else {
      	 return false;
      }
    }
  }

?>
