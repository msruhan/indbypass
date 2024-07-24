<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends FSD_Controller 
{
    var $before_filter = array('name' => 'get_settings', 'except' => array());
    var $api_version;

	public function __construct()
	{
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('imeiorder_model');
		$this->load->model('method_model');
        $this->load->model('credit_model');
        $this->load->model('servicemodel_model');
        $this->load->model('brand_model');
        $this->api_version = '2.3.1';
	}
	
	public function index()
	{
        $post = $this->input->post(NULL,TRUE);
        //Set Variables
        $email = $post['username'];
        $api_access_key = $post['apiaccesskey'];
        $request_format = $post['requestformat'];
        $action = $post['action'];
        $ip = $this->input->ip_address();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        //data variable
        if( isset($post['parameters']) )
        {
            $parameters = $this->XMLtoARRAY($post['parameters']);
            $parameters = $parameters['PARAMETERS'];
        }

        $member = $this->member_model->get_where([
            'Status' => 'Enabled',
            'Email' => $email,
            'ApiStatus' => 'Enabled',
            'ApiKey' => $api_access_key
        ]);

        ## If IP not binded then bind Server IP##
        if( count($member) < 1 )
            $this->dhuru_error('Authentication Failed');

        $member = $member[0];
        if( empty($member['ServerIP']) )
            $this->member_model->update_server_ip($ip, $email);
        elseif( $member['ServerIP'] != $ip )
            $this->dhuru_error('Authentication Failed');
        
        $member_id = $member['ID'];
        $email = $member['Email'];
        switch ($action)
        {
            case 'accountinfo':
                $result = $this->accountinfo($member_id, $email);
                break;
            case 'imeiservicelist':
                $result = $this->imeiservicelist($member_id);
                break;
            case 'modellist':
                ## Required field validation
                if(!isset($parameters['ID']) || empty($parameters['ID']))
                {
                    $this->dhuru_error('Parameter \'ID\' Required');
                }
                else
                {
                    $id = intval($parameters['ID']);
                    $result = $this->modellist($id);
                }
                break;
            case 'getimeiservicedetails':
                ## Required field validation
                if(!isset($parameters['ID']) || empty($parameters['ID']))
                {
                    $this->dhuru_error('Parameter \'ID\' Required');
                }
                else
                {
                    $method_id = intval($parameters['ID']);                    
                    $result = $this->getimeiservicedetails($member_id, $method_id, $email);   
                }
                break;
            case 'placeimeiorder':
                ## Required field validation
                if(!isset($parameters['ID']) || empty($parameters['ID']))
                {
                    $this->dhuru_error('Parameter \'ID\' Required');
                }
                else
                {
                    $method_id = intval($parameters['ID']);                               
                    $result = $this->placeimeiorder($member_id, $method_id, $parameters);   
                }
                break;
            case 'getimeiorder':
                ## Required field validation
                if(!isset($parameters['ID']) || empty($parameters['ID']))
                {
                    $this->dhuru_error('Parameter \'ID\' Required');
                }
                else
                {
                    $imei_order_id = intval($parameters['ID']);                    
                    $result = $this->getimeiorder($member_id, $imei_order_id);
                }
                break;
            case 'providerlist': //Todo:
                ## Required field validation
                if(!isset($parameters['ID']) || empty($parameters['ID']))
                {
                    $this->dhuru_error('Parameter \'ID\' Required');
                }
                else
                {
                    $method_id = intval($parameters['ID']);                    
                    $result = $this->providerlist($method_id);
                }
                break;
            case 'meplist': //Todo:
                ## Required field validation
                if(!isset($parameters['ID']) || empty($parameters['ID']))
                {
                    $this->dhuru_error('Parameter \'ID\' Required');
                }
                else
                {
                    $method_id = intval($parameters['ID']);                    
                    $result = $this->meplist($method_id);
                }
                break;
            default:
                $this->dhuru_error('Invalid access.');
        }
        echo json_encode($result);
    }

    private function accountinfo($member_id, $email)
    {
        $data = [];
        $credit = $this->credit_model->get_credit($member_id);   
        $data['SUCCESS'][0]['message'] = 'Your Accout Info';
        $data['SUCCESS'][0]['AccoutInfo'] = array('credit' => $credit, 'mail' => $email, 'currency' => $this->settings['app_currency']);
        $data['apiversion'] = $this->api_version;
        return $data;
    }

    private function imeiservicelist($member_id)
    {
        $data = [];
        $data['SUCCESS'][0] = array('MESSAGE' => 'IMEI Service List', 'LIST' => []);
        $data['apiversion'] = $this->api_version;
        $result = $this->member_model->get_imei_service_list($member_id);
        foreach ($result as $n) 
        {
            $networks = [];
            $title = $n['Title'];
            $data['SUCCESS'][0]['LIST'][$title]['GROUPNAME'] = $title;
            foreach ($n['methods'] as $m) 
            {
                $method_id = $m['MethodID'];
                $networks[$method_id]['SERVICEID'] = $method_id;
                $networks[$method_id]['SERVICENAME'] = $m['Title'];
                $networks[$method_id]['CREDIT'] = $m['Price'];
                $networks[$method_id]['TIME'] = $m['DeliveryTime'];
                $networks[$method_id]['INFO'] = '';//$m['description'];
                $networks[$method_id]['Requires.Network'] = $m['Network'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.Mobile'] = $m['Mobile'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.Provider'] = $m['Provider'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.PIN'] = $m['PIN'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.KBH'] = $m['KBH'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.MEP'] = $m['MEP'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.PRD'] = $m['PRD'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.Type'] = $m['Type'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.Locks'] = $m['Locks'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.Reference'] = $m['Reference'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.SN'] = $m['SerialNumber'] == 1? 'Required' : 'None';
                $networks[$method_id]['Requires.SecRO'] = 'None';

                ## Exclusive Unlock Fields ##
                $networks[$method_id]['ExtraInformation'] = $m['ExtraInformation'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudCarrierInfo'] = $m['iCloudCarrierInfo'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudAppleIDHint'] = $m['iCloudAppleIDHint'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudActivationLockScreenshot'] = $m['iCloudActivationLockScreenshot'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudIMEINumberScreenshot'] = $m['iCloudIMEINumberScreenshot'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudAppleIdEmail'] = $m['iCloudAppleIdEmail'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudAppleIdScreenshot'] = $m['iCloudAppleIdScreenshot'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudAppleIdInfo'] = $m['iCloudAppleIdInfo'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudPhoneNumber'] = $m['iCloudPhoneNumber'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudID'] = $m['iCloudID'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudPassword'] = $m['iCloudPassword'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudUDID'] = $m['iCloudUDID'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudICCID'] = $m['iCloudICCID'] == 1? 'Required':'None';
                $networks[$method_id]['iCloudVideo'] = $m['iCloudVideo'] == 1? 'Required':'None';
            }
            $data['SUCCESS'][0]['LIST'][$title]['SERVICES'] = $networks;
        }
        return $data;
    }
    
    private function modellist($method_id)
    {
        $data = [];
        $data['SUCCESS'][0] = array('MESSAGE' => 'Brands and Models List for :', 'LIST' => []);
        $data['apiversion'] = $this->api_version;
        $models = $this->brand_model->get_model_by_method_id($method_id);
        foreach ($result as $k => $b) 
        {
            $models = [];
            $data['SUCCESS'][0]['LIST'][$k]['ID'] = $b['ID'];
            $data['SUCCESS'][0]['LIST'][$k]['NAME'] = $b['Title'];

            foreach ($b['models'] as $m) 
            {
                $models[] = [
                    'ID' => $m['ModelID'],
                    'Name' => $m['Title']
                ];
            }
            $data['SUCCESS'][0]['LIST'][$k]['MODELS'] = $models;
        }
        return $data;
    }

    private function getimeiservicedetails($member_id, $method_id, $username)
    {
        $data = array();

        $methods = $this->method_model->get_member_method_by_id($member_id, $method_id);
        $data['ID'] = $method_id;
        if(!empty($methods))
        {
            $m = $methods[0];
            $data['SUCCESS'][0]['MESSAGE'] = 'Service Details';
            $data['SUCCESS'][0]['LIST']['username'] = $username;
            $data['SUCCESS'][0]['LIST']['service_name'] = $m['Title'];
            $data['SUCCESS'][0]['LIST']['retail_name'] = $m['Title'];
            $data['SUCCESS'][0]['LIST']['credit_admin'] = $m['Price'];
            $data['SUCCESS'][0]['LIST']['credit'] = $m['Price'];
            $data['SUCCESS'][0]['LIST']['discount_admin'] = 0;
            $data['SUCCESS'][0]['LIST']['discount'] = 0;
            $data['SUCCESS'][0]['LIST']['cartdiscount'] = 0;
            $data['SUCCESS'][0]['LIST']['retail_credit'] = $m['Price'];
            $data['SUCCESS'][0]['LIST']['seourl'] = '';
            $data['SUCCESS'][0]['LIST']['seourl2'] = '';
            $data['SUCCESS'][0]['LIST']['id'] = $method_id;
            $data['SUCCESS'][0]['LIST']['manualverification'] = 0;
            $data['SUCCESS'][0]['LIST']['affiliate_comission'] = 0;
            $data['SUCCESS'][0]['LIST']['sort'] = $method_id;
            $data['SUCCESS'][0]['LIST']['time'] = $m['DeliveryTime'];
            $data['SUCCESS'][0]['LIST']['isalpha'] = 0;
            $data['SUCCESS'][0]['LIST']['review'] = 0;
            $data['SUCCESS'][0]['LIST']['autoreply'] = 0;
            $data['SUCCESS'][0]['LIST']['seo_title'] = '';
            $data['SUCCESS'][0]['LIST']['seo_description'] = '';
            $data['SUCCESS'][0]['LIST']['status'] = 1;
            $data['SUCCESS'][0]['LIST']['ebay_code'] = '';
            $data['SUCCESS'][0]['LIST']['API'] = '';
            $data['SUCCESS'][0]['LIST']['seo_keywords'] = '';
            $data['SUCCESS'][0]['LIST']['store'] = 0;
            $data['SUCCESS'][0]['LIST']['resellerdisctype'] = 0;
            $data['SUCCESS'][0]['LIST']['resellerdisc'] = '';
            $data['SUCCESS'][0]['LIST']['resellersprice'] = $m['Price'];
            $data['SUCCESS'][0]['LIST']['key_selling'] = '';
            $data['SUCCESS'][0]['LIST']['smsnotification'] = 0;
            $data['SUCCESS'][0]['LIST']['notificationemail'] = 0;
            $data['SUCCESS'][0]['LIST']['subscribe_credit'] = '';
            $data['SUCCESS'][0]['LIST']['subscribe_days'] = '';
            $data['SUCCESS'][0]['LIST']['subscribe'] = 0;
            $data['SUCCESS'][0]['LIST']['verification'] = 0;
            $data['SUCCESS'][0]['LIST']['usercan_cancel'] = 1;
            $data['SUCCESS'][0]['LIST']['icon_link'] = '';
            $data['SUCCESS'][0]['LIST']['download_link'] = '';
            $data['SUCCESS'][0]['LIST']['faq_id'] = '';
            $data['SUCCESS'][0]['LIST']['retail'] = 0;
            $data['SUCCESS'][0]['LIST']['image_link'] = '';
            $data['SUCCESS'][0]['LIST']['image_hotdeal'] = '';
            $data['SUCCESS'][0]['LIST']['purchase_cost'] = '';
            $data['SUCCESS'][0]['LIST']['stock'] = '';
            $data['SUCCESS'][0]['LIST']['stock_allow'] = 0;
            $data['SUCCESS'][0]['LIST']['retail_info'] = '';
            $data['SUCCESS'][0]['LIST']['assigned_model'] = '';
            $data['SUCCESS'][0]['LIST']['assigned_provider'] = '';
            $data['SUCCESS'][0]['LIST']['imei_custom_len'] = 0;
            $data['SUCCESS'][0]['LIST']['imei_custom'] = 0;
            $data['SUCCESS'][0]['LIST']['imei_custom_name'] = '';
            $data['SUCCESS'][0]['LIST']['imei_custom_info'] = '';
            $data['SUCCESS'][0]['LIST']['imei_bulk'] = 1;
            $data['SUCCESS'][0]['LIST']['group_id'] = 1;
            $data['SUCCESS'][0]['LIST']['group'] = 1;
            $data['SUCCESS'][0]['LIST']['customhtml'] = '';
            $data['SUCCESS'][0]['LIST']['happy_hours_start'] = '';
            $data['SUCCESS'][0]['LIST']['happy_hours_end'] = '';
            $data['SUCCESS'][0]['LIST']['happy_hours_repetation'] = '';
            $data['SUCCESS'][0]['LIST']['happy_hours_weekdays'] = '';
            $data['SUCCESS'][0]['LIST']['promotiondis'] = '';
            $data['SUCCESS'][0]['LIST']['verifiable'] = 0;
            $data['SUCCESS'][0]['LIST']['info'] = '';
            $data['SUCCESS'][0]['LIST']['hot'] = '';
            $data['SUCCESS'][0]['LIST']['features'] = '';
            $data['SUCCESS'][0]['LIST']['taxed'] = 0;
            $data['SUCCESS'][0]['LIST']['show_onhome'] = 0;
            $data['SUCCESS'][0]['LIST']['template_id1'] = 0;
            $data['SUCCESS'][0]['LIST']['template_id2'] = 0;
            $data['SUCCESS'][0]['LIST']['subscriptionorderlimit'] = 0;
            $data['SUCCESS'][0]['LIST']['listing'] = 'fusion10';
            $data['SUCCESS'][0]['LIST']['reqredfield']['network'] = ($m['Network'] == 1? 'Required' : 'None');
            $data['SUCCESS'][0]['LIST']['reqredfield']['model'] = ($m['Mobile'] == 1? 'Required' : 'None');
            $data['SUCCESS'][0]['LIST']['reqredfield']['provider'] = ($m['Provider'] == 1? 'Required' : 'None');
            $data['SUCCESS'][0]['LIST']['reqredfield']['mep'] = ($m['MEP'] == 1? 'Required' : 'None');
            $data['SUCCESS'][0]['LIST']['reqredfield']['PIN'] = ($m['PIN'] == 1? 'Required' : 'None');
            $data['SUCCESS'][0]['LIST']['reqredfield']['KBH'] = ($m['KBH'] == 1? 'Required' : 'None');
            $data['SUCCESS'][0]['LIST']['reqredfield']['PRD'] = ($m['PRD'] == 1? 'Required' : 'None');
            $data['SUCCESS'][0]['LIST']['reqredfield']['SN'] = ($m['SerialNumber'] == 1? 'Required' : 'None');
            $data['SUCCESS'][0]['LIST']['reqredfield']['SecRO'] = 'None';
            $data['SUCCESS'][0]['LIST']['reqredfield']['isalpha'] = 0;
            $data['SUCCESS'][0]['LIST']['reqredfield']['type'] = 0;
            $data['SUCCESS'][0]['LIST']['reqredfield']['reference'] = 0;
            $data['SUCCESS'][0]['LIST']['reqredfield']['locks'] = 0;
            $data['SUCCESS'][0]['LIST']['reqredfield']['imei_single'] = 1;
            $data['SUCCESS'][0]['LIST']['reqredfield']['imei_bulk'] = 1;
            $data['SUCCESS'][0]['LIST']['reqredfield']['imei_custom'] = 0;
            $data['SUCCESS'][0]['LIST']['reqredfield']['imei_custom_len'] = 0;
            $data['SUCCESS'][0]['LIST']['reqredfield']['imei_custom_name'] = '';
            $data['SUCCESS'][0]['LIST']['reqredfield']['imei_custom_info'] = '';
            $data['SUCCESS'][0]['LIST']['notification_mail'] = '';
            $data['apiversion'] = $this->api_version;
        } else {
            $data['ERROR'][0]['MESSAGE'] = 'NoResultFound';
        }
        return $data;
    }

    private function placeimeiorder($member_id, $method_id, $params)
    {
        $data = [];
        $methods = $this->method_model->get_member_method_by_id($member_id, $method_id);
        if( empty($methods) )
        {
            $data['ID'] = $method_id;
            $data['IMEI'] = $params['IMEI'];
            $data['ERROR'][0]['MESSAGE'] = 'Service Not Active';
        }
        else
        {
            $m = $methods[0];
            ## Required Field Validation
            ## IMEI
            if(!isset($params['IMEI']) || empty($params['IMEI']) || strlen($params['IMEI']) <15)
                $this->dhuru_error('Parameter \'IMEI\' Required');

            ## Network ID
            if($m['Network'] == '1' && (!isset($params['NETWORKID']) || empty($params['NETWORKID'])))
                $this->dhuru_error('Parameter \'NETWORKID\' Required');

            ## Provider ID
            if($m['Provider'] == '1' && (!isset($params['PROVIDERID']) || empty($params['PROVIDERID'])))
                $this->dhuru_error('Parameter \'PROVIDERID\' Required');

            ## Model
            if($m['Mobile'] == '1' && (!isset($params['MODELID']) || empty($params['MODELID'])))
                $this->dhuru_error('Parameter \'MODELID\' Required');

            ## Serial Number
            if($m['SerialNumber'] == '1' && (!isset($params['SN']) || empty($params['SN'])))
                $this->dhuru_error('Parameter \'SN\' Required');

            ## KBH
            if($m['KBH'] == '1' && (!isset($params['KBH']) || empty($params['KBH'])))
                $this->dhuru_error('Parameter \'KBH\' Required');

            ## PIN
            if($m['PIN'] == '1' && (!isset($params['PIN']) || empty($params['PIN'])))
                $this->dhuru_error('Parameter \'PIN\' Required');
            
            ## MEP
            if($m['MEP'] == '1' && (!isset($params['MEP']) || empty($params['MEP'])))
            $this->dhuru_error('Parameter \'MEP\' Required');

            ## PRD
            if($m['PRD'] == '1' && (!isset($params['PRD']) || empty($params['PRD'])))
                $this->dhuru_error('Parameter \'PRD\' Required');

            ## Type
            if($m['Type'] == '1' && (!isset($params['TYPE']) || empty($params['TYPE'])))
                $this->dhuru_error('Parameter \'TYPE\' Required');
            
            ## Locks
            if($m['Locks'] == '1' && (!isset($params['LOCKS']) || empty($params['LOCKS'])))
                $this->dhuru_error('Parameter \'LOCKS\' Required');

            ## Reference
            if($m['Reference'] == '1' && (!isset($params['REFERENCE']) || empty($params['REFERENCE'])))
                $this->dhuru_error('Parameter \'REFERENCE\' Required');

            ## ExtraInformation
            if($m['ExtraInformation'] == '1' && (!isset($params['ExtraInformation']) || empty($params['ExtraInformation'])))
                $this->dhuru_error('Parameter \'ExtraInformation\' Required');

            ## iCloudCarrierInfo
            if($m['iCloudCarrierInfo'] == '1' && (!isset($params['iCloudCarrierInfo']) || empty($params['iCloudCarrierInfo'])))
                $this->dhuru_error('Parameter \'iCloudCarrierInfo\' Required');

            ## iCloudAppleIDHint
            if($m['iCloudAppleIDHint'] == '1' && (!isset($params['iCloudAppleIDHint']) || empty($params['iCloudAppleIDHint'])))
                $this->dhuru_error('Parameter \'iCloudAppleIDHint\' Required');

            ## iCloudActivationLockScreenshot
            if($m['iCloudActivationLockScreenshot'] == '1' && (!isset($params['iCloudActivationLockScreenshot']) || empty($params['iCloudActivationLockScreenshot'])))
                $this->dhuru_error('Parameter \'iCloudActivationLockScreenshot\' Required');

            ## iCloudIMEINumberScreenshot
            if($m['iCloudIMEINumberScreenshot'] == '1' && (!isset($params['iCloudIMEINumberScreenshot']) || empty($params['iCloudIMEINumberScreenshot'])))
                $this->dhuru_error('Parameter \'iCloudIMEINumberScreenshot\' Required');

            ## iCloudAppleIdEmail
            if($m['iCloudAppleIdEmail'] == '1' && (!isset($params['iCloudAppleIdEmail']) || empty($params['iCloudAppleIdEmail'])))
                $this->dhuru_error('Parameter \'iCloudAppleIdEmail\' Required');

            ## iCloudAppleIdScreenshot
            if($m['iCloudAppleIdScreenshot'] == '1' && (!isset($params['iCloudAppleIdScreenshot']) || empty($params['iCloudAppleIdScreenshot'])))
                $this->dhuru_error('Parameter \'iCloudAppleIdScreenshot\' Required');

            ## Reference
            if($m['iCloudAppleIdInfo'] == '1' && (!isset($params['iCloudAppleIdInfo']) || empty($params['iCloudAppleIdInfo'])))
                $this->dhuru_error('Parameter \'iCloudAppleIdInfo\' Required');

            ## iCloudPhoneNumber
            if($m['iCloudPhoneNumber'] == '1' && (!isset($params['iCloudPhoneNumber']) || empty($params['iCloudPhoneNumber'])))
                $this->dhuru_error('Parameter \'iCloudPhoneNumber\' Required');

            ## iCloudID
            if($m['iCloudID'] == '1' && (!isset($params['iCloudID']) || empty($params['iCloudID'])))
                $this->dhuru_error('Parameter \'iCloudID\' Required');

            ## iCloudPassword
            if($m['iCloudPassword'] == '1' && (!isset($params['iCloudPassword']) || empty($params['iCloudPassword'])))
                $this->dhuru_error('Parameter \'iCloudPassword\' Required');

            ## iCloudUDID
            if($m['iCloudUDID'] == '1' && (!isset($params['iCloudUDID']) || empty($params['iCloudUDID'])))
                $this->dhuru_error('Parameter \'iCloudUDID\' Required');

            ## iCloudICCID
            if($m['iCloudICCID'] == '1' && (!isset($params['iCloudICCID']) || empty($params['iCloudICCID'])))
                $this->dhuru_error('Parameter \'iCloudICCID\' Required');

            ## iCloudVideo
            if($m['iCloudVideo'] == '1' && (!isset($params['iCloudVideo']) || empty($params['iCloudVideo'])))
                $this->dhuru_error('Parameter \'iCloudVideo\' Required');

            ## Calculate Price
            $pricing = $this->method_model->get_user_price($member_id, $method_id);
			
            $required_credit = floatval($pricing[0]['Price']); //floatval($m['Price']);
            $available_credit = $this->credit_model->get_credit($member_id);
            if( $required_credit > $available_credit )
                $this->dhuru_error('CreditprocessError');

            $insert = array();
            $insert['MethodID'] = $method_id;
            $insert['IMEI'] = $params['IMEI'];
            $insert['Email'] = '';
            $insert['MemberID'] = $member_id;
            $insert['Maker'] = NULL;
            $insert['Model'] = NULL;				
            ## API Fields ##
            //$insert['NetworkID'] = (isset($params['NETWORKID']) && !empty($params['NETWORKID']))? $params['NETWORKID']: NULL;
            $insert['SerialNumber'] = (isset($params['SN']) && !empty($params['SN']))? $params['SN']: NULL;
            $insert['ModelID'] = (isset($params['MODELID']) && !empty($params['MODELID']))? $params['MODELID']: NULL;
            $insert['ProviderID'] = (isset($params['PROVIDERID']) && !empty($params['PROVIDERID']))? $params['PROVIDERID']: NULL;
            $insert['MEPID'] = (isset($params['MEP']) && !empty($params['MEP']))? $params['MEP']: NULL;
            $insert['PIN'] = (isset($params['PIN']) && !empty($params['PIN']))? $params['PIN']: NULL;
            $insert['KBH'] = (isset($params['KBH']) && !empty($params['KBH']))? $params['KBH']: NULL;
            $insert['PRD'] = (isset($params['PRD']) && !empty($params['PRD']))? $params['PRD']: NULL;
            $insert['Type'] = (isset($params['TYPE']) && !empty($params['TYPE']))? $params['TYPE']: NULL;
            $insert['Locks'] = (isset($params['LOCKS']) && !empty($params['LOCKS']))? $params['LOCKS']: NULL;
            $insert['Reference'] = (isset($params['REFERENCE']) && !empty($params['REFERENCE']))? $params['REFERENCE']: NULL;

            ## Exclusive Unlock Fields ##
            $insert['ExtraInformation'] = (isset($params['EXTRAINFORMATION']) && !empty($params['EXTRAINFORMATION']))? $params['EXTRAINFORMATION']: NULL;
            $insert['iCloudCarrierInfo'] = (isset($params['ICLOUDCARRIERINFO']) && !empty($params['ICLOUDCARRIERINFO']))? $params['ICLOUDCARRIERINFO']: NULL;
            $insert['iCloudAppleIDHint'] = (isset($params['ICLOUDAPPLEIDHINT']) && !empty($params['ICLOUDAPPLEIDHINT']))? $params['ICLOUDAPPLEIDHINT']: NULL;
            $insert['iCloudActivationLockScreenshot'] = (isset($params['ICLOUDACTIVATIONLOCKSCREENSHOT']) && !empty($params['ICLOUDACTIVATIONLOCKSCREENSHOT']))? $params['ICLOUDACTIVATIONLOCKSCREENSHOT']: NULL;
            $insert['iCloudIMEINumberScreenshot'] = (isset($params['ICLOUDIMEINUMBERSCREENSHOT']) && !empty($params['ICLOUDIMEINUMBERSCREENSHOT']))? $params['ICLOUDIMEINUMBERSCREENSHOT']: NULL;
            $insert['iCloudAppleIdEmail'] = (isset($params['ICLOUDAPPLEIDEMAIL']) && !empty($params['ICLOUDAPPLEIDEMAIL']))? $params['ICLOUDAPPLEIDEMAIL']: NULL;
            $insert['iCloudAppleIdScreenshot'] = (isset($params['ICLOUDAPPLEIDSCREENSHOT']) && !empty($params['ICLOUDAPPLEIDSCREENSHOT']))? $params['ICLOUDAPPLEIDSCREENSHOT']: NULL;
            $insert['iCloudAppleIdInfo'] = (isset($params['ICLOUDAPPLEIDINFO']) && !empty($params['ICLOUDAPPLEIDINFO']))? $params['ICLOUDAPPLEIDINFO']: NULL;
            $insert['iCloudPhoneNumber'] = (isset($params['ICLOUDPHONENUMBER']) && !empty($params['ICLOUDPHONENUMBER']))? $params['ICLOUDPHONENUMBER']: NULL;
            $insert['iCloudID'] = (isset($params['ICLOUDID']) && !empty($params['ICLOUDID']))? $params['ICLOUDID']: NULL;
            $insert['iCloudPassword'] = (isset($params['ICLOUDPASSWORD']) && !empty($params['ICLOUDPASSWORD']))? $params['ICLOUDPASSWORD']: NULL;
            $insert['iCloudUDID'] = (isset($params['ICLOUDUDID']) && !empty($params['ICLOUDUDID']))? $params['ICLOUDUDID']: NULL;
            $insert['iCloudICCID'] = (isset($params['ICLOUDICCID']) && !empty($params['ICLOUDICCID']))? $params['ICLOUDICCID']: NULL;
            $insert['iCloudVideo'] = (isset($params['ICLOUDVIDEO']) && !empty($params['ICLOUDVIDEO']))? $params['ICLOUDVIDEO']: NULL;
            
            $insert['Note'] = '';
            $insert['Status'] = 'Pending';
            $insert['UpdatedDateTime'] = date("Y-m-d H:i:s");
            $insert['CreatedDateTime'] = date("Y-m-d H:i:s");

            $insert_id = $this->imeiorder_model->insert($insert);
            
            ## Deduct Credits from available credits
            $credit_data = array(
                'MemberID' => $member_id,
                'TransactionCode' => IMEI_CODE_REQUEST,
                'TransactionID' => $insert_id,
                'Description' => "IMEI Code request from API against imei:".$params['IMEI'],
                'Amount' => -1 * abs($required_credit),
                'CreatedDateTime' => date("Y-m-d H:i:s")
            );
            $this->credit_model->insert($credit_data);

            ## Return order detals
            $data['ID'] = $method_id;
            $data['IMEI'] = $params['IMEI'];
            $data['SUCCESS'][0]['MESSAGE'] = 'Order has been submitted successfully';
            $data['SUCCESS'][0]['REFERENCEID'] = $insert_id;
        }
        $data['apiversion'] = $this->api_version;
        return $data;
    }

    private function getimeiorder($member_id, $imei_order_id)
    {
        $imeiorders = $this->imeiorder_model->get_where(['MemberID' => $member_id, 'ID' => $imei_order_id]);
        if( empty($imeiorders) )
        {
            $data['ID'] = $imei_order_id;
            $data['ERROR'][0]['MESSAGE'] = 'NoResultFound';
        }
        else
        {
            $order = $imeiorders[0];
            // Dhuru Status: Pending(0), In Process(1), Reject(3),Success(4)
            // Our Status: 'Pending', 'Issued', 'Canceled', 'Verified'
            switch ($order['Status']) {
                case 'Pending':
                    $status = 0;
                    break;
                case 'Verified':
                case 'Issued':
                    $status = 4;
                    break;
                case 'Canceled':
                    $status = 3;
                    break;
            }
            $data['ID'] = $imei_order_id;
            $data['SUCCESS'][0] = [
                'IMEI' => $order['IMEI'], 
                'STATUS' => $status, 
                'CODE' => $order['Code'], 
                'COMMENTS' => $order['Comments']
            ];
        }
        $data['apiversion'] = $this->api_version;
        return $data;
    }

    private function providerlist($method_id)
    {
        $data = [];
        $data['SUCCESS'][0] = [
            'MESSAGE' => 'Country and Provider List', 
            'LIST' => [
                0 => [
                    'ID' => 1,
                    'NAME' => 'World',
                    'PROVIDERS' => []
                ]
            ]
        ];
        $data['apiversion'] = $this->api_version;
        return $data;
    }

    private function meplist($method_id)
    {
        $data = [];
        $data['SUCCESS'][0] = [
            'MESSAGE' => 'MEP List', 
            'LIST' => []
        ];
        $data['apiversion'] = $this->api_version;
        return $data;
    }

    private function dhuru_error($msg)
    {
        $data = array();
        $data['ERROR'][0]['MESSAGE'] = $msg;
        $data['apiversion'] = $this->api_version;
        die(json_encode($data));
    }

    private function XMLtoARRAY($rawxml)
    {
        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $rawxml, $vals, $index);
        xml_parser_free($xml_parser);
        $params = array();
        $level = array();
        $alreadyused = array();
        $x = 0;
        foreach ($vals as $xml_elem)
        {
            if ($xml_elem['type'] == 'open')
            {
                if (in_array($xml_elem['tag'], $alreadyused))
                {
                    ++$x;
                    $xml_elem['tag'] = $xml_elem['tag'].$x;
                }
                $level[$xml_elem['level']] = $xml_elem['tag'];
                $alreadyused[] = $xml_elem['tag'];
            }
            if ($xml_elem['type'] == 'complete')
            {
                $start_level = 1;
                $php_stmt = '$params';
                while ($start_level < $xml_elem['level'])
                {
                    $php_stmt .= '[$level['.$start_level.']]';
                    ++$start_level;
                }
                $php_stmt .= '[$xml_elem[\'tag\']] = $xml_elem[\'value\'];';
                eval($php_stmt);
                continue;
            }
        }
        return $params;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */