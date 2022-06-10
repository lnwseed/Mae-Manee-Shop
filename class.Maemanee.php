<?php
class MaeManee
{
    private $idcard;
    private $pin;
    private $phone;
    public $curl_options = [
        CURLOPT_SSL_VERIFYPEER => true,
    ];
    public $api_gateway = "https://maemanee.truewallet.me/api/sys_manee.php";
    public function __construct(
        $manee_card = null,
        $mamee_pin = null,
        $manee_phone = null
    ) {
        $this->idcard = $manee_card;
        $this->pin = $mamee_pin;
        $this->phone = $manee_phone;
    }
    public function Connect($data = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api_gateway,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_code == 200 && ($result = json_decode($response, true))) {
            return $result;
        }
    }

    public function GetQrcode(
        $bill_id,
        $bill_ref1,
        $bill_ref3,
        $orderId,
        $amount
    ) {
        $postdata = [];
        $postdata["idcard"] = $this->idcard;
        $postdata["pin"] = $this->pin;
        $postdata["type"] = "Genqrcode";
        $postdata["qrbill_id"] = $bill_id;
        $postdata["qrbill_ref1"] = $bill_ref1;
        $postdata["qrbill_ref3"] = $bill_ref3;
        $postdata["qrbill_orderId"] = $orderId;
        $postdata["qrbill_amount"] = $amount;
        return $this->Connect($postdata);
    }

    public function RequestLoginOTP()
    {
        $postdata = [];
        $postdata["idcard"] = $this->idcard;
        $postdata["pin"] = $this->pin;
        $postdata["type"] = "OTPGet";
        $postdata["phone"] = $this->phone;
        return $this->Connect($postdata);
    }

    public function SubmitLoginOTP($otp_ref)
    {
        if (is_null($otp_ref)) return false; 
        $postdata = [];
        $postdata["idcard"] = $this->idcard;
        $postdata["pin"] = $this->pin;
        $postdata["type"] = "OPTSubmit";
        $postdata["otp_ref"] = $otp_ref;
        return $this->Connect($postdata);
    }

    public function GetBalance()
    {
        $postdata = [];
        $postdata["idcard"] = $this->idcard;
        $postdata["pin"] = $this->pin;
        $postdata["type"] = "Balance";
        return $this->Connect($postdata);
    }

    public function GetCreate($user_ref, $amount)
    {
        if (is_null($user_ref) || is_null($amount)) return false; 
        $postdata = [];
        $postdata["idcard"] = $this->idcard;
        $postdata["pin"] = $this->pin;
        $postdata["type"] = "BillCreate";
        $postdata["bill_ref"] = $user_ref;
        $postdata["bill_amount"] = $amount;
        return $this->Connect($postdata);
    }

    public function GetTransaction()
    {
        $postdata = [];
        $postdata["idcard"] = $this->idcard;
        $postdata["pin"] = $this->pin;
        $postdata["type"] = "BillTransaction";
        return $this->Connect($postdata);
    }

    public function GetSuccessill()
    {
        $postdata = [];
        $postdata["idcard"] = $this->idcard;
        $postdata["pin"] = $this->pin;
        $postdata["type"] = "SuccessBill";
        return $this->Connect($postdata);
    }
}
?> 
