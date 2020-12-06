<<<<<<< HEAD
#13주차 학습회고
=======
#13주차 학습회고

새로 배운 내용

-JSP
```
-JSP란?
 :HTML 내부에 java 코드를 입력하여 웹 서버에 동적으로 웹 브라우저를 관리하는 언어
 
```
```
-구동원리
 :JSP를 실행하면, JSP 에서 생성된 서블릿이 실행됨
  1) 클라이언트가 jsp 실행을 요청하면, 서블릿 컨테이너는 jsp 파일에 대응하는 자바 서블릿을 찾아서 실행한다.
  2) 대응하는 서블릿이 없거나, jsp 파일이 변경되었으면, jsp 엔진을 통해 서블릿 자바 소스를 생성한다.
  3) 자바 컴파일러가 서블릿 자바 소스를 클래스 파일로 컴파일 한다. (jsp 파일이 변경될때마다 반복)
  4) jsp 로 부터 생성된 서블릿은 서블릿 구동 방식에 의해 service() 메소드가 호출되고, 서블릿이 생성한 html 화면을 웹 브라우저로 보낸다. 

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
test connection 연결에서 계속 ping fail되었다. sqldevelper를 실행하여 호스트 이름과 사용자 이름 등을 비교하여 똑같이 맞춰주니 해결되었다.
```

		

참고사이트
없음.


학습회고
(+): 오류가 해결되어 좋았다.

(-): 왠지 잘 모르겠지만 실습과정이 오래걸렸다. 다른 공부를 못해 아쉬웠다.

(!): jsp

유튜브 링크
추가내용) employee_id를 입력하고 삭제버튼을 누르면 해당 아이디의 직원정보가 삭제된다.
https://www.youtube.com/watch?v=SkgGxf1VRzM&feature=youtu.be

>>>>>>> 97edba6976948d5e699743727d89a42836050cf4
