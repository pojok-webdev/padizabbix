<?php
 //////////
 // GraphImgByID v1.1 
 // (c) Travis Mathis - travisdmathis@gmail.com
 // It's free use it however you want.
 // ChangeLog:
 // 1/23/12 - Added width and height to GetGraph Function
 // 23/7/13 - Zabbix 2.0 compatibility

 // ERROR REPORTING
 error_reporting(E_ALL);
 set_time_limit(1800);

 //CONFIGURATION
 $z_server = 'http://202.6.233.15/zabbix/';
 $z_user   = 'puji';
 $z_pass   = 'pujicute2016';
 $z_img_path    = "/usr/local/share/zabbix/custom_pages/tmp_images/";

 //NON CONFIGURABLE
 $z_tmp_cookies = "";
 $z_url_index   = $z_server ."index.php";
 $z_url_graph   = $z_server ."chart2.php";
 $z_url_api     = $z_server ."api_jsonrpc.php";
 
 // Zabbix 1.8
 // $z_login_data  = "name=" .$z_user ."&password=" .$z_pass ."&enter=Enter";
 
 // Zabbix 2.0
 $z_login_data  = array('name' => $z_user, 'password' => $z_pass, 'enter' => "Sign in");
//$z_login_data = "name=" .$z_user ."&password=" .$z_pass ."&enter=Sign in&autologin=1&request=";
 // FUNCTION
 function GraphImageById ($graphid, $period = 3600, $width, $height) { global $z_server, $z_user, $z_pass, $z_tmp_cookies, $z_url_index, $z_url_graph, $z_url_api, $z_img_path,   $z_login_data;
        // file names
        $filename_cookie = $z_tmp_cookies ."zabbix_cookie_" .$graphid .".txt";
        $image_name = $z_img_path ."zabbix_graph_" .$graphid .".png";

        //setup curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $z_url_index);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $z_login_data);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $filename_cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $filename_cookie);
        // login
        curl_exec($ch);
        // get graph
        curl_setopt($ch, CURLOPT_URL, $z_url_graph ."?graphid=" .$graphid ."&width=" .$width ."&height=" .$height ."&period=" .$period);
        $output = curl_exec($ch);
        curl_close($ch);
        // delete cookie
        header("Content-type: image/png");
        unlink($filename_cookie);
        $fp = fopen($image_name, 'w');
        fwrite($fp, $output);
        fclose($fp);
        header("Content-type: text/html");
}
/************************/

GraphImageById(1298,3600,500,500);
//GraphImageById('1550','3600','500','500');
