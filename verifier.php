<?php

include "module.db.php";

const READY = 0;
const ERROR = 1;
const SUCCESS = 2;

$admissionType = array(
    '0' => "https://www2.yonsei.ac.kr/entrance/2017/susi/pass_last_1st/pass_ok.asp", // 수시모집 전 전형
    '1' => "https://www2.yonsei.ac.kr/entrance/2017/fore/fore_2017_3/pass_ok.asp", // 외국인 전형 (예체능계열)
    '2' => "https://www2.yonsei.ac.kr/entrance/2017/jfore/jfore_2017_3_art/pass_ok.asp", // 재외국민 전형 (예체능계열)
    '3' => "https://www2.yonsei.ac.kr/entrance/2017/jfore/jfore_2017_3_final/pass_ok.asp", // 재외국민 전형 (일반)
    '4' => "https://www2.yonsei.ac.kr/entrance//2017/jfore/jfore_2017_3_gld/pass_ok.asp", // 재외국민 전형 (일반)
    '5' => "https://www2.yonsei.ac.kr/entrance/2017/jungsi/pass_last/pass_ok.asp" // 정시모집 전 전형
);

function admissionCheck($url, $name, $id, $birthdate)
{
    $data = array(
        'Name' => $name,
        'Suhumno' => $id,
        'Birthdate' => $birthdate
    );
    $defaults = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data) ,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false
    );
    $ch = curl_init();
    curl_setopt_array($ch, $defaults);
    $result = curl_exec($ch);
   // var_dump($result);
    curl_close($ch);
    return strpos($result, "축하합니다") !== false;;
}

$response = READY;
$responseMessage = "";
$student = array(
    'name' => "",
    'id' => "",
    'birthdate' => "",
    'type' => "",
    'email' => ""
);

if (!empty($_POST["name"])) {
    $student = array(
        'name' => stripslashes($_POST["name"]) ,
        'id' => $_POST["id"],
        'birthdate' => $_POST["birthdate"],
        'type' => $_POST["type"],
        'email' => $_POST["email"]
    );

    if ($response != ERROR && empty($student['name']) || empty($student['id']) || empty($student['birthdate']) || empty($student['type']) || empty($student['email'])) {
        $response = ERROR;
        $responseMessage = "전송된 정보가 올바르지 않습니다.";
    }

    if ($response != ERROR && strlen($student['email']) > 200) {
        $response = ERROR;
        $responseMessage = "이메일 주소가 너무 깁니다.";
    }

    $checkResult = admissionCheck($admissionType[$student['type']], $student['name'], $student['id'], $student['birthdate']);
    if (!$checkResult) {
        $response = ERROR;
        $responseMessage = "합격자 정보를 찾을 수 없습니다. 입력된 정보를 다시 확인해 주세요.";
    }
    else {


        // 이미 리스트에 있는지 체크
        $reply = $module->db->in('yonsei_admission_verification')
                               ->select('email')
                               ->where('application_no', '=', $student["id"])
                               ->goAndGet();

        // 이미 인증된 계정
        if ($reply) {
            // 이메일 주소 보여주기
            $response = SUCCESS;
            $responseMessage = "이미 인증된 정보입니다. ".$reply["email"]."로 커뮤니티 가입 관련 메일이 발송될 예정입니다.";
            return;
        } 


        // 새로 인증하는 계정
        else {
            $reply = $module->db->in('yonsei_admission_verification')
                           ->insert('name', base64_encode($student['name']))
                           ->insert('application_no', $student['id'])
                           ->insert('birthdate', $student['birthdate'])
                           ->insert('email', $student['email'])
                           ->go();
            if ($reply) {
                $response = SUCCESS;
                $responseMessage = "합격자 인증이 완료되었습니다.";
            } else {
                $response = ERROR;
                $responseMessage = "서버 에러가 발생하였습니다.";
            }
        }

    }
}

?>
