#10주차 학습회고

새로 배운 내용
-------------

* DBP(DataBase Programming)
```
: DBMS에 데이터를 정의하고 저장된 데이터를 가져와 변경하는 프로그램을 작성하는 과정.

-4가지 선택 필요
  호스트 언어, DBMS, 운영체제, 컴퓨터 기종
  
-DBP 방법
  1)웹 프로그래밍 언어에 SQL 삽입.
  2)SQL 전용 언어 사용.(오라클은 PL/SQL, SQL Server는 T-SQL)
  3)일반 프록래밍 언어에 SQL 삽입.(JAVA, C++, C)
  4)데이터베이스 관리 기능과 비주얼 프로그래밍 기능을 갖춘 GUI 기반 SW개발 도구 사용.
```

* Oracle
```
: 오라클사의 공동 설립자인 래리 앨리슨이 1977년 SDL 회사를 설립하고 1982년에 오라클로 변경.

-외부에서도 접속할 수 있도록 설정 변경
  EXEC DBMS_XDB.SETLISTENERLOCALACCESS(FALSE);
  
-샘플 계정인 HR사용(unloct해서 잠금 풀어야함)
  ALTER USER HR ACCOUNT UNLOCK IDENTIFIED BY 1234;
```

* JDBC(Java DataBase Connectivity)
```
: 자바와 데이터베이스를 연동할 수 있는 API

-JDBC의 과정
  1)JDBC 드라이버 로드
  2)DB연결
  3)DB에 데이터 읽기/쓰기(SQL구문)
  4)DB연결 종료
```


문제 발생과 해결 과정
-------------
select.java 실습과정에서 접근하지 못하는 에러가 발생하였는데 ALTER USER HR ACCOUNT UNLOCK IDENTIFIED BY 1234;를 다시 해주니 정상적으로 실행되었다.

참고사이트
----------
없음

회고
------
(+): 시험이 끝난 후 부담스럽지 않은 강의라서 좋았다.
(-): 오류가 발생해 다시 해보느라 시간이 좀 걸렸다.
(!): JDBC에 대해 알게됨.
