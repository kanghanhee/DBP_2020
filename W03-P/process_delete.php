<?php
  $link = mysqli_connect("localhost:3307", "root", "20180962", "dbpp");
  settype($_POST['id'], 'int');
  $filtered = array(
    'id' => mysqli_real_escape_string($link, $_POST['id'])
  );
  $query = "
    DELETE
      FROM flower
      WHERE id = '{$filtered['id']}'
  ";

  $result = mysqli_multi_query($link, $query);
  if($result == false){
    echo '삭제하는 과정에서 문제가 발생했습니다. 관라자에게 문의하세요.';
    error_log(mysqli_error($link));
  } else {
    echo '성공했습니다. <a href="index.php">돌아가기</a>';
  }
?>
