<?php 
class MY_Controller extends CI_Controller {
	private $_token;
	private $_url;
	
	function d($d, $dump = false){
		echo '<pre>';
		if($dump){var_dump($d);}else{print_r($d);}
		echo '</pre>';
	}
	
	public function __construct(){
		parent::__construct();
		$this->_token = 'bearer hNtMWKGUxLEEdZu*ulx.W(*JFi[/J6w!FC.*|dcOeq@yeGWhqEVyLS7z4OQdkVeYvecmstHIcSZJGw[d7}$$F[N\'^1f~Sno';
		$this->_url = 'http://203.210.85.102:6032/api/v2/ForCMSData';
	}
	
	public function getRequest($url, $params = []){
		$headers = array('Accept' => 'application/json',
						 'Authorization'=> $this->_token);
		$request = Requests::get("{$this->_url}/{$url}", $headers);
		return json_decode($request->body);
	}
	
	public function postRequest($url, $params = []){
		$headers = array('Accept' => 'application/json',
						 'Authorization'=> $this->_token);
		$request = Requests::post("{$this->_url}/{$url}", $headers); 
		return json_decode($request->body);
	}
}