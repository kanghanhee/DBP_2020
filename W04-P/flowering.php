<?php
  $link = mysqli_connect('localhost:3307', 'root', '20180962', 'dbpp');

  $query = "SELECT * FROM flowering";
  $result = mysqli_query($link, $query);
  $flowering_info = '';

  while ($row = mysqli_fetch_array($result)) {
      $filtered = array(
      'id' => htmlspecialchars($row['id']),
      'season' => htmlspecialchars($row['season']),
      'month' => htmlspecialchars($row['month'])
    );
      $flowering_info .= '<tr>';
      $flowering_info .= '<td>'.$filtered['id'].'</td>';
      $flowering_info .= '<td>'.$filtered['season'].'</td>';
      $flowering_info .= '<td>'.$filtered['month'].'</td>';
      $flowering_info .= '<td><a href="flowering.php?id='.$filtered['id'].'">수정하기</a></td>';
      $flowering_info .=
      '<td>
        <form action="process_delete_flowering.php" method="post">
          <input type="hidden" name="id" value="'.$filtered['id'].'">
          <input type="submit" value="삭제하기">
          </form>
      </td>';
      $flowering_info .= '</tr>';
  };

$escaped = array(
  'season' => '',
  'month' => ''
);

$form_action = 'process_create_flowering.php';
$label_submit = 'Create flowering';
$form_id = '';

if (isset($_GET['id'])) {
    $filtered_id = mysqli_real_escape_string($link, $_GET['id']);
    settype($filtered_id, 'integer');
    $query = "SELECT * FROM flowering WHERE id = {$filtered_id}";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);
    $escaped['season'] = htmlspecialchars($row['season']);
    $escaped['month'] = htmlspecialchars($row['month']);

    $form_action = 'process_update_flowering.php';
    $label_submit = 'Update flowering';
    $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
};


 ?>

 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <title>FLOWER</title>
 </head>
<body>
  <h1><a href="index.php">FLOWER</a></h1>
  <p><a href="index.php">flower</a></p>

  <table border="1">
    <tr>
      <th>id</th>
      <th>season</th>
      <th>month</th>
      <th>update</th>
      <th>delete</th>
    </tr>
      <?= $flowering_info ?>
  </table>
  <br>
  <form action="<?= $form_action ?>" method="post">
    <?= $form_id ?>
    <label for="fname">season:</label><br>
    <input type="text" id="seson" name="season" placeholder="season" value="<?=$escaped['season']?>"><br>
    <label for="lname">month:</label><br>
    <input type="text" id="month" name="month" placeholder="month" value="<?=$escaped['month']?>"><br><br>
    <input type="submit" value="<?= $label_submit ?>">
  </form>
</body>
</html>
