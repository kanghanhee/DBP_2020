<?php
  $link = mysqli_connect("localhost:3307", "root", "20180962", "dbpp");
  $filtered = array(
    'season' => mysqli_real_escape_string($link, $_POST['season']),
    'month' => mysqli_real_escape_string($link, $_POST['month'])
  );
  $query = "
    INSERT INTO flowering
      (season, month)
      VALUES (
        '{$filtered['season']}',
        '{$filtered['month']}'
        )
  ";

  $result = mysqli_query($link, $query);
  if ($result == false) {
      echo '저장하는 과정에서 문제가 발생했습니다. 관라자에게 문의하세요.';
      error_log(mysqli_error($link));
  } else {
      header('Location: flowering.php');
  }
