<?php
/**
 * [getPaymentStatusText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getPaymentStatusText')) {
    function getPaymentStatusText($value)
    {
    	$lang = array(0=>'initial',1=>'wait',2=>'checking',3=>'success',4=>'fail',5=>'pending',6=>'cancel');
    	return isset($lang[$value])?$lang[$value]:'';
    }
}

/**
 * [getPaymentStatusId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getPaymentStatusId')) {
    function getPaymentStatusId($value)
    {
    	$lang = array('initial'=>0,'wait'=>1,'checking'=>2,'success'=>3,'fail'=>4,'pending'=>5,'cancel'=>6);
    	return isset($lang[$value])?$lang[$value]:'';
    }
}


/**
 * [getPaymentStatusText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getDeliveryStatusText')) {
    function getDeliveryStatusText($value)
    {
    	$lang = array(0=>'not_fulfilled',1=>'partial_fulfilled',2=>'fulfilled');
    	return isset($lang[$value])?$lang[$value]:'';
    }
}

/**
 * [getPaymentStatusId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getDeliveryStatusId')) {
    function getDeliveryStatusId($value)
    {
    	$lang = array('not_fulfilled'=>0,'partial_fulfilled'=>1,'fulfilled'=>2);
    	return isset($lang[$value])?$lang[$value]:'';
    }
}

/**
 * [getPaymentStatusText description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getAddressTypeText')) {
    function getAddressTypeText($value)
    {
    	$lang = array(1=>'billing',2=>'shipping');
    	return isset($lang[$value])?$lang[$value]:'';
    }
}

/**
 * [getPaymentStatusId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getAddressTypeId')) {
    function getAddressTypeId($value)
    {
    	$lang = array('billing'=>1,'shipping'=>2);
    	return isset($lang[$value])?$lang[$value]:'';
    }
}


/**
 * [encodeOrderId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('cryptEncode')) {
    function cryptEncode($value)
    {
    	return Crypt::encrypt($value);
    }
}


/**
 * [encodeOrderId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('cryptDecode')) {
    function cryptDecode($value)
    {
    	return Crypt::decrypt($value);
    }
}



/**
 * [encodeOrderId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getPolicyTypeText')) {
    function getPolicyTypeText($value)
    {
    	$lang = array(1=>'refund',2=>'privacy',3=>'terms');
    	return isset($lang[$value])?$lang[$value]:'';
    }
}


/**
 * [encodeOrderId description]
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
if (!function_exists('getPolicyTypeId')) {
    function getPolicyTypeId($value)
    {
    	$lang = array('refund'=>1,'privacy'=>2,'terms'=>3);
    	return isset($lang[$value])?$lang[$value]:'';
    }
}


/**
 * [getWetrustSourceOfFund description]
 * @return [type] [description]
 */
if (!function_exists('getWetrustSourceOfFund')) {
    function getWetrustSourceOfFund()
    {
    	$sof = array(
    		'CCW'=>'Credit Card',
    		//'EW'=>'Ewallet',
    		//'TOUCH'=>'Touch SIM',
    		'ATM'=>'ATM',
    		'BANKTRANS'=>'Bank Tranfer',
    		'IBANK'=>'I Banking',
    		//'MMCCEW'=>'TMN Cashcard',
    		//'TMX'=>'Truemoney Express',
    		//'CS'=>'Counter service'
    	);
    	return $sof;
    }
}


/**
 * [getWetrustSourceOfFund description]
 * @return [type] [description]
 */
if (!function_exists('getPaysbuySourceOfFund')) {
    function getPaysbuySourceOfFund()
    {
    	$sof = array(
    		'01'=>'paysbuy',
    		'02'=>'Ewallet',
    	);
    	return $sof;
    }
}

/**
 * [getOrderNumber description]
 * @param  string $prefix [description]
 * @param  [type] $number [description]
 * @return [type]         [description]
 */
if (!function_exists('getOrderNumber')) {
    function getOrderNumber($prefix='INV-{{number}}',$number)
    {
    	if(!preg_match("/{{number}}/",$prefix))
    	{
    		$prefix = "INV-{{number}}";
    	}

    	$invoice_no=str_replace('{{number}}',$number,$prefix);
    	return str_replace('{{year}}',date('Y'),$invoice_no);
    }
}