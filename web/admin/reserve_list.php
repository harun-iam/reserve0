<?php
require_once(dirname(__FILE__) . '/../functions.php');

//DBに接続
$pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';', DB_USER, DB_PASSWORD);
$pdo->query('SET NAMES utf8;');

$year = @$_GET['year'];
$month = @$_GET['month'];

if(!$year) {
  $year = date('Y');
}

if(!$month) {
  $month = date('m');
}

//対象データの予約データを取得
$stmt = $pdo->prepare("SELECT * FROM reserve 
WHERE DATE_FORMAT(reserve_date, '%Y%m') = :yyyymm
ORDER BY reserve_date, reserve_time");
$stmt->bindValue(':yyyymm', $year . $month, PDO::PARAM_STR);
$stmt->execute();
$reserve_list = $stmt->fetchAll();

//年プルダウン構築
$year_array = array();
$current_year = date('Y');
for ($i = ($current_year - 1); $i <= ($current_year + 3); $i++) {
  $year_array[$i] = $i . '年';
}

//月プルダウン構築
$month_array = array();
for ($i = 1; $i <= 12; $i++) {
  $month_array[sprintf('%02d', $i)] = $i . '月';
}
?>



<!doctype html>
<html lang="ja">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Original CSS-->
  <link rel="stylesheet" href="../css/style.css">
  <title>予約リスト</title>
</head>

<body>
  <header class="navbar">
    <div class="container-fluid">
      <div class="navbar-brand">SAMPLE SHOP</div>
      <form class="d-flex">
        <a href="/admin/reserve_list.php" class="mx-3"><i class="bi bi-list-task nav-icon"></i></a>
        <a href="/admin/setting.php"><i class="bi bi-gear nav-icon"></i></a>
      </form>
    </div>
  </header>

  <h1>予約リスト</h1>

  <form id="filter-form" method="get">
    <div class="row m-3">
      <div class="col">
        <?= arrayToSelect('year', $year_array, $year) ?>
      </div>
      <div class="col">
        <?= arrayToSelect('month', $month_array, $month) ?>
      </div>
    </div>
  </form>

  <?php if(!$reserve_list) : ?>
    <div class="alert alert-warning" role="alert">予約データがありません。</div>
    <?php else : ?>
  <table class="table">
    <tbody>
      <?php foreach ($reserve_list as $reserve) : ?>
        <tr>
          <td> <?= format_date($reserve['reserve_date']) ?> </td>
          <td> <?= format_time($reserve['reserve_time']) ?> </td>
          <td> <?= $reserve['name'] ?> <?= $reserve['reserve_num'] ?>名<br>
            <?= $reserve['email'] ?><br>
            <?= $reserve['tel'] ?><br>
            <?= mb_strimwidth($reserve['comment'], 0, 90, '...') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>$('.form-select').change(function() {
      $('#filter-form').submit()
    })</script>
</body>

</html>