<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_notify extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function store_reminder_orderin($data){
        $this->db->insert('t_notify', $data);
        $this->db->insert_id();
    }

    function update_notify_by_idorder($id, $data){
        $this->db->where('idorder', $id);
        $this->db->update('t_notify', $data);
    }

    function notify_by_idorder($idorder){
        $this->db->where('idorder', $idorder);
        return $this->db->get('t_notify');
    }

    function cek_order_unpaid(){
        $this->db->select('COUNT(idorder) AS result')
        ->where('notifyStatus', 0)
        ->where('notifyName', 'Closing Unpaid')
        ->group_by('idorder');
        return $this->db->get('t_notify');
    }
    function cek_order_paid(){
        $this->db->select('COUNT(idorder) AS result')
        ->where('notifyStatus', 0)
        ->where('notifyName', 'Closing Paid')
        ->group_by('idorder');
        return $this->db->get('t_notify');
    }
    function count_all_notify(){
        $this->db->select('COUNT(idorder) AS result')
        ->where('notifyStatus', 0)
        ->group_by('idorder');
        return $this->db->get('t_notify');
    }

    function data_notify_by_name($name){
        $this->db->select('*')
        ->where('notifyName', $name)
        ->where('notifyStatus', 0);
        return $this->db->get('t_notify');
    }
}