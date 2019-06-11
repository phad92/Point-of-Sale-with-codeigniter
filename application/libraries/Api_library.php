<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

class Api_library extends API_Controller
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    function test(){
     return    'hello world';
    }

    public function _api_return_token($payload,$status = true)
    {
        $token = $this->generate_token($payload);
        // return data
        $this->api_return(
            [
                'status' => $status,
                "result" => [
                    'token' => $token,
                ],
            ],
            200);
    }

    public function generate_token($payload)
    {
        $this->CI->load->library('authorization_token');
        // generte a token
        return $this->CI->authorization_token->generateToken($payload);
    }

    public function _api_config(array $data)
    {
        $this->_apiConfig($data);
    }

       /**
     * View User Data
     *
     * @method POST
     * @return Response|void
     */
    public function view()
    {
        header("Access-Control-Allow-Origin: *");

        // API Configuration [Return Array: User Token Data]
        $data = $this->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => true,
        ]);

        // return data
        $this->api_return(
            [
                'status' => true,
                "result" => [
                    'data' => $data['token_data']
                ],
                "timestamp" => time()
            ],
        200);
    }

    
}
