<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Stock_location extends MX_Controller
{
  protected $model;

function __construct() {
parent::__construct();
  $this->model = new main_model;
  $this->model->setTable('color');
}

public function get()
  {
      // $model = $this->model;
      $payload = $this->model->get('name')->result();
      $config_data = [
          // 'key' => ['header', $this->api_key],
          'methods' => ['GET'],
      ];
      _api_config($config_data);
      _api_return_token($payload);
      // $this->api_library->_api_return_token($payload);
  }

  public function get_by_id($update_id)
  {
      $payload = $this->model->get($update_id)->row_array();
      // print_r($payload);die();
      _api_config([

          // 'key' => ['header', $this->api_key],
          'methods' => ['GET'],
      ]);

      _api_return_token($payload);

  }

  public function save()
  {
      $this->load->library('form_validation');
      $_POST = form_data();
      $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[color.name]');
      $data['name'] = $this->input->post('name');
      _api_config([
          // 'key' => ['header', $this->api_key],
          'methods' => ['POST'],
      ]);

      if ($this->form_validation->run()) {
          if (!$this->model->_insert($data)) {

              $message = response_message("Database operation failed");
              // print_r($message);die();
              _api_return_token($message, false);
          }else{

              $message = response_message("Success");;
              // print_r($message);die();
              _api_return_token($message);
          }
      } else {
          $message = response_message(validation_errors());
          _api_return_token($message, false);
      }

  }

  public function update($update_id)
  {
      $this->load->library('form_validation');
      $_POST = form_data();
      $this->form_validation->set_rules('name', 'Name', 'trim|required');
      _api_config([
          // 'key' => ['header', $this->api_key],
          'methods' => ['POST'],
      ]);
      if(!$update_id){
          $message = "Invalid id";
          $this->_api_return_token($message, false);
      }

      $data['name'] = $this->input->post('name');
      if ($this->form_validation->run()) {
          if (!$this->model->_update($update_id,$data)) {

              $message = response_message("Database operation failed");
              // print_r($message);die();
              _api_return_token($message, false);
          }else{

              $message = response_message("Success");;
              // print_r($message);die();
              _api_return_token($message);
          }
      } else {
          $message = response_message(validation_errors());
          _api_return_token($message, false);
      }
  }

  public function delete($id){
      _api_config([
          // 'key' => ['header', $this->api_key],
          'methods' => ['POST'],
      ]);
      if($this->model->_delete($id)){
          $message = response_message('delete successful');
          _api_return_token($message);
      }
  }


}
