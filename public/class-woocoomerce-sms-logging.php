<?php

class Woocommerce_Sms_Log_Public {

    public static function _log($log, $order_id, $text, $data, $type){

    	if (true !== WP_DEBUG) {
    		return false;
    	}

    	$uploads = wp_upload_dir();
		$smsLogDir = $uploads['basedir']."/smsLogs";

    	if (!file_exists($smsLogDir)) {
		    mkdir( $smsLogDir , 0777, true);
		}else{
			
			$smsOrderLogDir = $smsLogDir."/orders";
			if (!file_exists($smsOrderLogDir)) {
			    mkdir( $smsOrderLogDir , 0777, true);
			}

			$smsLogrDir = $smsLogDir."/sms";			
			if (!file_exists($smsLogrDir)) {
			    mkdir( $smsLogrDir , 0777, true);
			}
		}

      	// Get current date to use in filename
      	$year = date('Y');
      	$month = date('m');
      	$day = date('d');
      	$date = date('d.m.Y');
      	$time = date('h:i:s A');

      	// Log stock checks data
      	if( $log == 'wc-order' ){
      		$file = $smsOrderLogDir . '/order-' . $order_id .'-'. $year . $month . $day . '.log';
      	}

      	if( $log == 'wc-test_sms' ){
      		$file = $smsLogrDir . '/sms-' .$year . $month . $day . '.log';
      	}


      	if($type == 'heading'){
      		
      		$heading = "---------------------------------------------------". "\n";
      		$heading .= "---------------------------------------".print_r($text, true)."---------------------". "\n";
      		$heading .= "------------------------------------------------------------------------------------". "\n";

	        $file = fopen($file, 'a');
	        fwrite($file, $date . ' ' . $time . ' | ' . $heading . "\n");
	        fclose($file);
      	}

      	if($type == 'closing'){
      		
      		$end = "---------------------------".print_r($text, true)."------------------------";

	        $file = fopen($file, 'a');
	        fwrite($file, $date . ' ' . $time . ' | ' . $end . "\n");
	        fclose($file);
      	}

  		if($type == 'formatting'){

	        $file = fopen($file, 'a');
	        fwrite($file, $date . ' ' . $time . ' | ' . $text . "\n");
	        fclose($file);
      	}

      	if($type == 'info'){

	        $file = fopen($file, 'a');
	        fwrite($file, $date . ' ' . $time . ' | ' . $text . "\n");
	        fclose($file);
      	}


      	if($type == 'data'){

	        $file = fopen($file, 'a');
	        fwrite($file, $date . ' ' . $time . ' | ' . $text . ": " . print_r($data, true) . "\n");
	        fclose($file);
      	}
    }
}