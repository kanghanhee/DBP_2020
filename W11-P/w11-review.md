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
```
insert into location values (3201, 'garosugil', '60000', 'Seoul', NULL, 'KR')
```
```
위 sql문을 사용해 데이터를 삽입하였더니 parent key not found라는 오류가 발생했다.
참조하는 테이블에 KR이라는 값이 없어 발생한 오류같아 KR->US로 고쳐주니 오류가 해결됐다.
```

		

참고사이트
https://m.blog.naver.com/PostView.nhn?blogId=chocohigh21&logNo=220729924806&proxyReferer=https:%2F%2Fwww.google.com%2F


학습회고
(+): 오라클로 실습하니 새로워서 좋았다.

(-): 이클립스에서 tab이 바로 실행되지 않아 불편하다.

(!): 트랜잭션

유튜브 링크
https://youtu.be/MP8Dg6q3J2M


