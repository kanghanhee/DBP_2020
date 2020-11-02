<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'employees');

    if(mysqli_connect_errno()){
        echo "Failed to connect to MariaDB: " . mysqli_connect_error();
        exit();
    }

    settype($_GET['number'], 'integer');
    $filtered_number = mysqli_real_escape_string($link, $_GET['number']);
    
    $query = "
        SELECT DS.emp_no, employees.first_name, employees.last_name, PATH
            FROM (
                SELECT DE1.emp_no, GROUP_CONCAT(departments.dept_name SEPARATOR '>' ) PATH, count(*) CNT
                    FROM dept_emp DE1
                    INNER JOIN dept_emp DE2 ON DE2.emp_no = DE1.emp_no
                    INNER JOIN departments ON departments.dept_no = DE2.dept_no
                    WHERE DE1.to_date = '9999-01-01'
                    GROUP BY DE1.emp_no
                    HAVING count(*) > 1
                ) DS
            INNER JOIN employees ON employees.emp_no = DS.emp_no
        
            ORDER BY CNT desc
        
    ";

    $result = mysqli_query($link, $query);  

    $article = '';    
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= $row["emp_no"];
        $article .= '</td><td>';
        $article .= $row["first_name"];
        $article .= '</td><td>';
        $article .= $row["last_name"];
        $article .= '</td><td>';
        $article .= $row["PATH"];
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
    <link rel="stylesheet" href="path_style.css">
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
                    <th>사원 번호</th>
                    <th>이름</th>
                    <th>정보</th>
                    <th>비고</th>

                </tr>
                <?= $article ?>
            </table>
        </div>
    </div>
    </nav>
</body>


</html>