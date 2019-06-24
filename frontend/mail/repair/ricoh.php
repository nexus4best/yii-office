<?php
use yii\web\Session;
$session = Yii::$app->session;
$data_email = $session->get('data_email');
foreach ($data_email as $key => $value) {
    echo $value->BrnSerial.' ติดต่อธานี:0815830733 '.$value->BrnCause.' '.$value->BrnCode.' '.$value->branch->BrnName.'<br>';
}
$session->remove('data_email');
?>