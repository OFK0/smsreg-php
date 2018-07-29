<?php

error_reporting(E_ALL);

require "class.smsreg.php";

$SmsReg = new SMSREG("bqgjg85sc1esfj9fq77e3yurk4849pxf");

$SmsReg->_debug(
    $SmsReg->getOperations(10, "completed")
);