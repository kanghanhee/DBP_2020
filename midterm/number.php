<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'employees');

    if(mysqli_connect_errno()){
        echo "Failed to connect to MariaDB: " . mysqli_connect_error();
        exit();
    }

    settype($_GET['number'], 'integer');
    $filtered_number = mysqli_real_escape_string($link, $_GET['number']);
    
    $query = "
        SELECT dept_name, CNT
            FROM departments
            INNER JOIN (
                SELECT dept_no, count(*) CNT
                    FROM dept_emp
                    WHERE to_date = '9999-01-01'
                    GROUP BY dept_no
            ) DS ON departments.dept_no = DS.dept_no
            ORDER BY departments.dept_no
    ";

    $result = mysqli_query($link, $query);  

    $article = '';    
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= $row["dept_name"];
        $article .= '</td><td>';
        $article .= $row["CNT"];
        $article .= '</td></tr>';
    }
    
    mysqli_free_result($result);
    mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="number_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&family=Stylish&display=swap"
        rel="stylesheet">
    <title>전체 직원 수</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Stylish&display=swap');

    body {
        font-family: 'Stylish', sans-serif;
        font-family: 12px;
    }
    </style>
    <script src="https://kit.fontawesome.com/4e5de724b7.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="header">
        <div id="logo">
            <i class="fab fa-airbnb"></i>
            <a href="index.php">airbnb</a>
        </div>

        <ul class="navbar">
            <li><a href="number.php">전체 직원 수</a></li>
            <li><a href="path.php">인사이동</a></li>
            <li><a href="salary.php">부서별 직원 리스트 & 급여</a></li>
        </ul>
        <ul class="navbar_icons">
            <li><i class="far fa-bell"></i></li>
            <li><i class="fab fa-facebook"></i></li>
        </ul>
    </div>
    <div class="main">
        <div class="box">
            <table>
                <tr class="title">
                    <th>부서명</th>
                    <th>총인원</th>
                </tr>
                <?= $article ?>
            </table>
        </div>
    </div>
    </nav>
</body>

</html>