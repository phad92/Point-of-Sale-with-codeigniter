<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Template extends MX_Controller
{

function __construct() {
parent::__construct();
}

function layout($data){
    if(!isset($data['view_module'])){
        $data['view_module'] = $this->uri->segment(1);
    }

    $this->load->view('layout',$data);
}

}