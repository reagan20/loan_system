<?php
class Member_model extends CI_Model{
    public function update_password($id,$data){
        $this->db->where('member_no',$id);
        $qry=$this->db->update('members_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Getting gender
    public function get_gender(){
        $qry=$this->db->get('gender_tbl');
        return $qry->result_array();
    }

    //Getting total searched contribution
    public function totalSearchContribution($c=array()){
        $search_dates=array(
            's_date'=>$c['start_date'],
            'e_date'=>$c['end_date'],
            'added_by'=>$this->session->userdata['member_no']
        );
        $start=$c['start_date'];
        $end=$c['end_date'];
        $this->db->select_sum('amount');
        $this->db->where('paid_date >=',$start);
        $this->db->where('paid_date <=',$end);
        //$this->db->where('added_by <=',$u);
        $this->session->set_userdata($search_dates);
        $qry=$this->db->get('payment_tbl');
        return $qry->result_array();
    }
    public function search_contribution($s=array(),$slug=FALSE,$limit=FALSE,$offset=FALSE){
        if($limit){
            $this->db->limit($limit,$offset);
        }
        if($slug===FALSE){
            $seach_dates=array(
                's_date'=>$s['start_date'],
                'e_date'=>$s['end_date']
            );
            $start=$s['start_date'];
            $end=$s['end_date'];
            $this->db->select('*');
            $this->db->from('payment_tbl');
            $this->db->join('members_tbl','payment_tbl.member_id=members_tbl.member_no');
            $this->db->where('paid_date >=',$start);
            $this->db->where('paid_date <=',$end);
            $this->db->order_by('dated','DESC');
            $qry=$this->db->get();
            $this->session->set_userdata($seach_dates);
            return $qry->result_array();
        }
        else{
            $query=$this->db->get_where(array('slug'=>$slug));
            return $query->row_array();
        }

    }
    //Search data
    public function searchData($criteria=array(),$slug=FALSE,$limit=FALSE,$offset=FALSE){//random search
        if($limit){
            $this->db->limit($limit,$offset);
        }
        if($slug===FALSE){
            $sh=$criteria['randomsearch_input'];
            $this->db->select('*');
            $this->db->from('payment_tbl');
            //$this->db->join('gender_tbl','members_tbl.m_gender=gender_tbl.gender_id');
            $this->db->join('members_tbl','members_tbl.member_no=payment_tbl.member_id');
            $this->db->where("members_tbl.member_no LIKE '%".$sh."%' OR members_tbl.first_name LIKE '%".$sh."%' OR members_tbl.middle_name LIKE '%".$sh."%' OR members_tbl.last_name LIKE '%".$sh."%' OR members_tbl.phone_no LIKE '%".$sh."%' OR payment_tbl.paid_date LIKE '%".$sh."%' OR payment_tbl.amount LIKE '%".$sh."%'");
            $query=$this->db->get();
            return $query->result_array();
        }
        else{
            $query=$this->db->get_where(array('slug'=>$slug));
            return $query->row_array();
        }
    }
    public function totalRandomSearchContribution($criteria=array()){
        $sh=$criteria['randomsearch_input'];
        $this->db->select_sum('amount');
        $this->db->from('payment_tbl');
        //$this->db->join('gender_tbl','members_tbl.m_gender=gender_tbl.gender_id');
        $this->db->join('members_tbl','members_tbl.member_no=payment_tbl.member_id');
        $this->db->where("members_tbl.member_no LIKE '%".$sh."%' OR members_tbl.first_name LIKE '%".$sh."%' OR members_tbl.middle_name LIKE '%".$sh."%' OR members_tbl.last_name LIKE '%".$sh."%' OR members_tbl.phone_no LIKE '%".$sh."%' OR payment_tbl.paid_date LIKE '%".$sh."%' OR payment_tbl.amount LIKE '%".$sh."%'");
        $query=$this->db->get();
        return $query->result_array();
    }
    //Display all paymemts
    public function all_payments($slug=FALSE,$limit=FALSE,$offset=FALSE,$us){
        if($limit){
            $this->db->limit($limit,$offset);
        }
        if($slug===FALSE){
            $this->db->select('*');
            $this->db->from('payment_tbl');
            $this->db->join('members_tbl','payment_tbl.member_id=members_tbl.member_no');
            $this->db->join('month_tbl','payment_tbl.month_c=month_tbl.month_code');
            $this->db->where('added_by',$us);
            $this->db->order_by('payment_tbl.dated', 'DESC');
            $qry=$this->db->get();
            return $qry->result_array();
        }
        else{
            $query=$this->db->get_where(array('slug'=>$slug));
            return $query->row_array();
        }

    }
    public function totalContribution($us){
        $this->db->select_sum('amount');
        $this->db->where('added_by',$us);
        $qry=$this->db->get('payment_tbl');
        return $qry->result_array();
    }
    public function countContributionEntry(){
        return $this->db->count_all('payment_tbl');
    }
}
?>