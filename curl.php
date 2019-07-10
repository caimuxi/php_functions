<?php
/**
* Make an HTTP request
*/
function http($url, $method = 'GET', $postfields = NULL, $headers = array()) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		
		if(stripos($url,"https://") !== FALSE){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		}

		switch ($method) {
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, TRUE); 
				if (!empty($postfields)) {
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
				}
				break;
			case 'DELETE':
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
				if (!empty($postfields)) {
					$url = "{$url}?{$postfields}";
				}
				break;
		}
		
		curl_setopt($ch, CURLOPT_URL, $url);
		
		if(!empty($headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
		}
		$result =  curl_exec($ch);
		curl_close($ch);

		return $result;
}