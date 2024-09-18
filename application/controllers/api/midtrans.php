<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Midtrans extends FSD_Controller 
{
    public function __construct() {
        parent::__construct();
        $this->load->model('credit_model');
    }

    public function index()
	{

        $res = json_decode(file_get_contents('php://input'), true);

        // Validasi data
        if (!isset($res['order_id']) || !isset($res['status_code'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data']);
            exit;
        }

        if($res['status_code'] == 201 || $res['status_code'] == 200) {
            if($res['transaction_status'] == 'settlement') {

                $this->db->trans_start();

                $result_sql = $this->db->query("SELECT `value` FROM app_settings WHERE `key` = 'idr'");
                $idr = $result_sql->row()->value;

                // update data
                $updt['TransactionDateTime']   = date("Y-m-d H:i:s");
                $updt['TransactionStatus']     = $res['transaction_status'];
                $result = $this->db->update('midtrans_transaction', $updt, array('OrderID' => $res['order_id']));

                // insert amount
                $explode = explode('|', $res['order_id']);
                $transaction_id = 1 + $this->credit_model->get_max_transaction_id(array('TransactionCode' => CASH_PAYMENT_RECEIVED));
                
                $ins['MemberID']          = $explode[1];
                $ins['TransactionCode']   = CASH_PAYMENT_RECEIVED;
                $ins['TransactionID']     = $transaction_id;
                $ins['Description']       = "Added By Midtrans";
                $ins['Amount']            = $res['gross_amount'] / $idr;
                $ins['CreatedDateTime']   = date("Y-m-d H:i:s");
                $result_insert = $this->db->insert('gsm_credits', $ins);

                if ($result && $result_insert && $idr) {
                    $this->db->trans_complete();
                    echo json_encode(['message' => 'Payment data updated successfully']);
                } else {
                    $this->db->trans_rollback();
                    echo json_encode(['message' => 'Payment data failed']);
                }
            } else {

                $explode = explode('|', $res['order_id']);

                $ins['MemberID']          = $explode[1];
                $ins['TransactionCode']   = CASH_PAYMENT_RECEIVED;
                $ins['OrderID']           = $res['order_id'];
                $ins['Description']       = "Added By Midtrans";
                $ins['Amount']            = $res['gross_amount'];
                $ins['CreatedDateTime']   = date("Y-m-d H:i:s");
                $ins['TransactionStatus'] = $res['transaction_status'];

                $result = $this->db->insert('midtrans_transaction', $ins);

                echo json_encode(['message' => 'Payment data inserted successfully']);

            }
        }else{
            echo json_encode(['message' => 'Payment data failed']);
        }
    }
}