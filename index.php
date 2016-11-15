<?php include "verifier.php"; ?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>연세대학교 합격자 인증 시스템</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./verifier.css">
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <h3 class="text-muted">연세대학교 합격자 인증 시스템</h3>
      </div>
      <div class="jumbotron">
        <h3>공지사항 제목</h3>
        <p class="lead mt-3">공지사항 내용</p>
      </div>
      <form method="post">
        <div class="form-group row">
          <label for="name-input" class="col-xs-2 col-form-label">이름</label>
          <div class="col-xs-10">
            <input class="form-control" type="text" name="name" id="name-input" value="<?php echo $student["name"];?>" placeholder="(예) 홍길동" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="admissions-type-input" class="col-xs-2 col-form-label">입시 전형</label>
          <div class="col-xs-10">
            <select class="form-control" name="type">
              <option>입시 전형을 선택하세요</option>
              <option>IT명품인재전형</option>
              <option>과학공학인재전형</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="id-input" class="col-xs-2 col-form-label">수험번호</label>
          <div class="col-xs-10">
            <input class="form-control" type="text" name="id" id="id-input" value="<?php echo $student["id"];?>" placeholder="(예) EAAA12345" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="birthdate-input" class="col-xs-2 col-form-label">생년월일</label>
          <div class="col-xs-10">
            <input class="form-control" type="number" name="birthdate" id="birthdate-input" value="<?php echo $student["birthdate"];?>"  placeholder="(예) 980101" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="email-input" class="col-xs-2 col-form-label">이메일</label>
          <div class="col-xs-10">
            <input class="form-control" type="email" name="email" id="email-input" value="<?php echo $student["email"];?>" placeholder="(예) id@domain.com"  aria-describedby="email-help-block" required>
            <p id="email-help-block" class="form-text text-muted">이메일을 통해 커뮤니티 초대 메일이 발송되므로 꼭 올바른 주소를 입력해 주세요.</p>
          </div>
        </div>
        <div class="text-xs-center mt-2 mb-2">
          <button type="submit" class="btn btn-lg btn-primary text-center">합격자 인증하기</button>
        </div>
      </form>
      <script>
        <?php 
          if ($response > 0) {
          	echo ("alert(\"" . $responseMessage . "\");");
          }
          ?>
      </script>
      <footer class="footer">
        <p>&copy; 글로벌융합공학부 15 김현준</p>
      </footer>
    </div>
  </body>
</html>