<?php
  //시간표 데이터베이스 관리
  function output_timetable($tt)
  {
    $count = count($tt);
    $output = "";

    for($i = 0; $i < $count; $i++)
    {
      $output = $output . " \n " . ($i + 1) . ". " . $tt[$i];
    }

    return $output;
  }

  function get_timetable($day)
  {
    switch($day)
    {
      case 'Mon':
        $timetable = array('화학/생명', '미적분2', '체육', '기하와벡터B', '환경', '고전');
        break;
      case 'Tue':
        $timetable = array('미적분2', '화학/생명', '영어B', '기하와벡터A', '지구과학', '윤리와사상', '영어A');
        break;
      case 'Wed':
        $timetable = array('미술', '지구과학', '영어B', '화학/생명', '영어A', '기벡A');
        break;
      case 'Thu':
        $timetable = array('논술', '기벡B', '지구과학', '윤리와사상','화학/생명', '화법과작문', '영어A');
        break;
      case 'Fri':
        $timetable = array('화법과작문','지구과학','고전','체육','창체','창체');
        break;
      case 'Sat':
      case 'Sun':
        $timetable = array('오늘은 수업이 없는 요일입니다.');
        break;
      default:
        $timetable = array('오류가 발생했습니다.');
        break;
    }
    return $timetable;
  }
?>
