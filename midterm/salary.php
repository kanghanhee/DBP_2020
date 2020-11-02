<?php
    $link = mysqli_connect('localhost', 'admin', 'admin', 'employees');

    if(mysqli_connect_errno()){
        echo "Failed to connect to MariaDB: " . mysqli_connect_error();
        exit();
    }

    settype($_GET['number'], 'integer');
    $filtered_number = mysqli_real_escape_string($link, $_GET['number']);
    
    $query = "
        SELECT dept_name, first_name, last_name
                , IF(dept_manager.emp_no IS NULL, salaries.salary, DS.AVG_SALARY) AVG_SALARY
                , IF(dept_manager.emp_no IS NULL, NULL, 'MANAGER') position
            FROM dept_emp
            INNER JOIN departments ON departments.dept_no = dept_emp.dept_no
            INNER JOIN employees ON employees.emp_no = dept_emp.emp_no
            INNER JOIN salaries ON salaries.emp_no = dept_emp.emp_no
                LEFT OUTER JOIN dept_manager ON dept_manager.emp_no = dept_emp.emp_no AND dept_manager.to_date = '9999-01-01'
                LEFT OUTER JOIN (
                    SELECT dept_no, AVG(salary) AVG_SALARY
                        FROM dept_emp
                        INNER JOIN salaries ON salaries.emp_no = dept_emp.emp_no
                        WHERE dept_emp.to_date = '9999-01-01' AND salaries.to_date = '9999-01-01'
                        GROUP BY dept_no
                ) DS ON DS.dept_no = dept_emp.dept_no
                WHERE dept_emp.to_date = '9999-01-01' AND salaries.to_date = '9999-01-01'
                ORDER BY dept_name, dept_manager.emp_no DESC, first_name, last_name
                
    ";

    $result = mysqli_query($link, $query);  

    $article = '';    
    while($row = mysqli_fetch_array($result)){
        $article .= '<tr><td>';
        $article .= $row["dept_name"];
        $article .= '</td><td>';
        $article .= $row["first_name"];
        $article .= '</td><td>';
        $article .= $row["last_name"];
        $article .= '</td><td>';
        $article .= $row["AVG_SALARY"];
        $article .= '</td><td>';
        $article .= $row["position"];
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
    <link rel="stylesheet" href="salary_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&family=Stylish&display=swap"
        rel="stylesheet">
    <title>직급 및 급여</title>
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
                    <th>성</th>
                    <th>이름</th>
                    <th>평균급여</th>
                    <th>직급</th>
                </tr>
                <?= $article ?>
            </table>
        </div>
    </div>
    </nav>
</body>

</html>