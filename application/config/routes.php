<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['page?=(:any)'] = 'd/User/$1';
//$route['404_override'] = 'Home/blank';
$route['sitemap\.xml'] = "Home/sitemap";
$route['pages/product-detail/(:any)'] = 'Product/detail_product/$1';
$route['pages/product/search'] = 'Product/search/';
$route['pages/product-search/p'] = 'Product/search_product/';
$route['pages/galery'] = 'Home/galeryfoto';
$route['pages/about'] = 'Home/about';
$route['pages/contact'] = 'Home/contact';
$route['pages/credits'] = 'Home/credits';
$route['default_controller'] = 'Home/home';
$route['translate_uri_dashes'] = FALSE;

//user
$route['pages/login'] = "User/login";

//cart-order-invoice
$route['pages/cart'] = "Cart";
$route['pages/cart/form-customer'] = "Cart/cart_form_customer";
$route['pages/cart/shiping'] = "Cart/cart_shiping";
$route['pages/cart/cart-partner'] = "Cart/cart_partner/";
$route['pages/cart/payment'] = "Cart/cart_payment/";
$route['pages/invoice/invoice-partner'] = "Invoice/invoice_partner/";
$route['pages/invoice'] = "Invoice/invoice/";
$route['pages/track-order'] = "Order/form_track_order/";
$route['pages/confirm-payment'] = "Invoice/form_confirm_payment/";
$route['pages/order-search'] = "Order/track_order_result/";

$route['pages/profile'] = "Home/data_profile_partner/";
$route['pages/reset-password'] = "User/f_reset_password/";
$route['pages/create-new-password'] = "User/f_new_password/";
