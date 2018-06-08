<?php
   $mono = 1;
    $common['source'] = '
  <style>
    h1 {
      font-size:4em;
      font-weight:700
    }
    h3 {
      font-size:2em;
      font-weight:300
    }
    input {
      width:calc(100% - 2em);
      margin-top:1em
    }
    textarea {
      width:calc(100% - 2em);
      height:10em;
      margin-top:1em
    }
    .submit-button {
      border-radius: 12px;
      padding:1em;
      background-color:#e7e7e7;
      border:none;
      font-size:1.2em
    }
  </style>
';
  include "/var/www/html/common/header.php";
?>


<h1>급식 리스트</h1>

<h3>급식을 조회 할 수 있습니다.</h3>
<hr />


<?php
  ini_set("display_errors",1);
  include "mealloader.php";
  include "/var/www/html/common/footer.php";
?>