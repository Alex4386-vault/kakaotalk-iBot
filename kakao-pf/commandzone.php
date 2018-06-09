<?php
  //특수 명령어 핸들링 담당

  //특수 명령어 처리 함수
  function commandline($data, $content)
  {
    include "mysql.php"; //mysql 인증 파일을 불러옵니다
    if(mb_substr( $content, 0, 5 ) === "!숙제등록") { //메세지의 시작이 !숙제등록이라면
      //respond("숙제등록이 핸들링 되었습니다.");
      $splits = explode(" ",$content);
      if (!isset($splits[1]) || !isset($splits[2])) {
        respond("사용 예:\n !숙제등록 2018.04.14 미적분2 숙제");
        $alternative_keyboard = true;
        $alternative_keyboard_data = '{
          "type" : "text"
        }';
      } else {
        //splits[1] = 2018.04.14
        //content에서 splits[0],splits[1] 을 제거하여 나오는 문자열이 설명
        $list['date'] = $splits[1];
        $list['title'] = str_replace($splits[0]." ".$splits[1]." ","",$content);
        $list['_mysql'] = new mysqli($mysql['address'],$mysql['username'],$mysql['password'],$mysql['dbname']);
        mysqli_set_charset($list['_mysql'], $mysql['charset']);
        if ($list['_mysql']->connect_error) {
          respond("통신 오류가 발생하였습니다. 재시도 하세요.". $list['_mysql']->connect_error);
          $alternative_keyboard = true;
          $alternative_keyboard_data = '{
            "type" : "text"
          }';
        } else {
          $list['mysql_date'] = str_replace(".","/",$list['date']);
          $list['sql'] = "INSERT INTO homework (`date`, `title`) VALUES (STR_TO_DATE('". $list['mysql_date'] ."', '%Y/%m/%d'), '".$list['title']."')";
          if ($list['_mysql']->query($list['sql']) === TRUE) {
            respond("날짜: ".$list['date']."\n제목: ".$list['title']."\n작성 성공 여부: 성공");
          } else {
            respond("날짜: ".$list['date']."\n제목: ".$list['title']."\n작성 성공 여부: 실패 \n오류 로그:". $list['_mysql']->error."\nSQL:". $list['sql']);
          }
        }
      }
    } else if (mb_substr( $content, 0, 5 ) === "!중식등록") {
      $splits = explode(" ",$content);
      if (!isset($splits[1]) || !isset($splits[2])) {
        respond("사용 예:\n !".$meal_type."등록 2018.04.17 렌틸콩밥,제육볶음우동,고구마함박,뼈없는감자탕...");
        $alternative_keyboard = true;
        $alternative_keyboard_data = '{
          "type" : "text"
        }';
      } else {
        //정상적으로 입력 했을때
        //Parse.
        $lunch['date'] = $splits[1];
        $lunch['menu'] = str_replace($splits[0]." ".$splits[1]." ","",$content);
        setmeal("lunch",$lunch['date'],$lunch['menu']);
      }
    } else if (mb_substr( $content, 0, 5 ) === "!석식등록") {
      $splits = explode(" ",$content);
      if (!isset($splits[1]) || !isset($splits[2])) {
        respond("사용 예:\n !석식등록 2018.04.17 렌틸콩밥,제육볶음우동,고구마함박,뼈없는감자탕...");
        $alternative_keyboard = true;
        $alternative_keyboard_data = '{
          "type" : "text"
        }';
      }
    } else if (mb_substr( $content, 0, 5 ) === "!급식등록") {
      $splits = explode(" ",$content);
      if (!isset($splits[1]) || !isset($splits[2])) {
        respond("사용 예:\n !급식등록 2018.04.17 [중식] .... [석식] ....");
        $alternative_keyboard = true;
        $alternative_keyboard_data = '{
          "type" : "text"
        }';
      } else {
        //정상적으로 입력 했을때
        //Parse.
        $meal['date'] = $splits[1];
        $meal['data'] = str_replace($splits[0]." ".$splits[1]." ","",$content);
	$meal['_hndlr'] = explode("[석식]",$meal['data']);
	$meal['lunch'] = $meal['_hndlr'][0];
	if(!isset($meal['lunch'])) { respond("중식 값이 없잖아! 똑바로 안해?\n석식등록할꺼면, !석식등록 있잖아!!! (빠따)"); }
	$meal['dinner'] = "[석식]".$meal['_hndlr'][1];
        $meal['output'] = setmeal_sibal("lunch",$meal['date'],$meal['lunch']);
	$meal['output'] .= "\n".setmeal_sibal("dinner",$meal['date'],$meal['dinner']);
	respond($meal['output']);
      }
    } else {
      respond("존재하지 않는 특수 명령어 입니다.");
      $alternative_keyboard = true;
      $alternative_keyboard_data = '{
        "type" : "text"
      }';
    }
  }

?>
