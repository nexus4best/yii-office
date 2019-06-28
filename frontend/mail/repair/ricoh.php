<?php
use yii\web\Session;
$session = Yii::$app->session;
$data_email = $session->get('data_email');
foreach ($data_email as $key => $value) {

    if($value->zone->CtsId == 5){
        $cts = 'ติดต่อธานี:0815830733';
    }elseif($value->zone->CtsId == 4){
        $cts = 'ติดต่อกิตติ:0917705663';
    }elseif($value->zone->CtsId == 3){
        $cts = 'ติดต่อขวัท:0917705662';
    }elseif($value->zone->CtsId == 2){
        $cts = 'ติดต่อณัฐวุฒิ:0811995024';
    }elseif($value->zone->CtsId == 1){
        $cts = 'ติดต่อราชศักดิ์:0917705661';
    }

    echo '<b>'.$value->BrnSerial.' </b> '.$cts.' '.$value->BrnCause.' '.$value->BrnCode.' '.$value->branch->BrnName.'<br>';
}
$session->remove('data_email');
?>
<br><br><br>
ขอบคุณครับ