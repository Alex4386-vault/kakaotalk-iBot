
<?php
$mono = 1;
//ini_set("display_errors",1);
require "../getmeal.php";
require "/var/www/html/common/header.php";

$meal['date'] = $_POST['date'];
$meal['data'] = $_POST['neis'];

$meal['_hndlr'] = explode("[석식]",$meal['data']);
$meal['lunch'] = $meal['_hndlr'][0];
if(chkmeal("dinner",$_POST['date']) || chkmeal("lunch",$_POST['date']))
{
  die("이미 이 날짜에 데이터가 존재한다고! 수정은 알아서 phpmyadmin 들어가서 해");
}
if(!isset($meal['lunch']))
{
  die("오류가 발생했습니다.\n중식 값이 없잖아! 똑바로 안해?");
}
$meal['dinner'] = "[석식]".$meal['_hndlr'][1];
echo "등록한 값:<br>";
echo $meal['lunch'];
echo "<br>";
echo $meal['dinner'];
echo "<br>";
echo "<hr />";
echo "<br>";

$meal['output'] = setmeal_sibal("lunch",$meal['date'],$meal['lunch']);
$meal['output'] .= "\n".setmeal_sibal("dinner",$meal['date'],$meal['dinner']);
echo str_replace("\n","<br>",$meal['output']);

require "/var/www/html/common/footer.php";
?>