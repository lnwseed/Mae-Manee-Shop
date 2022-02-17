<?php	
    class MaeManee { 
        private $Idard;
        private $Passkey;		
		public $curl_options = array(
			CURLOPT_SSL_VERIFYPEER => false //lnwseed
		);
		public $api_gateway = "https://manee.3ird.online/Gateway/";
        public function __construct($Idard = null, $Passkey = null) {
            $this->Idard = $Idard;
            $this->Passkey = $Passkey;
		}
		public function request ($api_path, $headers = array(), $data = null) {
			$this->data = null;
			$handle = curl_init($this->api_gateway.ltrim($api_path, "/"));
			if (!is_null($data)) {
				curl_setopt_array($handle, array(
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => is_array($data) ? json_encode($data) : $data
				));
				if (is_array($data)) $headers = array_merge(array("Content-Type" => "application/json"), $headers);
			}
			curl_setopt_array($handle, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERAGENT => "okhttp/3.8.0",
			CURLOPT_HTTPHEADER => $this->buildHeaders($headers)
			));
			if (is_array($this->curl_options)) curl_setopt_array($handle, $this->curl_options);
			$this->response = curl_exec($handle);
			$this->http_code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
			if ($result = json_decode($this->response, true)) {
			//if ($result = $this->response) {
				if (isset($result["data"])) $this->data = $result["data"];
				return $result;
			}
			return $this->response;
		}	
		public function buildHeaders ($array) {
			$headers = array();
			foreach ($array as $key => $value) {
				$headers[] = $key.": ".$value;
			}
			return $headers;
		}	

		public function GetSignin() {
			if (is_null($this->Passkey) || is_null($this->Idard)) return false; 
			return $this->request("GetSignin/".$this->Idard);
		}	
		
		public function RequestLoginOTP() {
			if (is_null($this->Passkey) || is_null($this->Idard)) return false; 
			return $this->request("OTPGet/".$this->Idard);
		}	

		public function SubmitLoginOTP($otp) {
			if (is_null($this->Passkey) || is_null($this->Idard) || is_null($otp)) return false; 
			return $this->request("OPTSubmit/".$this->Idard."/".$otp);
		}	

		public function CheckToken() {
			if (is_null($this->Passkey) || is_null($this->Idard)) return false; 
			return $this->request("CheckToken/".$this->Idard);
		}	

		public function RefreshToken() {
			if (is_null($this->Passkey) || is_null($this->Idard)) return false; 
			return $this->request("RefreshToken/".$this->Idard);
		}					
						
		public function Logout() {
			if (is_null($this->Passkey) || is_null($this->Idard)) return false; 
			return $this->request("Logout/".$this->Idard);
		}
		
		public function Transaction() {
			if (is_null($this->Passkey) || is_null($this->Idard)) return false; 
			return $this->request("BillTransaction/".$this->Idard);
		}

		public function Create($ref, $amount) {
			if (is_null($this->Passkey) || is_null($this->Idard) || is_null($ref) || is_null($amount)) return false; 
			return $this->request("BillCreate/".$this->Idard."/".$ref."/".$amount);
		}		

		public function ImgCode($orderId, $amount) {
			if (is_null($this->Passkey) || is_null($this->Idard) || is_null($orderId) || is_null($amount))) return false; 
			return $this->request("Qrgen/".$this->Idard."/".$orderId."/".$amount);
		}											
	}

?>
