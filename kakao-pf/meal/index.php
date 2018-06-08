<?php
  $mono = 1;
  $og['title'] = "급식 등록";
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
  require "/var/www/html/common/header.php";
?>
<h1>급식 등록</h1>
<h3>NEIS의 개같은 파싱 방식을 호환되도록 수정해 줍니다.</h3>
<hr />
<br>
<form action="register.php" method="post">
  <p><input type="date" placeholder="날짜" name="date"></input></p>
  <p><textarea placeholder="NEIS의 병신 파싱 데이터" name="neis"></textarea></p>
  <button type="submit" class="submit-button">등록해 이 서버새꺄</button>
</form>
<?php
  require "/var/www/html/common/footer.php";
?>