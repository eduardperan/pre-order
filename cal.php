<?php
date_default_timezone_set("Asia/Manila");
if (date('H:i:s') > date('H:i:s', mktime(23, 30, 0, date('m'), date('d'), date('Y')))) {
    echo json_encode(true);
}else{
    echo json_encode(false);
}

// echo date('H:i:s') . "<br>";
// echo date('H:i:s', mktime(23, 30, 0, date('m'), date('d'), date('Y')));