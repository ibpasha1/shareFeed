<?

include 'functions.php';

if(isset($_POST['create_feed'])) 
{
	$store_name   = isset($_POST['store_name']) ? $_POST['store_name']  : '';
	$store_url    = isset($_POST['store_url'])  ? $_POST['store_url']   : '';
	$client_id    = isset($_POST['client_id'])  ? $_POST['client_id']   : '';
	$api_key      = isset($_POST['api_key'])    ? $_POST['api_key']     : '';
	$api_type     = isset($_POST['api_type'])   ? $_POST['api_key']     : '';

	echo $store_name;
	echo $store_url;
	echo $client_id;
	echo $api_key;
	echo $api_type;
}

$header     = false;
$unknown    = ""; 

function google_product()
{
	$none = '';
	groove_getBrand($ch, $productid);
	$brand_name        = groove_getBrand($ch, $productid);
	$data_set_6        = json_decode($brand_name,JSON_PRETTY_PRINT);
	$product_list_1    = groove_getProducts($ch, $y); // the array is built
	for ($x = 1; $x <= $page; $x++)
	{
		$product_list_2 = groove_getProducts($ch, $x); // the array is built
		$v[]            = json_decode($product_list_2, true);
		$json_merge     = json_encode($v);
	}
	$v[]        = json_decode($product_list_1, true);
	$total_list = $json_merge;
	$data_set_5 = json_decode($total_list,JSON_PRETTY_PRINT);
	$array      = json_decode($total_list, JSON_PRETTY_PRINT);
	$fp         = fopen('google_feed.csv',  'w');
	foreach($google_array as $rowA) 
    {
    	foreach($rowA['data'] as $rowB )
    	{
    		foreach($rowB['images'] as $rowC) 
    		{
    			$product_image    = $rowC['url_standard'];
    			$product_thumnail = $rowC['url_standard']; 
    		}

    		foreach($google_array[0]['meta'] as $rowD)
    		{
    			$page_value     = $rowD['total_pages'];
    			$total_products = $rowD['total'];
    			$per_page		= $rowD['per_page'];
    		}
    		$id                         = $rowB['id'];
    		$title       				= $rowB['title']; 
    		$description 				= $rowB['description'];
    		$google_product_category    = $rowB['google_product_category'];
    		$product_type				= $rowB['type'];
    		$link 						= $rowB['custom_url']['url'];
    		$condition					= $rowB['condition'];
    		$availability				= $rowB['availability'];
    		$price 						= $rowB['price'];
    		$sale_price					= $rowB['sale_price'];
    		$sale_price_effective_data	= $rowB['date_created'];
    		$brand   					= $rowB['brand_id'];
    		$mpn  						= $none;
    		$item_group_id				= $none;
    		$gender 					= $none;
    		$age_group					= $none;
    		$color						= $none;
    		$size						= $none;
    		$shipping					= $none;
    		$shipping_weight			= $none;

    		$flitered_des = strip_tags($description);
    		$$web_url = '';

    		$contents = array("id"=>$id, "title"=>$title, "description"=>$description, "google product category"=>$google_product_category,
    		"product_type"=>$product_type, "link"=>$link, "condition"=>$condition, "availability"=>$availability, 
    		"price"=>$price, "sale price"=>$sale_price, "sale price effective data"=>$sale_price_effective_data, "brand"=>$brand,
    		"mpn"=>$mpn, "item_group_id"=>$item_group_id,  
    		);
    	}
    }
}

function sharesale()
{
	$none = '';
	groove_getBrand($ch, $productid);
	$brand_name        = groove_getBrand($ch, $productid);
	$data_set_6        = json_decode($brand_name,JSON_PRETTY_PRINT);
	$product_list_1    = groove_getProducts($ch, $y); // the array is built
	for ($x = 1; $x <= $page; $x++)
	{
		$product_list_2 = groove_getProducts($ch, $x); // the array is built
		$v[]            = json_decode($product_list_2, true);
		$json_merge     = json_encode($v);
	}
	$v[]        = json_decode($product_list_1, true);
	$total_list = $json_merge;
	$data_set_5 = json_decode($total_list,JSON_PRETTY_PRINT);
	$array      = json_decode($total_list, JSON_PRETTY_PRINT);
	$fp         = fopen('sharesale.csv',  'w');
	foreach($sharesale_array as $rowA) 
    {
    	foreach($rowA['data'] as $rowB )
    	{
    		foreach($rowB['images'] as $rowC) 
    		{
    			$product_image    = $rowC['url_standard'];
    			$product_thumnail = $rowC['url_standard']; 
    		}

    		foreach($google_array[0]['meta'] as $rowD)
    		{
    			$page_value     = $rowD['total_pages'];
    			$total_products = $rowD['total'];
    			$per_page		= $rowD['per_page'];
    		}
	    	
			$Id    					= $rowA['id'];
			$Name  					= $rowA['name']; 
			$Sku   					= $rowA['sku'];
			$Product_url			= $rowA['custom_url']['url'];
			$Price 					= $rowA['price'];
			$Retail_price			= $rowA['retail_price'];
			$Sale_price             = $rowA['sale_price'];
			$Commission         	= $rowA['search_keywords'];
			$Category           	= "11";
			$SubCategory        	= "96";
			$Description        	= $rowA['description'];
			$SearchTerms        	= $unknown;
			$Status					= $unknown;
			$MerchantID         	= "78206";
			$Custom_1           	= $unknown;
			$Custom_2           	= $unknown;
			$Custom_3           	= $unknown;
			$Custom_4          	    = $unknown;
			$Custom_5           	= $unknown;
			$Manufacturer       	= $StoreName;
			$PartNumber             = $rowA['sku'];
			$MerchantCategory       = $unknown;
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

    	}
    }
}


function facebook_product() 
{
	$none = '';
	groove_getBrand($ch, $productid);
	$brand_name        = groove_getBrand($ch, $productid);
	$data_set_6        = json_decode($brand_name,JSON_PRETTY_PRINT);
	$product_list_1    = groove_getProducts($ch, $y); // the array is built
	for ($x = 1; $x <= $page; $x++)
	{
		$product_list_2 = groove_getProducts($ch, $x); // the array is built
		$v[]            = json_decode($product_list_2, true);
		$json_merge     = json_encode($v);
	}
	$v[]        = json_decode($product_list_1, true);
	$total_list = $json_merge;
	$data_set_5 = json_decode($total_list,JSON_PRETTY_PRINT);
	$array      = json_decode($total_list, JSON_PRETTY_PRINT);
	$fp         = fopen('facebook_feed.csv',  'w');

	foreach($facebook_array as $rowA)
	{

		foreach($rowA['data'] as $rowB)
		{

			foreach($rowB['images'] as $rowC) 
			{
				$product_image    = $rowC['url_standard'];
    			$product_thumnail = $rowC['url_standard']; 
			}

			foreach($facebook_array[0]['meta'] as $rowD)
			{
				$page_value     = $rowD['total_pages'];
    			$total_products = $rowD['total'];
    			$per_page		= $rowD['per_page'];
			}

				$id                        = $row2['id'];
				$title           	       = $row2['name'];
				$description               = $row2['description'];
				$availability              = $row2['availability'];
				$condition                 = $row2['condition'];
				$price           	       = $row2['price'];
				$link                      = $row2['custom_url']['url'];
				//$image_link                = $row['images']['url_standard'];
				$brand                     = $row2['brand_id'];
				$layout_file               = $row2['layout_file'];
				$age_group                 = $row2['search_keywords'];
				$color                     = $row2['search_keywords'];
				$gender                    = $row2['search_keywords'];
				$item_group_id             = $row2['search_keywords'];
				$google_product_category   = $row2['search_keywords'];
				$material                  = $row2['search_keywords'];
				$pattern                   = $row2['search_keywords'];
				$product_type              = $row2['search_keywords'];
				$sale_price                = $row2['sale_price'];
				$sale_price_effective_date = $row2['date_created'];
				$shipping                  = $row2['is_free_shipping'];
				$shipping_weight 		   = $row2['weight'];
				$custom_label_0 		   = $row2['search_keywords'];
				$custom_label_1  		   = $row2['search_keywords'];
				$custom_label_2 		   = $row2['search_keywords'];
				$custom_label_3  		   = $row2['search_keywords'];
				$custom_label_4  		   = $row2['search_keywords'];

				$flitered_des = strip_tags($description);
				if($availability == 'disabled') {
					$note = 'out of stock';
				} else if ($availability == 'available') {
					$note = 'in stock';
				}

				if($brand == '0') {
					$brand_name = 'Unknown';
				} else if ($brand == '1') {
					$brand_name = 'Legacy';
				} else if ($brand == '2') {
					$brand_name = 'Steam Freak';
				} else if ($brand == '3') {
					$brand_name = 'Brewcraft';
				} else if ($brand == '4') {
					$brand_name = 'Brewers Best';
				} else if ($brand == '5') {
					$brand_name = 'Muntons';
				} else if ($brand == '6') {
					$brand_name = 'Briess';
				}
				$web_url = 'eckraus.com'; // has to be changed based on the product.
				$mod_link = $web_url . $link;

				$contents = array("id"=>"$id","title"=>$title,"description"=>$flitered_des
				,"availability"=>$note,"condition"=>$condition,"price"=>$price
				,"link"=>$mod_link,"image_link"=>$image_link,"brand"=>$brand,"brand"=>$brand_name
				,"additional_image_link"=>$layout_file, "age_group"=>$age_group, "color"=>$color
				,"gender"=>$gender , "item_group_id"=>$item_group_id
				,"google_product_category"=>$google_product_category,  "material"=>$material
				,"pattern"=>$pattern, "product_type"=>$product_type, "sale_price"=>$sale_price, "sale_price_effective_date"=>$sale_price_effective_date
				,"shipping"=>$shipping, "shipping_weight"=>$shipping_weight, "custom_label_0"=>$custom_label_0, "custom_label_1"=>$custom_label_1
				,"custom_label_2"=>$custom_label_2, "custom_label_3"=>$custom_label_3, "custom_label_4"=>$custom_label_4 );

				 if (empty($header)) 
				 {

				 $header = array("id"=>"id", "title"=>"title", "description"=>"description",
				 "availability"=>"availability", "condition"=>"condition", "price"=>"price",
				 "link"=>"link", "image_link"=>"image_link", "brand"=>"brand",
				 "additional_image_link"=>"additional_image_link", "age_group"=>"age_group",
				 "color"=>"color", "gender"=>"gender", "item_group_id"=>"item_group_id",
				 "google_product_category"=>"google_product_category", "material"=>"material",
				 "pattern"=>"pattern", "product_type"=>"product_type", "sale_price"=>"sale_price",
				 "sale_price_effective_date"=>"sale_price_effective_date","shipping"=>"shipping" ,
				 "shipping_weight"=>"shipping_weight" ,"custom_label_0"=>"custom_label_0","custom_label_1"=>"custom_label_1",
				 "custom_label_2"=>"custom_label_2","custom_label_3"=>"custom_label_3","custom_label_4"=>"custom_label_4","Content-Encoding: UTF-8","Content-type: text/csv; charset=UTF-8");
				//$header = array_keys($row);
				fputcsv($fp, $header);
				$header = array_flip($header);
				}

		fputcsv($fp, array_merge($header, $contents));
	}
}


function amazon_product()
{
	$none = '';
	groove_getBrand($ch, $productid);
	$brand_name        = groove_getBrand($ch, $productid);
	$data_set_6        = json_decode($brand_name,JSON_PRETTY_PRINT);
	$product_list_1    = groove_getProducts($ch, $y); // the array is built
	for ($x = 1; $x <= $page; $x++)
	{
		$product_list_2 = groove_getProducts($ch, $x); // the array is built
		$v[]            = json_decode($product_list_2, true);
		$json_merge     = json_encode($v);
	}
	$v[]        = json_decode($product_list_1, true);
	$total_list = $json_merge;
	$data_set_5 = json_decode($total_list,JSON_PRETTY_PRINT);
	$array      = json_decode($total_list, JSON_PRETTY_PRINT);
	$fp         = fopen('amazon_feed.csv',  'w');

}

?>