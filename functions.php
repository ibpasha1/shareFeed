<?php

function groove_trail_slash($string)
{
	return rtrim($string, '/');
}

function groove_getStoreUrl()
{
  $storeid  = $GLOBALS['store_id'];
  $storeUrl = $GLOBALS['store_url'];
  return $storeUrl ?: '';
}

function groove_getClientID()
{
    $storeClientID = $GLOBALS['client_id'];
	return $storeClientID ?: '';
}

function groove_getStoreAccessToken()
{
    $storeApiKey = $GLOBALS['api_key'];
	return $storeApiKey ?: '';
}

function groove_getProduct(&$ch, $productid)
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products?id='.$productid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_getOrder(&$ch, $orderid)
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/orders/'.$orderid.'/transactions';
	$ch = curl_init();
	return runcurl($ch, $api_url);
}


function groove_getProducts(&$ch, $x)
{
	//$x = $GLOBALS['x'];
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/?include=images&page='.$x.'&limit=250';// LETS TAKE A LOOK
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products?page='.$page_num.'/?include=images';// LETS TAKE A LOOK
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_getProductImage(&$ch, $productid)
{
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/'.$productid.'/images?limit={10000000}';
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/?include=images';// LETS TAKE A LOOK
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/brands?=';
	$ch = curl_init();
	return runcurl($ch, $api_url);
}


function groove_getBrand(&$ch, $productid)
{
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/'.$productid.'/images?limit={10000000}';
	//$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/products/?include=images';// LETS TAKE A LOOK
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/catalog/brands';
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_getDeleteProductImage(&$ch, $productid, $imageid)
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/DELETE/catalog/products/'.$productid.'/images/'.$imageid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_DeleteProduct(&$ch, $productid)
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/DELETE/catalog/products/'.$productid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function groove_UpdateProduct(&$ch, $productid)
{
	$api_url = groove_trail_slash(groove_getStoreUrl()) . '/PUT/catalog/products/'.$productid;
	$ch = curl_init();
	return runcurl($ch, $api_url);
}

function runcurl(&$ch, $api_url = '') 
{
	if($api_url == '') 
	{
		return groove_convertToArray(array());
	}
	curl_setopt( $ch, CURLOPT_URL, $api_url );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array ('X-Auth-Client: '.groove_getClientID(), 'X-Auth-Token: '.groove_getStoreAccessToken(), 'Accept: application/json') );
	curl_setopt( $ch, CURLOPT_VERBOSE, 0 );
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$response = curl_exec($ch);
	return $response;
}


?>