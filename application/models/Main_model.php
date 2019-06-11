<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Main_model extends CI_Model {

    protected $table;

function __construct() {
parent::__construct();
}

function setTable($table){
    $this->table = $table;
}

// function getTable(){
//     return $this->table;
// }

function get_table() {
$table = $this->table;
return $table;
}

function get($order_by) {
$table = $this->get_table();
$this->db->order_by($order_by);
$query=$this->db->get($this->table);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$table = $this->get_table();
$this->db->limit($limit, $offset);
$this->db->order_by($order_by);
$query=$this->db->get($this->table);
return $query;
}

function get_where($id) {
$table = $this->get_table();
$this->db->where('id', $id);
$query=$this->db->get($this->table);
return $query;
}

function get_where_custom($col, $value) {
$table = $this->get_table();
$this->db->where($col, $value);
$query=$this->db->get($this->table);
return $query;
}

function _insert($data) {
$table = $this->get_table();
return $this->db->insert($this->table, $data);
}

function _update($id, $data) {
$table = $this->get_table();
// var_dump($id);die();
$this->db->where('id', $id);
return $this->db->update($this->table, $data);
}

function _delete($id) {
$table = $this->get_table();
$this->db->where('id', $id);
return $this->db->delete($this->table);
}

function count_where($column, $value) {
$table = $this->get_table();
$this->db->where($column, $value);
$query=$this->db->get($this->table);
$num_rows = $query->num_rows();
return $num_rows;
}

function count_all() {
$table = $this->get_table();
$query=$this->db->get($this->table);
$num_rows = $query->num_rows();
return $num_rows;
}

function get_max() {
$table = $this->get_table();
$this->db->select_max('id');
$query = $this->db->get($this->table);
$row=$query->row();
$id=$row->id;
return $id;
}

function _custom_query($mysql_query) {
$query = $this->db->query($mysql_query);
return $query;
}

}