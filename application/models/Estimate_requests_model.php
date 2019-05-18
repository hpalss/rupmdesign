<?php

class Estimate_requests_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'estimate_requests';
        parent::__construct($this->table);
    }
    function get_discussion($estimate_id)
    {
        $estimate_discussion = $this->db->dbprefix('estimate_discussion');
        $this->db->select("$estimate_discussion.*,users.first_name,users.image");
        $this->db->where('estimate_id', $estimate_id);
        $this->db->join('users', "users.id = $estimate_discussion.from_user_id", 'left');
        return $this->db->get($estimate_discussion);
    }
    function save_estimate_discussion($data,$id){
        $estimate_discussion = $this->db->dbprefix('estimate_discussion');
        if ($id) {
            $this->db->where('id', $id);
            return $this->db->update($estimate_discussion, $data);
        }else{
            return $this->db->insert($estimate_discussion, $data);
        }
    }
    function count(){
        $estimate_requests_table = $this->db->dbprefix('estimate_requests');
        if ($this->login_user->user_type=="client") {
            $this->db->where('status', "estimated");
            $this->db->where('created_by', $this->login_user->id);
        }else{
            $this->db->where('status', "open");
        }
        $this->db->where('deleted', 0);
        return $this->db->get($estimate_requests_table)->num_rows();
    }
    function incrementBid($id)
    {
        $this->db->where('id', $id);
        if ($this->login_user->is_admin) {
            $this->db->set('status', 'estimated');
        }
        $this->db->set('total_bids', 'total_bids+1', FALSE);
        return $this->db->update('estimate_requests');
    }
    function assignTo($id,$assigned_to)
    {
        $this->db->where('id', $id);
        $this->db->set('assigned_to', $assigned_to);
        return $this->db->update('estimate_requests');
    }
    function updateStatus($id,$status)
    {
        $this->db->where('id', $id);
        if ($this->login_user->is_admin) {
            $this->db->set('status', $status);
        }
        return $this->db->update('estimate_requests');
    }
    function getStatuses($id,$status=NULL)
    {
        $this->db->where('estimate_id', $id);
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by("created_at",'DESC');
        return $this->db->get('estimate_statuses');
    }
    function saveStatus($data)
    {
        $estimate_statuses = $this->db->dbprefix('estimate_statuses');
        return $this->db->insert($estimate_statuses, $data);
    }
    function getDetailsCount($estimate_id=NULL){
        $this->db->select("$this->table.status")->from($this->table);
        
        if ($estimate_id) {
            $this->db->where('id', $estimate_id);
        }
        if (!$this->login_user->is_admin) {
            $this->db->where('assigned_to', $this->login_user->id);
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
    function getAllOpenEstimates($estimate_id=NULL){
        $this->db->select("$this->table.status")->from($this->table);
        
        if ($estimate_id) {
            $this->db->where('id', $estimate_id);
        }
        if ($this->login_user->user_type=="client") {
            $this->db->where('client_id', $this->login_user->client_id);
        }
        $ignore = ['won','canceled','rejected','confirm'];

        $this->db->where_not_in("$this->table.status", $ignore);
        $result = $this->db->get()->num_rows();
        return $result;
    }
    public function getUnAnsQuestion($estimate_id='')
    {
        $questionTable = $this->db->dbprefix('estimate_questions');
        $this->db->select('id')->from($questionTable);
        if ($this->login_user->is_admin) {
            $this->db->where('forward_to_client', 0);
        }else{
            $this->db->where('forward_to_client', 1);
        }
        $this->db->where('estimate_id', $estimate_id);
        $this->db->where('answer', NULL);
        return $this->db->get()->num_rows();
    }
    function get_details($options = array()) {
        $estimate_requests_table = $this->db->dbprefix('estimate_requests');
        $estimate_forms_table = $this->db->dbprefix('estimate_forms');
        $clients_table = $this->db->dbprefix('clients');
        $leads_table = $this->db->dbprefix('leads');
        $users_table = $this->db->dbprefix('users');
        $developer_bidding = $this->db->dbprefix('developer_bidding');
        // $developer_bidding = $this->db->dbprefix('developer_bidding');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $estimate_requests_table.id=$id";
        }

        $client_id = get_array_value($options, "client_id");
        if ($client_id) {
            $where .= " AND $estimate_requests_table.client_id=$client_id";
        }
        
        $lead_id = get_array_value($options, "lead_id");
        if ($lead_id) {
            $where .= " AND $estimate_requests_table.lead_id=$lead_id";
        }

        $assigned_to = get_array_value($options, "assigned_to");
        if ($assigned_to) {
            $where .= " AND $estimate_requests_table.assigned_to=$assigned_to";
        }
        $category = get_array_value($options, "category");
        if ($category) {
            $where .= " AND $estimate_requests_table.category='$category'";
        }
        $bid = get_array_value($options, "bid");
        if ($bid=="no_bid") {
            $where .= " AND $estimate_requests_table.total_bids=0";
        }
        $biddingJoin = "";
        if ($bid>0) {
            $where .= " AND $estimate_requests_table.total_bids>='$bid'";
            $bid_by = get_array_value($options, "bid_by");
            if ($bid_by) {
                $where .= " AND $developer_bidding.bid_by=$bid_by";
                $biddingJoin = "LEFT JOIN $developer_bidding ON $estimate_requests_table.id = $developer_bidding.estimate_id";
            }
        }
        $status = get_array_value($options, "status");
        if ($status) {
            $where .= " AND $estimate_requests_table.status='$status'";
        }
        $statuses = get_array_value($options, "statuses");
        if ($statuses) {
            $where .= " AND (FIND_IN_SET($estimate_requests_table.status, '$statuses')) ";
        }
        $deadline = get_array_value($options, "deadline");
        if ($deadline) {
            $now = get_my_local_time("Y-m-d");
            if ($deadline === "expired") {
                $where .= " AND ($estimate_requests_table.deadline IS NOT NULL AND $estimate_requests_table.deadline<'$now')";
            } else {
                $where .= " AND ($estimate_requests_table.deadline IS NOT NULL AND $estimate_requests_table.deadline<='$deadline')";
            }
        }
        $created_at = get_array_value($options, "created_at");
        if ($created_at) {
            $now = get_my_local_time("Y-m-d");
            if ($created_at === "expired") {
                $where .= " AND ($estimate_requests_table.created_at IS NOT NULL AND $estimate_requests_table.created_at<'$now')";
            } else {
                $where .= " AND ($estimate_requests_table.created_at IS NOT NULL AND $estimate_requests_table.created_at>='$created_at')";
            }
        }
        $sql = "SELECT $estimate_requests_table.*, $clients_table.company_name, $estimate_forms_table.title AS form_title, $leads_table.company_name AS lead_company_name, 
              CONCAT($users_table.first_name, ' ',$users_table.last_name) AS assigned_to_user, $users_table.image as assigned_to_avatar 
        FROM $estimate_requests_table
        $biddingJoin
        LEFT JOIN $clients_table ON $clients_table.id = $estimate_requests_table.client_id
        LEFT JOIN $leads_table ON $leads_table.id = $estimate_requests_table.lead_id    
        LEFT JOIN $users_table ON $users_table.id = $estimate_requests_table.assigned_to
        LEFT JOIN $estimate_forms_table ON $estimate_forms_table.id = $estimate_requests_table.estimate_form_id
        WHERE $estimate_requests_table.deleted=0 $where";

        return $this->db->query($sql);
    }

}
