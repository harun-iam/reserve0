<?php
require_once 'functions.php';
session_start();

?>

<!doctype html>
<html lang="ja">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Original CSS-->
  <link rel="stylesheet" href="css/style.css">
  <title>予約内容確認</title>
</head>

<body>
  <header>SAMPLE SHOP</header>
  <h1>予約内容確認</h1>
  <table class="table">
    <tbody>
      <tr>
        <th scope="row">日時</th>
        <td> <?= format_date($_SESSION['RESERVE']['reserve_date'])?> <?=$_SESSION['RESERVE']['reserve_time']?> </td>
      </tr>
      <tr>
        <th scope="row">人数</th>
        <td> <?=$_SESSION['RESERVE']['reserve_num']?>名</td>
      </tr>
      <tr>
        <th scope="row">氏名</th>
        <td colspan="2"> <?=$_SESSION['RESERVE']['name']?> </td>
      </tr>
      <tr>
        <th scope="row">メールアドレス</th>
        <td colspan="2"> <?=$_SESSION['RESERVE']['email']?> </td>
      </tr>
      <tr>
        <th scope="row">電話番号</th>
        <td colspan="2"> <?=$_SESSION['RESERVE']['tel']?> </td>
      </tr>
      <tr>
        <th scope="row">備考</th>
        <td colspan="2"> <?= nl2br($_SESSION['RESERVE']['comment'])?> </td>
      </tr>
    </tbody>
  </table>

  <div class="d-grid gap-2 mx-3">
    <a class="btn btn-primary rounded-pill" href="complete.php">予約確定</a>
    <a class="btn btn-secondary rounded-pill" href="http://localhost/reserve0test/web/index.php">戻る</a>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>