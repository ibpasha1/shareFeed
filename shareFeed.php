<?php 
//ShareFeed 0.1v - Author Ibrahim Pasha - May 2018
int_set('maxdb_execute_time',300);

$store_id   = isset($_POST['store_id'])  ? $_POST['store_id']   : '';
$store_url  = isset($_POST['store_url']) ? $_POST['store_url']  : '';
$client_id  = isset($_POST['client_id']) ? $_POST['client_id']  : '';
$api_key    = isset($_POST['api_key'])   ? $_POST['api_key']    : '';
$max_page   = isset($_POST['max_page'])  ? $_POST['max_page']   : '';

//$store_url = 'https://api.bigcommerce.com/stores/ucycv5vmkf/v3/';
//$client_id = '3el5giojff6f0d9gn4fnnp1lhi03sfr';
//$api_key   = '2lxhch78sg9orr7ke3a94dj6tylsmt8';

//store url     = https://api.bigcommerce.com/stores/5g159u61xs/v3/
//client id     = bibrpcbjl3kw2m1l6ao810zevzabdg
//client secret = nr6rnbk98ml06gi0aejxru253bujm9c
//Access token  = mysjj93uvj72zbe3l5kb4hx1biygpx2
 

// ACCESS TOKEN: mysjj93uvj72zbe3l5kb4hx1biygpx2
// CLIENT ID: bibrpcbjl3kw2m1l6ao810zevzabdg
// CLIENT SECRET: nr6rnbk98ml06gi0aejxru253bujm9c
// NAME: shareFeed script
// API PATH: https: api.bigcommerce.com/stores/5g159u61xs/v3/

$store_url = "https://api.bigcommerce.com/stores/5g159u61xs/v3/";
$client_id = "bibrpcbjl3kw2m1l6ao810zevzabdg";
$api_key   = "mysjj93uvj72zbe3l5kb4hx1biygpx2";


$name = '';
$productid = '';
$y = 0;
$page = $max_page;

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


groove_getBrand($ch, $productid);
$brand_name = groove_getBrand($ch, $productid);
$data_set_6 = json_decode($brand_name,JSON_PRETTY_PRINT);
$product_list_1 = groove_getProducts($ch, $y); // the array is built
for ($x = 1; $x <= $page; $x++)
{
	$product_list_2 = groove_getProducts($ch, $x); // the array is built
	$v[] = json_decode($product_list_2, true);
	$json_merge = json_encode($v);
}
$v[] = json_decode($product_list_1, true);
$total_list = $json_merge;
$data_set_5 = json_decode($total_list,JSON_PRETTY_PRINT);
$array = json_decode($total_list, JSON_PRETTY_PRINT);
$fp = fopen('data.csv',  'w');
$header = false;
$unknown = "No 1to1"; 

foreach ($array as $row) 
{

	foreach ($row['data'] as $rowA) 
	{

		foreach ($rowA['images'] as $rowB)
		{
			$product_image    = $rowB['url_standard'];
			$product_thumnail = $rowB['url_standard'];
		}

		foreach ($array[0]['meta'] as $rowC) 
		{
			$page_value     = $rowB['total_pages'];
			$total_products = $rowB['total'];
			$per_page       = $rowB['per_page'];
		}


		$Id    					= $rowA['id'];
		$Name  					= $rowA['title'];
		$Sku   					= $rowA['sku'];
		$Product_url			= $rowA['custom_url']['url'];
		$Price 					= $rowA['price'];
		$Retail_price			= $rowA['sale_price'];
		$Commission         	= $rowA['search_keywords'];
		//$Category             = $rowA[''];
		$Category           	= "parse an array";
		$SubCategory        	= "parse an array";
		$Description        	= $rowA['description'];
		$SearchTerms        	= $unknown;
		$Status					= $unknown;
		$MerchantID         	= $unknown;
		$Custom_1           	= $unknown;
		$Custom_2           	= $unknown;
		$Custom_3           	= $unknown;
		$Custom_4          	    = $unknown;
		$Custom_5           	= $unknown;
		$Manufacturer       	= $rowA['brand_id'];
		$MerchantSubcategory	= $rowA['brand_id'];
		$ShortDescription       = $rowA['meta_description'];
		$ISBN					= $unknown;
		$UPC 					= $rowA['upc'];
		$CrossSell              = $unknown;
		$MerchantGroup  		= $unknown;
		$MerchantSubgroup       = $unknown;
		$CompatibleWit          = $unknown;
		$CompareTo				= $unknown;
		$QuantityDiscount       = $unknown;
		$Bestseller 			= $unknown;
		$AddToCartURL			= $unknown;
		$ReviewsRSSURL			= $unknown;
		$Option1				= $unknown;
		$Option2				= $unknown;
		$Option3				= $unknown;
		$Option4				= $unknown;
		$Option5				= $unknown;
		$customCommissions      = $unknown;
		$customCommissionIsFlatRate            = $unknown;
		$customCommissionNewCustomerMultiplier = $unknown;
		$mobileURL			    = $unknown;
		$mobileImage			= $unknown;
		$mobileThumbnail		= $unknown;
		$ReservedForFutureUse   = $unknown;


		if (empty($header)) {

		$header = array("SKU"=>"SKU", "Name"=>"Name", "URL to product"=>"URL to product", "Price"=>"Price", 
		"Retail Price"="Retail Price", "URL to image"=>"Url to image", "URL to thumnail image"=>"Url to thumnail",
		"Commission"=>"Commission" , "Category"=>"Category", "SubCategory"=>"SubCategory",
		"Description"=>"Description", "SearchTerms"=>"SearchTerms", "Status"=>"Status", "Your MerchantID"=>"Your MerchantID",
		"Custom 1"=>"Custom 1", "Custom 2"=>"Custom 2", "Custom 3"=>"Custom 3", "Custom 4"=>"Custom 4", "Custom 5"=>"Custom 5",
		"Manufacturer"=>"Manufacturer", "PartNumber"=>"PartNumber", "MerchantCategory"=>"MerchantCategory",
		"MerchantSubcategory"=>"MerchantSubcategory", "ShortDescription"=>"ShortDescription","ISBN"=>"ISBN",
		"UPC"=>"UPC", "CrossSell"=>"CrossSell", "MerchantGroup"=>"MerchantGroup", "MerchantSubgroup"=>"MerchantSubgroup",
		"CompatibleWith"=>"CompatibleWith", "CompareTo"=>"CompareTo", "QuantityDiscount"=>"QuantityDiscount",
		"Bestseller"=>"Bestseller", "AddToCartURL"=>"AddToCartURL", "ReviewsRSSURL"=>"ReviewsRSSURL", "Option1"=>"Option1",
		"Option2"=>"Option2","Option3"=>"Option3","Option4"=>"Option4", "Option5"=>"Option5", "customCommissions"=>"customCommissions",
		"customCommissionIsFlatRate"=>"customCommissionIsFlatRate", "customCommissionNewCustomerMultiplier"=>"customCommissionNewCustomerMultiplier",
		"mobileURL"=>"mobileURL", "mobileImage"=>"mobileImage", "mobileThumbnail"=>"mobileThumbnail", "ReservedForFutureUse"=>"ReservedForFutureUse", 
		"ReservedForFutureUse"=>"ReservedForFutureUse","ReservedForFutureUse"=>"ReservedForFutureUse","ReservedForFutureUse"=>"ReservedForFutureUse", 
		"ReservedForFutureUse"=>"ReservedForFutureUse", "Content-Encoding: UTF-8","Content-type: text/csv; charset=UTF-8");


		$contents = array("SKU"=>$SKU, "Name"=>$Name, "Url to product"=>$Product_url, "Price"=>$Price, 
		"Retail Price"=>$Retail_price, "Url to image"=>$product_image, "Url to thumnail image"=>$product_image,
		"Commission"=>$Commission, "Category"=>$Category, "SubCategory"=>$SubCategory,
		"Description"=>$Description, "SearchTerms"=>$SearchTerms, "Status"=>$Status, "Your MerchantID"=>$MerchantID, 
		"Custom 1"=>$Custom_1, "Custom 2"=>$Custom_2, "Custom 3"=>$Custom_3, "Custom 4"=>$Custom_4, "Custom 5"=>$Custom_5,
		"Manufacturer"=>$Manufacturer, "PartNumber"=>$PartNumber, "MerchantCategory"=>$MerchantCategory, 
		"MerchantSubcategory"=>$MerchantSubcategory, "ShortDescription"=>$ShortDescription, "ISBN"=>$ISBN, 
		"UPC"=>$UPC, "CrossSell"=>$unknown, "MerchantGroup"=>$unknown, "MerchantSubgroup"=>$unknown, 
		"CompatibleWith"=>$unknown, "CompareTo"=>$unknown, "QuantityDiscount"=>$unknown, "Bestseller"=>$unknown, 
		"AddToCartURL"=>$unknown, "ReviewsRSSURL"=>$unknown, "Option1"=>$unknown, "Option2"=>$unknown, "Option3"=>$unknown, 
		"Option4"=>$unknown, "Option5"=>$unknown,"customCommissions"=>$unknown, "customCommissionIsFlatRate"=>$unknown,
	    "customCommissionNewCustomerMultiplier"=>$unknown, "mobileURL"=>$unknown, "mobileImage"=>$unknown, "mobileThumbnail"=>$unknown,
	    "ReservedForFutureUse"=>$unknown, "ReservedForFutureUse"=>$unknown, "ReservedForFutureUse"=>$unknown, "ReservedForFutureUse"=>$unknown, 
	    "ReservedForFutureUse"=>$unknown);

		)

		 fputcsv($fp, $header);
		 $header = array_flip($header);

		 )


		}

		fputcsv($fp, array_merge($header, $contents));

	}

	    echo "Total Pages    = ------------------:" . $page_value;
		echo "</br>";
		echo "Total Products = ------------------:" . $total_products;
		echo "</br>";
		echo "Per Page Value = ------------------:" . $per_page;
		echo "</br>";
		//echo "Test ID        = ------------------:" . $new_id;
		fclose($fp);
		return;
}


?>