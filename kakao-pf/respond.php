<?php
//The Response Engine for Kakaotalk bot respond.

function respond($message)
{
  $message = str_replace("\r", "", $message);
  $message = str_replace("\n", "\\n", $message);
  echo '
      "message":
      {
          "text":"'.$message.'"
      }';
}

function respond_image($message, $imageurl)
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
          }
      }';
}

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
