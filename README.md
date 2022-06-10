เบื่ออัพเดต เบื่อค่าธรรมเนียมทรูแล้ว มาลองทางนี้บ้าง

ใหม่!! แอปแม่มณี QR รับเงิน - SCB
 || ชำระเงินผ่านการสแกน QR Code ใช้งานได้ทั้ง ธนาคาร และทรูวอลเล็ต
 
 # Example Maemanee Class
```php
<?php
  require "Class_manee.php";
    $mae = new MaeManee(
     "บัตรประชน", 
     "พิน", 
     "เบอร์โทร"
    );

    $row = $mae->RequestLoginOTP();
    //$row = $mae->SubmitLoginOTP("111834");
    
    print_r($row);
?>
```
