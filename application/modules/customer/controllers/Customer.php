<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends MX_Controller
{


function __construct() {
    
    parent::__construct();
}


function all(){
    $query = $this->get('name');
    return json_encode($query);
}

function one($update_id){
    $query = $this->where($update_id);
    $customer = $query->row();
    return json_encode($customer);
} 

function create(){
    $data['view_file'] = 'create';
    $this->load->module('template');
    $this->template->layout($data);
}

function save(){
    $this->load->library('form_validation');
    
    if(isset($_POST)){
        $_POST = $this->form_data();
    }

    $this->form_validation->set_rules('name','Name','trim|required');
    $this->form_validation->set_rules('model','Model','required');
    $this->form_validation->set_rules('color','Color','required');

    if($this->form_validation->run() == FALSE){
        json_output(false);
    }

    if(!$this->_insert($data)){
       json_output(false); 
    }
    
    $this->output->set_content_type('application/json')->set_output(json_encode($_POST));
    
    // json_encode($_POST);
}

function form_data(){
    if(!isset($_POST)){
        $request = json_decode(file_get_contents('php://input'));
        return $_POST = $request;
    }

    return $_POST;
}

function prepare_data($d){
    $data['name'] = trim($d['name']);
    $data['model'] = trim($d['model']);
    $data['color'] = trim($d['color']);
    $data['date_added'] = time(); 
    return $data;
}

function edit(){
    $data['view_file'] = 'edit';
    $this->load->module('template');
    $this->template->layout($data);
}

function update(){
    $this->load->library('form_validation');
    if(!isset($_POST)){
        $request = json_decode(file_get_contents('php://input'));
        $_POST = $request;
    }
    
    $this->output->set_content_type('application/json')->set_output(json_encode($_POST));
}

function get($order_by) {
$this->load->model('Mdl_customer');
$query = $this->Mdl_customer->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('Mdl_customer');
$query = $this->Mdl_customer->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('Mdl_customer');
$query = $this->Mdl_customer->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('Mdl_customer');
$query = $this->Mdl_customer->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('Mdl_customer');
$this->Mdl_customer->_insert($data);
}

function _update($id, $data) {
$this->load->model('Mdl_customer');
$this->Mdl_customer->_update($id, $data);
}

function _delete($id) {
$this->load->model('Mdl_customer');
$this->Mdl_customer->_delete($id);
}

function count_where($column, $value) {
$this->load->model('Mdl_customer');
$count = $this->Mdl_customer->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('Mdl_customer');
$max_id = $this->Mdl_customer->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('Mdl_customer');
$query = $this->Mdl_customer->_custom_query($mysql_query);
return $query;
}

}