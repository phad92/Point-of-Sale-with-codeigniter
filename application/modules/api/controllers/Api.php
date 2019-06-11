<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// require APPPATH . '/libraries/API_Controller.php';

class Api extends MX_Controller
{

function __construct() {
    parent::__construct();
}

function _api_return_token($payload,$status = true)
{
    $token = $this->generate_token($payload);
    // return data
    $this->api_return(
        [
            'status' => ($status) ? true : false,
            "result" => [
                'token' => $token
            ],
        ],
        200);
}

function generate_token($payload)
{
    $this->load->library('authorization_token');
    // generte a token
    return $this->authorization_token->generateToken($payload);

}

function _api_config(array $data){
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

        $this->load->library('api_library');
        $this->api_library->view();
    }




}
