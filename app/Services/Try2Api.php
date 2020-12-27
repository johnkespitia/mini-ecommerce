<?php

namespace Services;

class Try2Api {
	/**
   * API client version
   *
   * @var string
   */
	const VERSION = "2.0.6";
	
	/**
	 * @var string
	 */
	private $authKey = "HEDcdIco4FbBlviOB0fzsFP82JayagYHGgueQHzrR3g=";
	
	/**
	 * @var string
	 */
	private $requestKey = "Uo6KxOggs9Yq5gVK289MyA5u8hkrlp32FOIvRhigzkU=";
	
	/**
	 * @var array
	 */
	private $domains = array("try2services.vc", "try2services.cm", "try2services.pm", "try2checklm32oc3.onion");
	
	
	/**
	 * @var resource
	 */
	private $curl = null;
	
	/**
	 * Socks5 port of local Tor daemon (for requests to .onion domain)
	 *
	 * @var int
	 */
	private $tor_port = 9050;
	
	
	/**
	 * @var bool
	 */
	public $ready = false;
	
	/**
	 * @var int
	 */
	public $error_code = 0;
	
	/**
	 * @var string
	 */
	public $error = "";
	
	/**
	 * @var array
	 */
	public $responseData = array();
	
	
	/**
	 * Prepare cURL resource on construct
	 */
	public function __construct() {
		while (TRUE) {
			$success = $this->setupCurl();
			if (!$success) {
				$this->error_code = 1;
				$this->error = "curl setup error";
				break;
			}
			
			$this->ready = true;
			break;
		}
	}
	
	/**
	 * Encryption function
	 *
	 * @param string $str
	 * @param string $key
	 * @return string
	 */
	private function encrypt_xor($str, $key) {
		$key = strval($key);
		for($is=0;$is<strlen($str);$is++) {
			$str[$is] = chr(ord($str[$is]) ^ ord($key[$is % strlen($key)]));
		}
		return base64_encode($str);
	}
	
	/**
	 * Decryption function
	 *
	 * @param string $str
	 * @param string $key
	 * @return string
	 */
	private function decrypt_xor($str, $key) {
		$str = base64_decode($str);
		$key = strval($key);
		for($is=0;$is<strlen($str);$is++) {
			$str[$is] = chr(ord($str[$is]) ^ ord($key[$is % strlen($key)]));
		}
		return $str;
	}
	
	/**
	 * Initiate cURL resource
	 *
	 * @return bool
	 */
	private function setupCurl() {
		if ($this->curl)
			return true;
		
		if (!extension_loaded('curl'))
			return false;
        
		$this->curl = curl_init();
		if (!$this->curl)
			return false;
		
		$options = array(
			CURLOPT_FORBID_REUSE   => true,
			CURLOPT_FRESH_CONNECT  => true,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_TIMEOUT        => 7,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_BINARYTRANSFER => true,
			CURLOPT_HEADER         => false,
			CURLOPT_VERBOSE        => false,
			CURLOPT_NOPROGRESS     => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			
			CURLOPT_FAILONERROR    => false,
			CURLOPT_FOLLOWLOCATION => false,
			
			CURLOPT_POST           => true,
			CURLOPT_HTTPHEADER     => array("Content-Type: application/json; charset=utf-8",
																			"X-AuthKey: " . $this->authKey)
    );

    return curl_setopt_array($this->curl, $options);
	}
	
	/**
	 * Send data
	 *
	 * @param array $request
	 * @return bool
	 */
	public function send($request) {
		if (empty($request) || !is_array($request) || !isset($request["cmd"])) {
			$this->error_code = 2;
			$this->error = "invalid request";
			return false;
		}
		
		if (empty($this->domains) || !is_array($this->domains)) {
			$this->error_code = 3;
			$this->error = "invalid domains list";
			return false;
		}
		
		if (isset($request["data"]) && !empty($request["data"]))
			$request["data"] = $this->encrypt_xor(json_encode($request["data"]), base64_decode($this->requestKey));
		$response_raw = "";
		$send_success = false;
		$send_error = array();
		foreach ($this->domains as $domain) {
			
			/* Tor settings */
			if (strpos($domain, '.onion')) {
				curl_setopt_array($this->curl, array(
					CURLOPT_CONNECTTIMEOUT => 30,
					CURLOPT_TIMEOUT        => 60,
			    CURLOPT_PROXY     => "127.0.0.1",
			    CURLOPT_PROXYPORT => $this->tor_port
				));
				
				if (defined('CURLPROXY_SOCKS5_HOSTNAME')) {
					// PHP >= 5.5.23
					curl_setopt($this->curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5_HOSTNAME);
        } else {
        	$curl_version = curl_version();
        	if (version_compare($curl_version['version'], '7.18.0') < 0) {
        	    // curl version too low to even use socks5-hostname
        	    trigger_error(
        	        'cURL SOCKS5_HOSTNAME not supported. ' .
        	        'DNS names will *NOT* be resolved using Tor!',
        	        E_USER_WARNING
        	    );
        	    curl_setopt($this->curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        	} else {
        	    // curl supports socks5-hostname, PHP does not know about it yet
        	    // tested to work on PHP 5.5.9 with libcurl >= 7.18.0
        	    // php doesn't care what the proxytype is if it doesn't know about it
        	    curl_setopt($this->curl, CURLOPT_PROXYTYPE, 7);
        	}
        }
			}
			
			$link = 'https://' . $domain . '/api/gateway.php';
			curl_setopt_array($this->curl, array(
		    CURLOPT_URL            => $link,
		    CURLOPT_POSTFIELDS     => json_encode($request)
			));
			
			$curl_result = curl_exec($this->curl);
			if (!$curl_result) {
				$send_error[] = $domain."|empty|".curl_errno($this->curl)."|".curl_error($this->curl);
				continue;
			}
			
			$http_code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
			if ($http_code !== 200) {
				$send_error[] = $domain."|invalid|".$http_code;
				continue;
			}
			
			$response_raw = $curl_result;
			$send_success = true;
			break;
		}
		
		if (!$send_success) {
			$this->error_code = 4;
			$this->error = "curl send error: ".json_encode($send_error);
			return false;
		}
		
		$this->responseData = $this->parse($response_raw);
		if (!$this->responseData)
			return false;
		
		return true;
	}
	
	/**
	 * Parse received data
	 *
	 * @param string $response_raw
	 * @return bool|array
	 */
	private function parse($response_raw) {
		$response_arr = json_decode($response_raw, true);
		if (!$response_arr || !is_array($response_arr) || !isset($response_arr["success"])) {
			$this->error_code = 5;
			$this->error = "invalid response: ".$response_raw;
			return false;
		}
		if (!$response_arr["success"]) {
			$this->error_code = 6;
			$this->error = "bad response | message: ".$response_arr["message"] . (isset($response_arr["data"]) ? " | data: ". json_encode($response_arr["data"]) : "");
			return false;
		}
		
		if ($response_arr["success"] && !isset($response_arr["data"])) {
			$this->error_code = 7;
			$this->error = "invalid response: ".$response_raw;
			return false;
		}
		
		$responseData_json = $this->decrypt_xor($response_arr["data"], base64_decode($this->requestKey));
		$responseData = json_decode($responseData_json, true);
		if (!$responseData || !is_array($responseData)) {
			$this->error_code = 8;
			$this->error = "invalid response data: ".$response_raw;
			return false;
		}
		
		return array("rid" => (isset($response_arr["rid"]) ? $response_arr["rid"] : 0), "data" => $responseData);
	}
	
	/**
	 * Close cURL resource
	 */
	private function close_curl() {
		if ($this->curl) {
			curl_close($this->curl);
			$this->curl = null;
		}
	}
	
	/**
	 * Close cURL resource on destruct
	 */
	public function __destruct() {
		$this->close_curl();
	}
}
?>