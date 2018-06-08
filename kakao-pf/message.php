{
<?php
  $version = '0.1 beta\npowered by nginx.';
  //ini_set('display_errors',1);
  $alternative_keyboard = FALSE;
  include "hwloadsave.php";
  include "mysql.php";
  include "getmeal.php";
  include "respond.php";
  include "timetable.php";

  $data = json_decode(file_get_contents('php://input'), true);
  if (isset($_GET['debug']))
  {
    if ($_GET['debug'] == 1)
    {
      $content = $_GET['content'];
    }
  } else {
    $content = $data["content"];
  }

  if(mb_substr( $content, 0, 1 ) === "!")
  {
    include "commandzone.php";
    commandline($data, $content);
    //respond("Special Command!");
  } else {
    switch($content)
    {
      case "상담원":
        respond_image_customsize("예쁜 상담원 정재원: 안녕하세요 상담원입니다 무엇을 도와드릴까요?","https://yeoidotech.ze.am/kakao-pf/assets/jaewonbbadda.jpg","360","640");
	//respond("상담사가 존재하지 않습니다.");
        break;
      case "중식알림":
        respond(getmeal("lunch"));
        break;
      case "석식알림":
        respond(getmeal("dinner"));
        break;
      case "현재시각":
        respond(date("Y년 m월 d일")."\n".date("G시 i분 s초 e"));
        break;
      case "숙제리스트":
        $today = date("Y-m-d");
        $todate = date("Y-m-d",strtotime('+ 7 days', strtotime(date("Y-m-d"))));
        gethomework($today, $todate);
        break;
      case "오늘숙제":
        $today = date("Y-m-d");
        gethomework($today, $today);
        break;
      case "시험디데이":
        $nDate = date("Y-m-d",time()); // 오늘 날짜를 출력하겠지요?
	$valDate = '2018-09-05'; // 폼에서 POST로 넘어온 value 값('yyyy-mm-dd' 형식)
	$leftDate = intval((strtotime($nDate)-strtotime($valDate)) / 86400 * -1); // 나머지 날짜값이 나옵니다.
	$finalexamDate = '2018-07-04'; // 폼에서 POST로 넘어온 value 값('yyyy-mm-dd' 형식)
	$leftforfinalDate = intval((strtotime($nDate)-strtotime($finalexamDate)) / 86400 * -1); // 나머지 날짜값이 나옵니다.
	respond("9월 평가원 모평까지 ".$leftDate."일 남았습니다 \n기말고사까지 ".$leftforfinalDate."일 남았습니다");
        break;
      case "전체시간표":
        respond_imageandlink("시간표 입니다.", "https://yeoidotech.ze.am/kakao-pf/assets/timetable.jpg", "시간표 자세히 보기", "https://yeoidotech.ze.am/kakao-pf/assets/timetable.jpg");
	      break;
      case "씹덕":
        respond_image_customsize("한웅희:네다씹","https://yeoidotech.ze.am/kakao-pf/assets/ssipduk.jpg",360,640);
	      break;
      case "오늘시간표":
        $timetable = get_timetable(date('D'));
        $output = output_timetable($timetable);
        respond(date("Y년 m월 d일 시간표")."\n".$output);
        break;
      case "내일시간표":
        $output = "";
        $adddates = '+ 1 days';
        if (date('D') == 'Fri') {
          $output = "오늘은 금요일입니다. 내일 학교에 가지 않으므로, 월요일 시간표를 출력합니다.\n";
          $adddates = '+ 3 days';
        } else if (date('D') == 'Sat') {
          $output = "오늘은 토요일입니다. 내일 학교에 가지 않으므로, 월요일 시간표를 출력합니다.\n";
          $adddates = '+ 2 days';
        }
        $tommorow_day = date('D',strtotime($adddates, strtotime(date("Y-m-d"))));
        $timetable = get_timetable($tommorow_day);
        $tommorow_date = date("Y년 m월 d일 시간표",strtotime($adddates, strtotime(date("Y-m-d"))));
	$output .= $tommorow_date."\n";
        $output .= output_timetable($timetable);
        respond($output);
        break;
      case 'ギジュンさん':
      case 'おかべさん':
      case '기중상':
      case '기즁상':
      case '오카베상':
        respond("こんにちは、私はおかべキムです");
	break;
      case '손은성병신':
        respond("앙 기모띠?");
        break;
      case 'fucking한웅희':
        respond("yes,웅희 is fucking");
        break;
      case '특수명령어':
        respond("특수명령어 사용이 가능합니다.\n특수명령어를 입력하세요\n관리자가 아니어서, 특수 명령어를 모르는 경우에는 아무 문자를 입력하여 특수 명령어 입력모드에서 나갈 수 있습니다.");
        $alternative_keyboard = true;
        $alternative_keyboard_data = '{
          "type" : "text"
        }';
        break;
      case "라이선스":
        respond("Schoolinfo bot engine. ver.".$version."\nDeveloped by MonoChrome\nDistributed under MIT License\n\nThe Original Source Code can be found at here:\nhttps://github.com/Alex4386/kakaotalk-iBot");
	break;
      default:
        respond("올바르지 않은 명령어 입니다.");
        break;
    }
  }
  echo ', "keyboard":';
  if (!($alternative_keyboard))
  {
    include "keyboard.php";
  } else {
    echo $alternative_keyboard_data;
  }
?>
}
