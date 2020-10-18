#7주차 학습회고

**새로배운내용**

- OpenSSH : ssh프로토콜을 이용하여 암호화된 통신세션을 컴퓨터 네트워크에 제공하는 컴퓨터 프로그램   
- openSSH 설치
```
//ssh 설치
- sudo apt install openssh-server

//설치 후 systemctl로 상태 확인(active인지)
- sudo systemctl status ssh

```
- mariaDB
```
- mysql -uadmin -p //mysql 접속 u:사용자, -p:패스워드 입력

- select * from employees limit 10; // 10개 데이터만 보여줌
```

**문제가 발생하거나 고민한 내용 + 해결과정**
    
    config파일을 과제를 해결하는 도중 JOIN한 결과값이 너무 많이 출력되어 렉이 걸리는 문제가 발생하였다. 
    따라서 departments_info.php파일의 쿼리문에 LIMIT로 출력될 데이터 개수를 지정해주어 해결하였다.

**참고할 만한 내용**
https://forest71.tistory.com/28?category=554995 샘플 데이터베이스 

**회고**

    + 저번시간보다 새롭게 실습해야될 양이 없어 좋았다.
    - 시험기간에도 과제를 해야하는게 힘들다.
    ! ctrl+shift+k와 방향키를 이용하면 원하는 행을 복사붙여넣기를 할 수 있다.
    
**문제: 직원이름과 소속부서 출력하기**
    
    소속부서를 출력하기 위해 index.php파일에 <a href>를 이용해 departments_info.php로 넘어갈 수 있도록 링크를 생성해주었고, departments_info.php 파일을 추가했다.
    
  -주요쿼리문 : employees, dept_emp, departments 총 3개의 테이블이 사용된다. 부서는 부서번호(dept_no)를 이용해 관계를 설정해주었고, WHERE문을 이용해 현재 근무중인 부서만 출력되도록 하였다.
    
    $query = "
        SELECT first_name, last_name, dept_name
            FROM dept_emp
            INNER JOIN employees ON employees.emp_no = dept_emp.emp_no
            INNER JOIN departments ON departments.dept_no = dept_emp.dept_no
       WHERE dept_emp.to_date = '9999-01-01'
       LIMIT 20000
    ";
    
    
 **유튜브 링크**
 https://youtu.be/6lwzIMTWRJU
