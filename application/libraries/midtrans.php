<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midtrans
{

    public function get_token($datas) {

        /*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
        composer require midtrans/midtrans-php
                                    
        Alternatively, if you are not using **Composer**, you can download midtrans-php library 
        (https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
        the file manually.   

        // require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */
        require_once dirname(__FILE__) . '../../../vendor/midtrans/midtrans-php/Midtrans.php';

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $datas['server_key'];
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = $datas['is_production'];
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $datas['order_id'],
                'gross_amount' => $datas['gross_amount'],
            ),
            'customer_details' => array(
                'first_name' => $datas['member_first_name'],
                'last_name' => $datas['member_last_name'],
                'email' => $datas['member_email'],
                'phone' => $datas['member_phone'],
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return $snapToken;
    }
}