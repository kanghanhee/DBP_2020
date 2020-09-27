<?php
  $link = mysqli_connect('localhost:3307', 'root', '20180962', 'dbpp');
  $query = "SELECT * FROM flower";
  $result = mysqli_query($link, $query);
  $list = '';
  while ($row = mysqli_fetch_array($result)) {
      $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$row['title']}</a></li>";
  }

  $article = array(
    'title' => 'Welcome',
    'description' => 'The language of flower is...'
  );
  $update_link = '';
  $delete_link = '';
  $flowering = '';

  if (isset($_GET['id'])) {
      $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
      $query = "SELECT * FROM flower LEFT JOIN flowering ON
  flower.flowering_id = flowering.id WHERE
  flower.id={$filtered_id}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article['title'] =
  htmlspecialchars($row['title']);
      $article['description'] =
  htmlspecialchars($row['description']);
      $article['month'] =
  htmlspecialchars($row['month']);

      $update_link = '<a href="update.php?id='.$_GET['id'].'">수정하기</a>';
      $delete_link = '
      <form action="process_delete.php" method="POST">
        <input type="hidden" name="id" value="'.$_GET['id'].'">
        <input type="submit" value="삭제하기">
      </form>
      ';

      $flowering = "<p>by {$article['month']}</p>";
  }
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> FLOWER </title>
</head>
<body>
  <h1><a href="index.php"> FLOWER </a></h1>
  <a href="flowering.php">개화시기</a>
  <ol> <?= $list ?> </ol>
  <a href="create.php">추가하기</a>
  <?=$update_link?>
  <?=$delete_link?>
  <h2><?= $article['title'] ?></h2>
    <?= $article['description'] ?>
    <?= $flowering ?>
</body>
</html>
