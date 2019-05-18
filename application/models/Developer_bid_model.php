<?php

class Developer_bid_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'developer_bidding';
        parent::__construct($this->table);
    }
    function get_by_developer_id($id=NULL,$estimate_id=NULL){
        $where = "";
        if ($id) {
            $where .= " WHERE bid_by=$id";
        } 
        if ($estimate_id && $where=="") {
            $where .= " WHERE estimate_id=$estimate_id";
        }else{
            $where .= " AND estimate_id=$estimate_id";
        }         return $this->db->query("SELECT * from $this->table $where")->row_array();
    }
    function saveStatus($data)
    {
        $bidding_statuses = $this->db->dbprefix('bidding_statuses');
        return $this->db->insert($bidding_statuses, $data);
    }
    function get_by_developer($estimate_id=NULL){
        $this->db->select("$this->table.*,users.first_name,users.last_name")->from($this->table);
        $this->db->join('users', "users.id = $this->table.bid_by", 'left');
        
        if ($estimate_id) {
            $this->db->where('estimate_id', $estimate_id);
        }
        if($this->login_user->user_type=="client"){
            $this->db->where('send_to_client', 1);
        }
        return $this->db->get()->result_array();
    }
    function getCount($estimate_id=NULL,$developer_id=NULL){
        $this->db->select("$this->table.*")->from($this->table);
        
        if ($estimate_id) {
            $this->db->where('estimate_id', $estimate_id);
        }
        if ($developer_id) {
            $this->db->where('bid_by', $developer_id);
        }
        return $this->db->get()->num_rows();
    }
    function getDetailsCount($developer_id=NULL,$estimate_id=NULL){
        $this->db->select("$this->table.*")->from($this->table);
        
        if ($estimate_id) {
            $this->db->where('estimate_id', $estimate_id);
        }
        if ($developer_id) {
            $this->db->where('bid_by', $developer_id);
        }
        $result = $this->db->get()->result();
        $finalResult = ['open'=>0,'estimated'=>0,'confirm'=>0,'paid'=>0,'won'=>0,'not_paid'=>0,'pending'=>0,'send'=>0,'accepted'=>0,'canceled'=>0,'rejected'=>0,'totalBid'=>0,'client_question'=>0,'admin_replied'=>0,'total_open'=>0];
        foreach ($result as $key => $val) {
            $finalResult[$val->status]+=1;
            if ($val->status!="won" && $val->status!="canceled" && $val->status!="rejected" && $val->status!="confirm") {
                $finalResult["total_open"]+=1;
            }
        }
        $finalResult['totalBid']=count($result);
        return $finalResult;
    }
    function is_estimated($estimate_id=NULL){
        $this->db->select("id")->from($this->table);
        $this->db->where('estimate_id', $estimate_id);
        $this->db->where('deleted', 0);
        $this->db->where('(send_to_client = 1 OR status="accepted")', NULL,FALSE);
        return $this->db->get()->num_rows();
    }
    function estimate_questions($by=NULL,$estimate_id=NULL){
        $estimate_questions = $this->db->dbprefix('estimate_questions');
        $this->db->select("$estimate_questions.*,users.first_name,users.last_name")->from($estimate_questions);
        $this->db->join('users', "users.id = $estimate_questions.question_by", 'left');
        if ($by) {
            $this->db->where('question_by', $by);
        } 
        if ($estimate_id) {
            $this->db->where('estimate_id', $estimate_id);
        }
        if($this->login_user->user_type=="client"){
            $this->db->where('forward_to_client', 1);
        }
        return $this->db->get()->result_array();
    }
    function clientAction($data,$id,$estimate_id)
    {
        if (!in_array($data['status'], array('pending','send','accepted','canceled','rejected'))) {
            return true;
        }

        $this->db->where('estimate_id', $estimate_id);
        $this->db->where('id !=', $id);
        if ($data['status']=="rejected") {
            // set all other bids as not send to client
            $this->db->update($this->table, array("send_to_client"=>0));
        }else{
            // set all other bids rejected
            $this->db->update($this->table, array("status"=>"rejected"));
        }
        //finally make on client request
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
    function save_question($data){
        parent::use_table("estimate_questions");
        return parent::save($data);
    }
    function save_ans($data,$id){
        parent::use_table("estimate_questions");
        return parent::save($data,$id);
    }
}
