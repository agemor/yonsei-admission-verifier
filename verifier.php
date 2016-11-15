<?php

const READY = 0;
const ERROR = 1;
const SUCCESS = 2;

$admissionType = array(
    'Science' => "https://www2.yonsei.ac.kr/entrance/2017/susi/pass_1st_CABCBDBF/pass_ok.asp",
    'ForeignArt' => "https://www2.yonsei.ac.kr/entrance/2017/jfore/jfore_2017_3_art/pass.asp"
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

    $checkResult = admissionCheck($admissionType['Science'], $student['name'], $student['id'], $student['birthdate']);
    if (!$checkResult) {
        $response = ERROR;
        $responseMessage = "합격자 정보를 찾을 수 없습니다. 입력된 정보를 다시 확인해 주세요.";
    }
    else {
        $response = SUCCESS;
        $responseMessage = "합격자 인증이 완료되었습니다.";
    }
}

?>
