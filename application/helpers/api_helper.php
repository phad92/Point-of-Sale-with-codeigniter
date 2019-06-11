<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('ci')){
    function ci(){
        return $ci =& get_instance();
    }
}

if(!function_exists('post_data')){
    function post_data(){
        $_POST = json_decode(file_get_content('php://input'));
        if($_POST){
          return $_POST;
        }
    }
}

if(!function_exists('response_message')){
    function response_message($message){
       return ['message' => $message];
    }
}

if(!function_exists('_api_config')){
    function _api_config($data){
        ci()->load->library('api_library');
        ci()->api_library->_apiConfig($data);
    }
}


if(!function_exists('_api_return_token')){
    function _api_return_token($payload,$status = true){
        ci()->load->library('api_library');
        ci()->api_library->_api_return_token($payload,$status);
    }
}

if(!function_exists('_view_data')){
    function _view_data(){
        _api_config([
            'methods' => ['POST'],
            'requireAuthorization' => true
        ]);
         // return data
        ci()->api_library->api_return(
            [
                'status' => true,
                "result" => [
                    'data' => $data['token_data']
                ],
                "timestamp" => time()
            ],
        200);
        ci()->api_library->_api_return_token($payload,$status);
    }
}






if(!function_exists('insert'))
{
    function insert($table_name, $insert_data)
    {
        $CI =& get_instance();
        return $CI->db->insert($table_name, $insert_data);
    }
}

if(!function_exists('form_data'))
{
    function form_data()
    {
        if (!isset($_POST)) {
    $request = json_decode(file_get_contents('php://input'));
    return $_POST = $request;
}

return $_POST;

    }
}
