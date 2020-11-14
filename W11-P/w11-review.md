#11주차 학습회고

새로 배운 내용
-Transaction, Rollback, Commit
```
-트랜잭션이란?
 :DB의 상태를 변환시키는 하나의 논리적 기능을 수행하기 위한 작업의 단위
 :COMMIT되거나 ROLLBACK됨.
-트랜잭션의 성질
 :원자성, 일관성, 독립성, 지속성
-트랜잭션의 상태
 :active->partially committed->commited(완료)
 :active->failed->aborted.rollback(철회)
```
 
-리팩토링(자원반납하여 메모리 낭비 방지)
```
public void closeAll(Connection conn, PreparedStatement psmt, ResultSet rs) {
		
		try {
			if(rs!=null) rs.close();
			if(psmt != null) psmt.close();
			if(conn != null) conn.close();
			System.out.println("all connection close!");
		}catch(SQLException sqle) {
			System.out.println("Error!");
			sqle.printStackTrace();
		}
	}
```
  

문제 발생과 해결 과정
-------------
select 실습하는 과정에서 내가 insert하여 데이터를 추가하면 맨 뒤가 아닌 맨 앞에 배치하게 됐다. 그래서 select문을 사용하면 계속 이미 만들어져있던 데이터의 마지막 값을 데려오고 내가 데이터를 계속 추가해도 못 가져오는 상태가 됐다.
사용했던 sql문: select * from (select * from departments order by rownum DESC) where rownum =1
변경한 sql문:  select * from (select * from departments order by department_id DESC) where rownum =1
그래서 department_id로 내림차순 정렬하여 내가 마지막으로 추가한 데이터를 정상적으로 가져올 수 있게 됐다.
		

참고사이트
----------
https://jhroom.tistory.com/50


회고
------
(+): 오라클을 이용해 내가 원하는 데이터를 이용해 조회, 추가, 변경, 삭제 실습을 해볼 수 있어서 좋았다. 좀 더 능숙하게 다뤄보고 싶다.

(-): select실습 시 오류, 이클립스에서 db와 연결하는 코드가 아직 미숙하다.

(!): Oracle, JAVA, JDBC

