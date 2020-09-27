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

  if (isset($_GET['id'])) {
      $query = "SELECT * FROM flower WHERE id={$_GET['id']}";
      $result = mysqli_query($link, $query);
      $row = mysqli_fetch_array($result);
      $article = array(
      'title' => $row['title'],
      'description' => $row['description']
   ); //php에서 배열 할당하는 방법
      $updated_link = '<a href="update.php?id'.$_GET['id'].'">update</a>';
  }

  $query = "SELECT * FROM flowering";
  $result = mysqli_query($link, $query);
  $select_form = '<select name="flowering_id">';
  while ($row = mysqli_fetch_array($result)) {
      $select_form .= '<option value="'.$row['id'].'">'.$row['month'].'</option>';
  }
  $select_form .= '</select>';
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title> FLOWER </title>
</head>
<body>
  <h1><a href="index.php"> FLOWER </a></h1>
  <ol> <?= $list ?> </ol>
  <form action="process_create.php" method="post">
    <p><input type="text" name="title" placeholder="title"></p>
    <p><textarea name="description" placeholder="description"></textarea></p>
    <?= $select_form ?>
    <p><input type="submit"></p>
  </form>
</body>
</html>
