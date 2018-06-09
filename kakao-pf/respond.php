<?php
//The Response Engine for Kakaotalk bot respond.
//카카오톡 봇 스마트 채팅 API 이용을 위한 응답 엔진입니다.

function respond($message)
{
  //LF -> CRLF
  $message = str_replace("\r", "", $message);
  
  //New Line 문자 escape 작업
  $message = str_replace("\n", "\\n", $message);

  //JSON 포맷으로 출력
  echo '
      "message":
      {
          "text":"'.$message.'"
      }';
}

//이미지 포함해서 응답 하기
function respond_image($message, $imageurl)
{
  //또 이스케이프 진행
  $message = str_replace("\n", "\\n", $message);

  //JSON 포맷 출력
  echo '
      "message":
      {
          "text":"'.$message.'",
          "photo":{
            "url":"'.$imageurl.'",
            "width":640,
            "height":360
          }
      }';
}

//커스텀 사이즈의 사진 응답
function respond_image_customsize($message, $imageurl, $width, $height)
{
  $message = str_replace("\n", "\\n", $message);
  echo '
      "message":
      {
          "text":"'.$message.'",
          "photo":{
            "url":"'.$imageurl.'",
            "width":'.$width.',
            "height":'.$height.'
          }
      }';
}

//이미지와 링크로 응답
function respond_imageandlink($message, $imageurl, $btncaption, $btnurl)
{
  $message = str_replace("\n", "\\n", $message);
  echo '
      "message":
      {
          "text":"'.$message.'",
          "photo":{
            "url":"'.$imageurl.'",
            "width":640,
            "height":360
          },
          "message_button":{
            "label":"'.$btncaption.'",
            "url":"'.$btnurl.'"
          }
      }';
}


?>
