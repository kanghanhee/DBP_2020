<?php
  $link = mysqli_connect("localhost:3307", "root", "20180962", "dbpp");
  settype($_POST['id'], 'integer');
  $filtered = array(
    'id' => mysqli_real_escape_string($link, $_POST['id']),
    'season' => mysqli_real_escape_string($link, $_POST['season']),
    'month' => mysqli_real_escape_string($link, $_POST['month'])
  );
  $query = "
    UPDATE flowering
      SET
        season = '{$filtered['season']}',
        month = '{$filtered['month']}'
      WHERE
        id = '{$filtered['id']}'
  ";

  $result = mysqli_query($link, $query);
  if ($result == false) {
      echo '수정하는 과정에서 문제가 발생했습니다. 관라자에게 문의하세요.';
      error_log(mysqli_error($link));
  } else {
      header('Location: flowering.php');
  }
