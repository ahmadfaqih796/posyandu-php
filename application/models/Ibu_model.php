<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ibu_model extends CI_Model
{
   public function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   public function get_all_ibu()
   {
      return $this->db->get('ibu')->result_array();
   }

   public function get_ibu_by_id($id)
   {
      return $this->db->get_where('ibu', ['id' => $id])->row_array();
   }

   public function add_ibu($data)
   {
      return $this->db->insert('ibu', $data);
   }

   public function update_ibu($id, $data)
   {
      $this->db->where('id', $id);
      return $this->db->update('ibu', $data);
   }

   public function delete_ibu($id)
   {
      $this->db->where('id', $id);
      return $this->db->delete('ibu');
   }
}
