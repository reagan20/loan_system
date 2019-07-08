<?php
class Member_controller extends CI_Controller{
    public function index(){
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['contributions']=$this->Admin_model->loggedmember_contribution($this->session->userdata('member_no'));
        $data['total_contributions']=$this->Admin_model->total_member_contribution($this->session->userdata('member_no'));
        $data['total_withdraw']=$this->Admin_model->total_member_withdraw($this->session->userdata('member_no'));
        //$data['total']=$this->Admin_model->totalContribution();
        //$data['totMember']=$this->Admin_model->countMembers();
        //$data['total_withdraw']=$this->Admin_model->totalWithdraw();
        $this->load->view('member/member_inc/header',$data);
        $this->load->view('member/member_inc/side_section');
        $this->load->view('member/index');
        $this->load->view('member/member_inc/footer');
    }
    public function my_profile(){
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['gender']=$this->Admin_model->get_gender();
        $this->load->view('member/member_inc/header',$data);
        $this->load->view('member/member_inc/side_section');
        $this->load->view('member/my_profile');
        $this->load->view('member/member_inc/footer');
    }
    public function withdraw(){
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['withdraw']=$this->Admin_model->loggedmember_withdraw($this->session->userdata('member_no'));
        $data['total_withdraw']=$this->Admin_model->total_member_withdraw($this->session->userdata('member_no'));
        $this->load->view('member/member_inc/header',$data);
        $this->load->view('member/member_inc/side_section');
        $this->load->view('member/withdraw');
        $this->load->view('member/member_inc/footer');
    }

    //Update password
    public function updatePassword(){
        if(isset($_POST['updatepass_btn'])){
            $id=$this->uri->segment(3);
            $new=$this->input->post('password');
            $confirm=$this->input->post('password1');
            if($new==$confirm){
                $qry=array(
                    'password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT)
                );
                $update=$this->Member_model->update_password($id,$qry);
                if($update){
                    $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Password successfully updated.</div>');
                    redirect('Member_controller/my_profile');
                }
                else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Password not updated. Please try again later.</div>');
                    redirect('Member_controller/my_profile');
                }
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Password do not match. Please check and try again.</div>');
                redirect('Member_controller/my_profile');
            }

        }
    }

    /*Updated code starts here*/
    public function contributions($offset=0){
        if(isset($_POST['search_btn'])){
            //Pagination config
            $config['base_url'] = base_url() . 'index.php/Member_controller/contributions/';
            $config['total_rows'] = $this->db->count_all('payment_tbl');
            $config['per_page'] = 15;
            $config["uri_segment"] = 3;
            $config['attributes']=array('class'=>'pagination-link');
            //Init pagination
            $this->pagination->initialize($config);

            $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
            $data['members']=$this->Admin_model->all_members();
            $data['total_s']=$this->Member_model->totalSearchContribution($_POST,$this->session->userdata('member_no'));

            $data['payments']=$this->Member_model->search_contribution($_POST);

            $this->load->view('member/member_inc/header',$data);
            $this->load->view('member/member_inc/side_section');
            $this->load->view('member/contributions');
            $this->load->view('member/member_inc/footer');
        }
        elseif (isset($_POST['randomsearch_btn'])){
            //Pagination config
            $config['base_url'] = base_url() . 'index.php/Member_controller/contributions/';
            $config['total_rows'] = $this->db->count_all('payment_tbl');
            $config['per_page'] = 15;
            $config["uri_segment"] = 3;
            $config['attributes']=array('class'=>'pagination-link');
            //Init pagination
            $this->pagination->initialize($config);

            $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
            $data['members']=$this->Admin_model->all_members();
            $data['total_randomsearch']=$this->Member_model->totalRandomSearchContribution($_POST);
            $data['payments']=$this->Member_model->searchData($_POST);//FALSE,$config['per_page'], $offset,
            $this->load->view('member/member_inc/header',$data);
            $this->load->view('member/member_inc/side_section');
            $this->load->view('member/contributions');
            $this->load->view('member/member_inc/footer');
        }
        else{
            //Pagination config
            $config['base_url'] = base_url() . 'index.php/Member_controller/contributions/';
            $config['total_rows'] = $this->db->count_all('payment_tbl');
            $config['per_page'] = 15;
            $config["uri_segment"] = 3;
            $config['attributes']=array('class'=>'pagination-link');
            //Init pagination
            $this->pagination->initialize($config);

            $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
            $data['members']=$this->Admin_model->all_members();
            //$data['months']=$this->Admin_model->get_months();
            $data['payments']=$this->Member_model->all_payments(FALSE,$config['per_page'], $offset,$this->session->userdata('member_no'));//
            $data['total']=$this->Member_model->totalContribution($this->session->userdata('member_no'));
            $data['entry']=$this->Member_model->countContributionEntry();
            $this->load->view('member/member_inc/header',$data);
            $this->load->view('member/member_inc/side_section');
            $this->load->view('member/contributions');
            $this->load->view('member/member_inc/footer');
        }
    }
    public function add_contribution(){
        if(isset($_POST['payment_btn'])){
            $year=date('Y');
            $month=date('M');
            $qry=array(
                'member_id'=>$this->input->post('member'),
                'month_c'=>$month,
                'paid_date'=>$this->input->post('paid_date'),
                'amount'=>$this->input->post('amount'),
                'year_name'=>$year,
                'added_by'=>$this->session->userdata['member_no']
            );
            $result=$this->Admin_model->new_payment($qry);
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Contribution successfully saved.</div>');
                redirect('Member_controller/contributions');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Contribution not added. Please try again later.</div>');
                redirect('Member_controller/contributions');
            }
        }
    }
}
?>