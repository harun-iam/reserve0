<?php
require_once(dirname(__FILE__) . '/../functions.php');

try {
  session_start();

  //DBに接続
  $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';', DB_USER, DB_PASSWORD);
  $pdo->query('SET NAMES utf8;');

  if (isset($_SESSION['USER'])) {
    // ログイン済みの場合は予約一覧画面へ
    header('Location: http://localhost/reserve0test/web/admin/reserve_list.php');
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // POST処理時

    //入力値を取得
    $login_id = $_POST['login_id'];
    $login_password = $_POST['login_password'];

    //バリデーションチェック
    $err = array();

    if (!$login_id) {
      $err['login_id'] = 'IDを入力してください。';
    }

    if (!$login_password) {
      $err['login_password'] = 'パスワードを入力してください。';
    }

    if (empty($err)) {
      $sql = "SELECT * FROM shop WHERE login_id = :login_id AND login_password = :login_password LIMIT 1";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':login_id', $login_id, PDO::PARAM_STR);
      $stmt->bindValue(':login_password', $login_password, PDO::PARAM_STR);
      $stmt->execute();
      $user = $stmt->fetch();

      if ($user) {
        //ログイン処理（セッションに保存）
        $_SESSION['USER'] = $user;

        //HOME画面へ遷移
        header('Location: http://localhost/reserve0test/web/admin/reserve_list.php');
      } else {
        $err['common'] = '認証に失敗しました。';
      }
    }
  } else {
    // 画面初回アクセス時
    $login_id = "";
    $login_password = "";
  }

  $page_title = 'ログイン';
} catch (Exception $e) {
  header('Location: /error.php');
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
  <title>予約システムログイン</title>
</head>

<body>
  <header>SAMPLE SHOP</header>
  <h1>予約システムログイン</h1>

  <form class="card text-center" method="post">
    <div class="card-body">

    <?php if (isset($err['common'])) : ?>
      <div class="alert alert-danger" role="alert"> <?= $err['common'] ?></div>
    <?php endif; ?>

      <div class="mb-3 text-start">
        <input type="text" class="form-control <?php if (isset($err['login_id'])) echo 'is-invalid' ?>" id="login_id" name="login_id" placeholder="ID" value="<?= $login_id ?>">
        <div class="invalid-feedback"><?= $err['login_id'] ?></div>
      </div>
      <div class="mb-3 text-start">
        <input type="password" class="form-control <?php if (isset($err['login_password'])) echo 'is-invalid' ?>" id="login_password" name="login_password" placeholder="PASSWORD">
        <div class="invalid-feedback"><?= $err['login_password'] ?></div>
      </div>
      <div class="d-grid gap-2 my-3">
        <button class="btn btn-primary rounded-pill" type="submit">ログイン</button>
      </div>
    </div>
  </form>



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>