เบื่ออัพเดต เบื่อค่าธรรมเนียมทรูแล้ว มาลองทางนี้บ้าง ( เพื่อการศึกษา )

แอปแม่มณี QR รับชำระเงิน - SCB
 || ชำระเงินผ่านการสแกน QR Code ใช้งานได้ทั้ง ธนาคาร และทรูวอลเล็ต
 
 # Maemanee Class
- สำคัญมากๆจำเป็นต้อง Cronjob มาที่ access_data.php ตลอดเวลา เพื่อทำให้ อัพเดตข้อมูลการเติมเงินให้แก่ user !
- ไม่เหมาะกับร้านใหญ่ๆ วงเงินจำกัดที่ 100,000 / วัน
- https://truewallet.me/manee
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

# Example GetQrcode
```php
<?php
  require "Class_manee.php";
    $mae = new MaeManee(
     "บัตรประชน", 
     "พิน", 
     "เบอร์โทร"
    );

    $row = $mae->GetQrcode(
       $bill_id,
       $bill_ref1,
       $bill_ref3,
       $orderId,
       $amount
       );
?>

    <div class="text-center promptpay-box"><img style="display: block;-webkit-user-select: none;max-width: 100%;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="https://api.qrserver.com/v1/create-qr-code/?size=350x350&amp;data=<?= $row ?>">
    <br>
    <h6>** สแกน QR Code ด้วยแอพชำระเงิน **</h6>
    </div>
    
```
