# PHP Simple Class for SMS-REG.com API
### UNOFFICIAL

https://sms-reg.com/docs/APImethods.html

- [x] Non-activation section methods usable now.
- [x] getBalance and setRate methods usable now.
- [ ] VirtualSiM methods not usable now.
- [ ] Orders methods not usable now.

```php
<?php
    /* require class */
    require "class.smsreg.php";

    $SmsReg = new SMSREG("YOUR API KEY HERE");

    $SmsReg->_debug(
        $SmsReg->getBalance() // it's returning account current balance
    );
?>
```
