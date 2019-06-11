<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Site_settings extends MX_Controller
{

    
    private $data = [];

    function __construct(){
        $this->load->module('store_options');
        $this->data = $this->store_options->_fetch_site_info('general');
    }


    function _is_connected(){

    }

    function is_mobile(){
        $this->load->library('user_agent');
        $is_mobile = $this->agent->is_mobile();
        // $is_mobile = true; //FOR TESTING PURPOSES
        return $is_mobile; //TRUE OR FALSE;
    }

    function _get_map_code(){
        $code = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.4811437001827!2d-0.18090058584126958!3d5.64330033433584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf9c9af2633d1d%3A0x76994c2cb0b91035!2sLegon+E+Rd%2C+Accra!5e0!3m2!1sen!2sgh!4v1517183803820" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
        return $code;
    }

    function _get_book_path($format,$book){
        if($format == "digital"){
            $book_path = base_url()."public/books/files/".$book;
        }else{
            $book_path = base_url()."public/books/audio/".$book;
        }

        print $book_path;die();
        return $book_path;
    }

    function _book_upload_config($format_id){
        $this->load->module('book_formats');
        $format = $this->book_formats->_get_format($format_id);
        if($format == "ebooks"){
            $config['upload_path']          = './public/books/files/';
            $config['allowed_types']        = 'epub|azw|lit|pdf|odf|mobi';
        }elseif($format == "audio"){
            $config['upload_path']          = './public/books/audio/';
            $config['allowed_types']        = 'mp3|aac|aax|m4a|m4b|ogg|wma|flac|alac|wma';
        }
        $config['max_size']             = 204800;
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = TRUE;


       return $config;
    }

    function _attempt_get_site_info(){
        $data['site_logo'] = $this->_get_site_logo();
        $data['site_title'] = $this->_get_our_name();
        $data['tagline'] = $this->_get_tag_line();
        return $data;
    }

    function _attempt_get_social_media_links(){
        $data = $this->store_options->_fetch_site_info('social_media');
        // print_r($data);die();
        $data['facebook_url'] = $data['facebook_url'];
        $data['twitter_url'] = $data['twitter_url'];
        $data['googleplus_url'] = $data['googleplus_url'];
        $data['instagram_url'] = $data['instagram_url'];
        return $data;
    }

    function _get_site_logo(){
        $mysql_query = $this->store_options->get_where_custom('option_name','site_logo');
        $query = $mysql_query->row();
        $site_logo = ($query->option_value) ? $query->option_value : '';
        return $site_logo;
    }


    function _get_our_name(){
        $data = $this->data;
        $name = $data['site_title'];
        return $name;
    }

    function _get_tag_line(){
        $tagline = '';
        $data = $this->data;
        if(!$data['tag_line_check']){
            return $tagline;
        }
        $tagline = $data['tag_line'];
        return $tagline;
    }

    function _get_our_address(){
        $data = $this->data;
        $address = $data['address1']."<br>";
        $address .= ($data['address2']) ? $data['address2'] : '';
        return $address;
    }

    function _get_our_telnum(){
        $data = $this->data;
        extract($data);
        $telnum1 = ($phone1) ? $phone1 : '';
        $telnum2 = ($phone2) ? ', '.$phone2 : '';
        $telnum3 = ($phone3) ? ', '.$phone3 : '';
        $telnum = $phone1.$phone2.$phone3;
        return $telnum;
    }

    function _get_our_mailing_addr(){
        $data = $this->data;
        $email = $data['email'];
        return $email;
    }

    function _get_paypal_email(){
        $email = 'fadl_1992-facilitator@yahoo.com';
        // $email = 'fadlu.haruna-facilitator@gmail.com';
        //$email = 'fadlu.haruna@gmail.com';
        return $email;
    }

    function _get_support_team_name(){
        $name = "Customer Support";
        return $name;
    }

    function _get_welcome_msg($customer_id){
        $this->load->module('store_accounts');
        $customer_name = $this->store_accounts->_get_customer_name($customer_id);

        $msg= "Hello ".$customer_name.", </br></br>";
        $msg = "Thank you for creating a account with Us. If you have any questions ";
        $msg = "about any of our products and services then please do get in touch";
        return $msg;
    }

    function _get_cookie_name(){
        $cookie_name = 'oejrsdlsjkl';
        return $cookie_name;
    }

    function _get_currency_symbol(){
        $symbol = "$";
        return $symbol;
    }

    function _get_currency_code(){
        $code = "USD";
        return $code;
    }



    function _get_items(){
        //return the segments for the store item page;
        $segments = "explore/product/";
        return $segments;
    }

    function _get_item_segments(){
        //return the segments for the store item page;
        $segments = "explore/product/";
        return $segments;
    }

    function _get_cagegories_segment(){
        $segments = "explore/categories/";
        return $segments;
    }
    
    function _get_items_segments(){
        // returns the segments for the category pages
        $segments = "explore/category/";
        return $segments;
    }
    function _get_authors_segments(){
        // returns the segments for pages containing books of authors
        $segments = "explore/author/";
        return $segments;
    }

    function _get_formats_segment(){
        $segment = "explore/books/";
        return $segment;
    }

    function _get_books(){
        return "explore/books/";
    }

    function _get_page(){
        $segments = "explore/docs/";
        return $segments;
    }

    function _get_page_not_found(){
        $msg = "<h1>Page not found</h1>";
        return $msg;
    }

    function get_limit($limit = 20){
        // $limit = 10;
        return $limit;
    }

    function get_offset($offset_value = 0){
        $offset = $this->uri->segment($offset_value);
        if(!is_numeric($offset)){
            $offset = 0;
        }
        // print($offset);die();
        return $offset;
    }

}