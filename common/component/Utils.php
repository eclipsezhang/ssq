<?php

namespace common\component;

class Utils {

	// 格式化打印数据
	public static function dd($obj) {
		echo "<pre>";
		var_dump($obj);
		echo "</pre>";
	}

	// 获取访问者ip详细信息
	public static function getAddress() {
		$ip = $_SERVER["REMOTE_ADDR"];
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip;
        $option['url'] = $url;
        $ip = json_decode(self::http($option));   
        if ($ip) {
        	if ($ip->code == '1') {
	           return false;
	        }
        } else {
        	return false;
        }
        return $ip->data;
        self::dd($ip);
	}

	public static function http($option) {
		if (!isset($option['timeout'])) {
			$option['timeout'] = 5;
		}
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $option['url']);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_TIMEOUT, $option['timeout']);
	    $output = curl_exec($ch);
	    if($error=curl_error($ch)){
	        return $error;
	    }
	    curl_close($ch);
	    return $output;
	}

}