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
        <h3 class="text-muted"><img src="./yonsei-logo.png" height="42" width="42" style="margin-top: -8px">
          연세대학교 합격자 인증 시스템
        </h3>
      </div>
      <div class="jumbotron text-xs-left">
        <h3>안녕하십니까, 17학번 새내기 여러분!</h3>
        <br>
        <p class="lead">여러분들의 연세대학교 합격을 진심으로 축하드립니다.</p>
        <p> 저희는 연세대학교 중앙새내기맞이단으로 17학번 새내기 여러분들의 안전하고 즐거운 새내기 생활을 위하여 결성된 유일한 공식 단체입니다. 본 단체는 학교 중앙 소속 단체로서 신입생 여러분들의 안정적인 학교 생활 적응을 위하여 각종 업무를 진행하고 있습니다.</p>
        <p>그동안 매년 합격자 발표 철마다 연세대학교에서는 신입생의 신분을 사칭하는 사건이 발생해 논란이 일었습니다. 그런 사건을 미리 예방하고자 저희 17학년도 중앙새내기맞이단은 자체적으로 ‘합격자 인증 시스템’을 개발하여 운영하고 있습니다. </p>
        <p>아래 지시 사항에 따라 이름과 수험번호 등의 인증 정보를 기입하신 뒤 <mark>합격자 인증하기</mark> 버튼을 누르시면 자동으로 합격자 인증이 진행됩니다.</p>
        <br>
        <p style="margin-bottom: -15px"><em><strong>기입하신 정보는 안전하게 보관되며 인증 절차를 마친 후 완전히 폐기됩니다.</strong></em></p>
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
            <select class="form-control" name="type" required>
              <option value="0">특기자 전형</option>
              <option value="1">외국인 전형 (Int'l Students)</option>
              <option value="2">재외국민 전형 (예체능계열)</option>
              <option value="3">재외국민 전형 (일반)</option>
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
        <div class=" text-xs-center">
          <label class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" required>
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description">합격자 인증을 위한 개인정보 처리에 동의합니다.</span>
          </label>
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
        <p>이 페이지는 <a href="http://www.hyunjun.org">글로벌융합공학부 15 김현준</a>의 재능기부로 개발되었습니다.</p>
      </footer>
    </div>
  </body>
</html>