<?php
class Admin_model extends CI_Model{
    /*--------------INSERT QUERIES STARTS HERE-------------------*/
    //New Member
    public function new_member($data){
        $qry=$this->db->insert('members_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Add kin
    public function add_kin($data){
        $qry=$this->db->insert('next_kin',$data);
        if($qry){return true;}
        else{return false;}
    }
    //New Admin
    public function new_admin($data){
        $qry=$this->db->insert('admin_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //New Contribution
    public function new_payment($data){
        $qry=$this->db->insert('payment_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Recording registration fees
    public function addregistrationfee($data){
        $qry=$this->db->insert('registrationfee_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Withdrawal
    public function new_withdrawal($data){
        $qry=$this->db->insert('withdraw_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Loan type
    public function addloantype($data){
        $qry=$this->db->insert('loan_type',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Add borrowed loans
    public function addborrowedloan($data){
        $qry=$this->db->insert('borrowed_loans',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Bulk member upload
    public function members_bulk_upload($data){
        $this->db->insert_batch('members_tbl',$data);
    }
    /*--------------INSERT QUERIES ENDS HERE-------------------*/

    /*--------------SELECT QUERIES STARTS HERE-------------------*/
    //Getting payment modes
    public function payment_mode(){
        $qry=$this->db->get('payment_mode');
        return $qry->result_array();
    }
    //Checking if admin exist with the provided email address
    public function check_admin($email){
        $this->db->where('email', $email);
        $qry=$this->db->get('members_tbl');
        if($qry->num_rows()>0){
            return $qry->row('email');
        }
    }

    //Login process
    public function confirm_member($id){
        $this->db->where('id',$id);
        $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('id');
        }
    }
    //Check member contribution
    public function confirm_memberno($no){
        $this->db->where('member_id',$no);
        $data=$this->db->get('payment_tbl');
        if($data->num_rows()>0){
            //return true;
            return $data->row('member_id');
        }
    }
    public function member_password($pass){
       $this->db->where('id',$pass);
       $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('password');
        }
    }
    public function member_role($role){
        $this->db->where('id',$role);
        $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('role');
        }
    }
    public function member_no($no){
        $this->db->where('id',$no);
        $data=$this->db->get('members_tbl');
        if($data->num_rows()>0){
            return $data->row('member_no');
        }
    }
    public function interest_rate($i){//getting interest rate
       $this->db->where('type_id',$i);
       $qry=$this->db->get('loan_type');
       if($qry->num_rows()>0){return $qry->row('interest_rate');}
    }
    public function payment_term($p){//getting term of payment
        $this->db->where('type_id',$p);
        $qry=$this->db->get('loan_type');
        if($qry->num_rows()>0){return $qry->row('payment_term');}
    }
    public function borrowedloan_details(){
        $this->db->select('*');
        $this->db->from('borrowed_loans');
        $this->db->join('members_tbl','borrowed_loans.borrower_id=members_tbl.member_no');
        $this->db->join('loan_type','borrowed_loans.type_id=loan_type.type_id');
        $qry=$this->db->get();
        return $qry->result_array();
    }

    //Gettting loggedin member/admin details
    public function member_details($det){
        $this->db->where('id', $det);
        $qry=$this->db->get('members_tbl');
        if($qry){
            return $qry->result_array();
        }
    }
    /*-------------------QUERY FOR THE MEMBER MODULE------------------------------*/
    //Contributions for loggedin member
    public function loggedmember_contribution($cont){
        /*$this->db->select('*');
        $this->db->from('payment_tbl');
        $this->db->join('month_tbl','payment_tbl.month_c=month_tbl.month_code');
        $this->db->where('member_id',$cont);
        $qry=$this->db->get();
        return $qry->result_array();*/
        $this->db->where('member_id', $cont);
        $qry=$this->db->get('payment_tbl');
        if($qry){
            return $qry->result_array();
        }
    }
    public function total_member_contribution($cont){
        $this->db->select_sum('amount');
        $this->db->where('member_id',$cont);
        $qry=$this->db->get('payment_tbl');
        return $qry->result_array();
    }
    public function total_member_withdraw($cont){
        $this->db->select_sum('amount');
        $this->db->where('member_id',$cont);
        $qry=$this->db->get('withdraw_tbl');
        return $qry->result_array();
    }
    //Contributions for loggedin member
    public function loggedmember_withdraw($cont){
        $this->db->where('member_id', $cont);
        $qry=$this->db->get('withdraw_tbl');
        if($qry){
            return $qry->result_array();
        }
    }
    /*-------------------QUERY FOR THE MEMBER MODULE------------------------------*/

    //Display all members
    public function all_members(){
        $this->db->select('*');
        $this->db->from('members_tbl');
        $this->db->join('gender_tbl','members_tbl.gender=gender_tbl.gender_id');
        $this->db->order_by('member_no','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    //Display all registration fee
    public function registration_fee(){
        $qry=$this->db->query("SELECT member_no,serial,first_name,middle_name,last_name,phone_no,member,dated, SUM(amount_paid) as fee FROM registrationfee_tbl JOIN members_tbl WHERE members_tbl.member_no=registrationfee_tbl.member GROUP BY registrationfee_tbl.member");

        /*$this->db->select('*');
        $this->db->from('registrationfee_tbl');
        $this->db->join('members_tbl','members_tbl.member_no=registrationfee_tbl.member');
        $this->db->order_by('dated','DESC');
        $qry=$this->db->get();*/
        return $qry->result_array();
    }
    public function registration_details($r){
        $this->db->select('*');
        $this->db->from('registrationfee_tbl');
        $this->db->join('members_tbl', 'members_tbl.member_no=registrationfee_tbl.member');
        $this->db->join('payment_mode','registrationfee_tbl.payment_mode=payment_mode.mode_id');
        $this->db->where('registrationfee_tbl.member=',$r);
        $this->db->order_by('dated', 'DESC');
        $qry = $this->db->get();
        return $qry->result_array();
    }
    public function specific_member($m){//getting specific member details
        $this->db->select('*');
        $this->db->from('members_tbl');
        $this->db->where('member_no',$m);
        $qry=$this->db->get();
        return $qry->result_array();
    }
    //Getting next of kin
    public function next_kin($ref_id){
        $this->db->select('*');
        $this->db->from('next_kin');
        $this->db->join('members_tbl','members_tbl.member_no=next_kin.member_no');
        $this->db->where('members_tbl.member_no',$ref_id);
        $this->db->order_by('added_date','DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    //Displaying all loan types
    public function all_loantypes(){
        $qry=$this->db->get('loan_type');
        return $qry->result_array();
    }
    //Display all paymemts
    public function all_payments($slug=FALSE,$limit=FALSE,$offset=FALSE){
        if($limit){
            $this->db->limit($limit,$offset);
        }
        if($slug===FALSE){
            $this->db->select('*');
            $this->db->from('payment_tbl');
            $this->db->join('members_tbl','payment_tbl.member_id=members_tbl.member_no');
            $this->db->join('month_tbl','payment_tbl.month_c=month_tbl.month_code');
            $this->db->order_by('payment_tbl.dated', 'DESC');
            $qry=$this->db->get();
            return $qry->result_array();
        }
        else{
            $query=$this->db->get_where(array('slug'=>$slug));
            return $query->row_array();
        }

    }
    //Display all paymemts
    public function all_withdrawals(){
        $this->db->select('*');
        $this->db->from('withdraw_tbl');
        $this->db->join('members_tbl','withdraw_tbl.member_id=members_tbl.member_no');
        $this->db->join('month_tbl','withdraw_tbl.month_c=month_tbl.month_code');
        $this->db->order_by('withdraw_tbl.withdraw_date', 'DESC');
        $qry=$this->db->get();
        return $qry->result_array();
    }
    //Getting gender
    public function get_gender(){
        $qry=$this->db->get('gender_tbl');
        return $qry->result_array();
    }
    //Getting months
    public function get_months(){
        $qry=$this->db->get('month_tbl');
        return $qry->result_array();
    }
    //Getting total contribution
    public function totalContribution(){
        $this->db->select_sum('amount');
        $qry=$this->db->get('payment_tbl');
        return $qry->result_array();
    }
    //Getting total searched contribution
    public function totalSearchContribution($c=array()){
        $search_dates=array(
            's_date'=>$c['start_date'],
            'e_date'=>$c['end_date']
        );
        $start=$c['start_date'];
        $end=$c['end_date'];
        $this->db->select_sum('amount');
        $this->db->where('paid_date >=',$start);
        $this->db->where('paid_date <=',$end);
        $this->session->set_userdata($search_dates);
        $qry=$this->db->get('payment_tbl');
        return $qry->result_array();
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
    //Getting total withdrawal
    public function totalWithdraw(){
        $this->db->select_sum('amount');
        $qry=$this->db->get('withdraw_tbl');
        return $qry->result_array();
    }
    //Getting total searched withdraw
    public function totalSearchWithdraw($c=array()){
        $search_dates=array(
            's_date'=>$c['start_date'],
            'e_date'=>$c['end_date']
        );
        $start=$c['start_date'];
        $end=$c['end_date'];
        $this->db->select_sum('amount');
        $this->db->where('w_date >=',$start);
        $this->db->where('w_date <=',$end);
        $this->session->set_userdata($search_dates);
        $qry=$this->db->get('withdraw_tbl');
        return $qry->result_array();
    }
    //Getting total members
    public function countMembers()
    {
        return $this->db->count_all("members_tbl");
    }
    public function countContributionEntry(){
        return $this->db->count_all('payment_tbl');
    }
    //Getting accounts summary
    public function contributionPerMember(){
        $this->db->select('*');
        $this->db->from('payment_tbl');
        $this->db->join('members_tbl','payment_tbl.member_id=members_tbl.member_no');
        $this->db->group_by('payment_tbl.member_id');
        $qry=$this->db->get();
        if($qry){
            return $qry->result_array();
        }
    }
    public function contribute(){
        $qry=$this->db->query("SELECT member_no,member_id,id,first_name,last_name, SUM(amount) as total FROM payment_tbl JOIN members_tbl WHERE members_tbl.member_no=payment_tbl.member_id GROUP BY payment_tbl.member_id ");//ORDER BY payment_tbl.date_recorded DESC
        if($qry){
            return $qry->result_array();
        }
    }

    public function contributed(){
        $qry=$this->db->query("SELECT member_no,payment_tbl.member_id,withdraw_tbl.member_id,id,first_name,last_name,dated,withdraw_date, SUM(payment_tbl.amount) as total FROM payment_tbl JOIN members_tbl,withdraw_tbl WHERE member_no=payment_tbl.member_id AND member_no=withdraw_tbl.member_id AND dated<=withdraw_date GROUP BY payment_tbl.member_id ");//ORDER BY payment_tbl.date_recorded DESC
        if($qry){
            return $qry->result_array();
        }
    }

    public function withdraw(){
        $qry=$this->db->query("SELECT member_id,id,member_no, SUM(amount) as total FROM withdraw_tbl JOIN members_tbl WHERE members_tbl.member_no=withdraw_tbl.member_id GROUP BY withdraw_tbl.member_id ORDER BY withdraw_tbl.withdraw_date DESC ");
        if($qry){
            return $qry->result_array();
        }
    }
    //Getting accounts summary
    public function withdrawalPerMember(){
        $this->db->select('*');
        $this->db->from('withdraw_tbl');
        $this->db->join('members_tbl','withdraw_tbl.member_id=members_tbl.member_no');
        $this->db->group_by('withdraw_tbl.member_id');
        $qry=$this->db->get();
        if($qry){
            return $qry->result_array();
        }
    }
    //Search contribution
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
            //$this->db->group_by('term');
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
    //Search withdrawal
    public function search_withdraw($s=array()){
        $seach_dates=array(
            's_date'=>$s['start_date'],
            'e_date'=>$s['end_date']
        );
        $start=$s['start_date'];
        $end=$s['end_date'];
        $this->db->select('*');
        $this->db->from('withdraw_tbl');
        $this->db->join('members_tbl','withdraw_tbl.member_id=members_tbl.member_no');
        $this->db->where('w_date >=',$start);
        $this->db->where('w_date <=',$end);
        $this->db->order_by('withdraw_date','DESC');
        $qry=$this->db->get();
        $this->session->set_userdata($seach_dates);
        return $qry->result_array();
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

    //Getting maximum member no
    public function max_no(){
        $this->db->select_max('member_no');
        $qry=$this->db->get('members_tbl');
        return $qry->result_array();
    }

    /*--------------SELECT QUERIES ENDS HERE-------------------*/

    /*--------------UPDATE QUERIES STARTS HERE-------------------*/
    //Update registration fee
    public function updateregfee($id,$data){
       $this->db->where('reg_id',$id);
       $qry=$this->db->update('registrationfee_tbl',$data);
       if($qry){return true;}
       else{return false;}
    }
    //Update contribution/payment
    public function updateContribution($id,$data){
        $this->db->where('pay_id',$id);
        $qry=$this->db->update('payment_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Update withdrawal
    public function updateWithdraw($id,$data){
        $this->db->where('withdraw_id',$id);
        $qry=$this->db->update('withdraw_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Update member details
    public function updateMember($id,$data){
        $this->db->where('member_no',$id);
        $qry=$this->db->update('members_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Update admin details
    public function update_admin($id,$data){
        $this->db->where('admin_id',$id);
        $qry=$this->db->update('admin_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Update admin password
    public function update_password($id,$data){
        $this->db->where('member_no',$id);
        $qry=$this->db->update('members_tbl',$data);
        if($qry){return true;}
        else{return false;}
    }
    //Recover lost password
    public function recoverPassword($email,$data){
        $this->db->where('email',$email);
        $qry=$this->db->update('members_tbl',$data);
        if($qry){
            return true;
        }
        else{
            return false;
        }
    }
    //Update loan type
    public function updateloantype($id,$data){
        $this->db->where('type_id',$id);
        $qry=$this->db->update('loan_type',$data);
        if($qry){return true;}
        else{return false;}
    }
    /*--------------UPDATE QUERIES ENDS HERE-------------------*/

    /*--------------DELETE QUERIES STARTS HERE-------------------*/
    //Delete reg fee
    public function deleteregfee($id){
        $this->db->where('reg_id',$id);
        $query=$this->db->delete('registrationfee_tbl');
        if($query){return true;}
        else{return false;}
    }
    //Delete loan type
    public function deleteloantype($id){
        $this->db->where('type_id',$id);
        $query=$this->db->delete('loan_type');
        if($query){return true;}
        else{return false;}
    }
    //delete payment
    public function deletePayment($id){
        $this->db->where('pay_id',$id);
        $query=$this->db->delete('payment_tbl');
        if($query){return true;}
        else{return false;}
    }
    //delete member
    public function deleteMember($id){
        $this->db->where('member_no',$id);
        $query=$this->db->delete('members_tbl');
        if($query){return true;}
        else{return false;}
    }
    public function deleteWithdraw($id){
        $this->db->where('withdraw_id',$id);
        $query=$this->db->delete('withdraw_tbl');
        if($query){return true;}
        else{return false;}
    }
    /*--------------DELETE QUERIES ENDS HERE-------------------*/

    //Loan calculator processing
    function check_loan_type($param = array()) {
        $exist = $this->db->get_where('loan_type', $param);
        if ($exist->num_rows() > 0) {
            return $exist->row();
        } else {return FALSE;}
    }
    /*LOAN CALCULATOR*/
    function calculate($amount, $loan_id)
    {
        //get loan parameters
        $loan = $this->check_loan_type(array('type_id' => $loan_id));

        //divisor
        switch ($loan->frequency) {
            case 'Monthly':
                $divisor = 1;
                $days = 30;
                break;
            case '2 Weeks':
                $divisor = 2;
                $days = 15;
                break;
            case 'Weekly':
                $divisor = 4;
                $days = 7;
                break;
        }
        //get the terms of payment
        $months=$loan->payment_term;
        //interest
        $amount_interest = $amount * ($loan->interest_rate/100)/$divisor;

        $amount_total = $amount + $amount_interest;
        //payment per term
        $amount_term = number_format(round($amount_total / ($months), 2) + 0, 2, '.', ',');

        //Loan info
        $table = '<div id="calculator"><h4 style="color: blue; font-weight: bold;">Loan Info</h4>';
        $table = $table . '<table class="table-responsive table table-bordered table-striped">';
        $table = $table . '<tr><td>Loan Name:</td><td>'.$loan->loan_type.'</td></tr>';
        $table = $table . '<tr><td>Interest:</td><td>'.$loan->interest_rate.'%</td></tr>';
        $table = $table . '<tr><td>Months:</td><td>'.$months * $divisor.'</td></tr>';
        $table = $table . '<tr><td>Frequency:</td><td>Period: '.$loan->frequency.'</td></tr>';
        $table = $table . '</table>';
        $table = $table . '<h4 style="color: blue; font-weight: bold;">Computation</h4>';
        $table = $table . '<table>';
        $table = $table . '<tr><td>Loan Amount:</td><td> '.$this->config->item('currency_symbol') . number_format($amount, 2, '.', ',').'</td></tr>';
        $table = $table . '<tr><td>Loan Interest:</td><td> '.$this->config->item('currency_symbol') . $amount_interest.'</td></tr>';
        $table = $table . '<tr><td>Amount Per Month:</td><td> '.$this->config->item('currency_symbol') . $amount_term.'</td></tr>';
        $table = $table . '<tr><td>Total Payment:</td><td> '.$this->config->item('currency_symbol') . number_format($amount_total, 2, '.', ',').'</td></tr>';
        $table = $table . '</table>';
        $table = $table . '<table class="table-responsive table table-bordered table-striped">';
        $table = $table . '<tr><td>Serial #</td><td>Amount('.$this->config->item('currency_symbol') .')</td></tr>';
        for ($i = 1; $i <= $months; $i++)
        {
            $table = $table . '<tr><td>'.$i.'</td><td>'.$amount_term.'</td></tr>';
        }
        $table = $table. '</table></div>';

        return $table;
    }

    public function add_loan($userID,$amount,$loan_date,$loanid){

        $loan = $this->check_loan_type(array('type_id' => $loanid));

        switch ($loan->frequency) {
            case 'Monthly':
                $divisor = 1;
                $days = 30;
                break;
            case '2 Weeks':
                $divisor = 2;
                $days = 15;
                break;
            case 'Weekly':
                $divisor = 4;
                $days = 7;
                break;
        }
        $months=$loan->payment_term;
        //interest
        $amount_interest = $amount * ($loan->interest_rate/100)/$divisor;
        $amount_total = $amount + $amount_interest;
        //payment per term
        $amount_term = $amount_total/$months;
        //$amount_term = number_format(round($amount_total / ($months), 2) + $amount_interest, 2, '.', ',');
        $date = $loan_date;

        $add_info = array(
            'borrower_id'=>$userID,
            'type_id'=>$loanid,
            'start_date'=>$loan_date,
            //'month'=>date('M'),
            'borrowed_amount'=>$amount,
            //'loan_months'=>$months,
            'interest_amount' => $amount_interest,
            'loan_amount_term' => $amount_term,
            'expected_amount' => $amount_total
        );

        $insert = $this->db->insert('borrowed_loans',$add_info);

        if ($insert) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
?>