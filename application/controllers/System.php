<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {
	//Supports bulk upload of data
	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('csvimport');
        $this->load->library('csvimport');
		//$this->load->library('csvimport');
	}
	public function index()
	{
		$this->load->view('sign_in');
	}
	public function sign_up()
	{
		$this->load->view('sign_up');
	}
	public function forgot_password()
	{
		$this->load->view('forgot_password');
	}

	/* PASSWORD ENCRIPTOR FUNCTIONS */
	function getHashedPassword($pass){
		$newhashed= password_hash($pass,PASSWORD_DEFAULT);
		return $newhashed;
	}

	function verifyPassword($inputPassword,$hashedPassword){
		if(password_verify($inputPassword,$hashedPassword)){
			return true;
		}
		else{
			return false;
		}
	}
	public function login(){
		if(isset($_POST['login_btn'])){
		$id_no=$this->input->post('id_no');
		$pass=password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$member_id=$this->Admin_model->confirm_member($id_no);
			if($member_id){
				$member_pass=$this->Admin_model->member_password($id_no);
				$member_role=$this->Admin_model->member_role($id_no);
				$member_no=$this->Admin_model->member_no($id_no);
				if($this->verifyPassword($this->input->post('password'), $member_pass)){
					if($member_role=='admin'){
						$data=array(
							'id'=>$id_no,
							'role'=>'admin',
							'member_no'=>$member_no,
							'isloggedin'=>1
						);
						$this->session->set_userdata($data);
						redirect('System/dashboard');
					}
					elseif($member_role=='member'){
						$data=array(
							'id'=>$id_no,
							'role'=>'member',
							'member_no'=>$member_no,
							'isloggedin'=>1
						);
						$this->session->set_userdata($data);
						redirect('Member_controller/index');
					}
					else{
					//coming soon
					}

				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger">SORRY! the password provided is Invalid, please check and try again.</div>');
					redirect('System/index');
				}
			}
			else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">SORRY! the ID provided is Invalid!</div>');
				redirect('System/index');
			}
		}
	}
	public function dashboard(){
		$data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
		$data['total']=$this->Admin_model->totalContribution();
		$data['totMember']=$this->Admin_model->countMembers();
		$data['total_withdraw']=$this->Admin_model->totalWithdraw();
		$data['total_loan']=$this->Admin_model->total_loan();
        $data['total_repay']=$this->Admin_model->totalloanrepayment();
		$this->load->view('admin/inc/header',$data);
		$this->load->view('admin/inc/side_section');
		$this->load->view('admin/index');
		$this->load->view('admin/inc/footer');
	}
	public function members(){
		$data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
		$data['gender']=$this->Admin_model->get_gender();
		$data['members']=$this->Admin_model->all_members();
        $data['max_no']=$this->Admin_model->max_no();//getting maximum member no
		$this->load->view('admin/inc/header',$data);
		$this->load->view('admin/inc/side_section');
		$this->load->view('admin/members');
		$this->load->view('admin/inc/footer');
	}
    public function registration_fee(){
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['gender']=$this->Admin_model->get_gender();
        $data['members']=$this->Admin_model->all_members();
        $data['member1']=$this->Admin_model->registration_fee();
        $data['max_no']=$this->Admin_model->max_no();//getting maximum member no
        $data['payment_mode']=$this->Admin_model->payment_mode();
        $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/inc/side_section');
        $this->load->view('admin/registration_fees');
        $this->load->view('admin/inc/footer');
    }
    public function registrationfee_payment($r){
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['gender']=$this->Admin_model->get_gender();
        $data['members']=$this->Admin_model->all_members();
        $data['member1']=$this->Admin_model->registration_details($r);
        $data['max_no']=$this->Admin_model->max_no();//getting maximum member no
        $data['payment_mode']=$this->Admin_model->payment_mode();
        $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/inc/side_section');
        $this->load->view('admin/registrationfee_payment');
        $this->load->view('admin/inc/footer');
    }
    public function next_kin($no){
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['gender']=$this->Admin_model->get_gender();
        $data['spec_mem']=$this->Admin_model->specific_member($no);
        $data['kin']=$this->Admin_model->next_kin($no);
        $data['max_no']=$this->Admin_model->max_no();//getting maximum member no
        $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/inc/side_section');
        $this->load->view('admin/next_kin');
        $this->load->view('admin/inc/footer');
    }
	public function contributions($offset=0){
		if(isset($_POST['search_btn'])){
            //Pagination config
            $config['base_url'] = base_url() . 'index.php/System/contributions/';
            $config['total_rows'] = $this->db->count_all('payment_tbl');
            $config['per_page'] = 15;
            $config["uri_segment"] = 3;
            $config['attributes']=array('class'=>'pagination-link');
            //Init pagination
            $this->pagination->initialize($config);

			$data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
			$data['members']=$this->Admin_model->all_members();
			//$data['months']=$this->Admin_model->get_months();
			//$data['payments']=$this->Admin_model->all_payments();
			$data['total_s']=$this->Admin_model->totalSearchContribution($_POST);

			$data['payments']=$this->Admin_model->search_contribution($_POST);

			$this->load->view('admin/inc/header',$data);
			$this->load->view('admin/inc/side_section');
			$this->load->view('admin/contributions');
			$this->load->view('admin/inc/footer');
		}
		elseif (isset($_POST['randomsearch_btn'])){
            //Pagination config
            $config['base_url'] = base_url() . 'index.php/System/contributions/';
            $config['total_rows'] = $this->db->count_all('payment_tbl');
            $config['per_page'] = 15;
            $config["uri_segment"] = 3;
            $config['attributes']=array('class'=>'pagination-link');
            //Init pagination
            $this->pagination->initialize($config);

            $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
            $data['members']=$this->Admin_model->all_members();
            $data['total_randomsearch']=$this->Admin_model->totalRandomSearchContribution($_POST);
            $data['payments']=$this->Admin_model->searchData($_POST);//FALSE,$config['per_page'], $offset,
            $this->load->view('admin/inc/header',$data);
            $this->load->view('admin/inc/side_section');
            $this->load->view('admin/contributions');
            $this->load->view('admin/inc/footer');
        }
		else{
			//Pagination config
			$config['base_url'] = base_url() . 'index.php/System/contributions/';
			$config['total_rows'] = $this->db->count_all('payment_tbl');
			$config['per_page'] = 15;
			$config["uri_segment"] = 3;
			$config['attributes']=array('class'=>'pagination-link');
			//Init pagination
			$this->pagination->initialize($config);

			$data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
			$data['members']=$this->Admin_model->all_members();
			$data['months']=$this->Admin_model->get_months();
			$data['payments']=$this->Admin_model->all_payments(FALSE,$config['per_page'], $offset);//
			$data['total']=$this->Admin_model->totalContribution();
			$data['entry']=$this->Admin_model->countContributionEntry();
			$this->load->view('admin/inc/header',$data);
			$this->load->view('admin/inc/side_section');
			$this->load->view('admin/contributions');
			$this->load->view('admin/inc/footer');
		}
	}
	public function withdrawals(){
		if(isset($_POST['withdraw_search'])){
			$data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
			$data['members']=$this->Admin_model->all_members();
			//$data['months']=$this->Admin_model->get_months();
			//$data['payments']=$this->Admin_model->all_withdrawals();
			$data['withdraw']=$this->Admin_model->search_withdraw($_POST);
			$data['total_s']=$this->Admin_model->totalSearchWithdraw($_POST);


			$data['sum']=$this->Admin_model->contributed();

			$this->load->view('admin/inc/header',$data);
			$this->load->view('admin/inc/side_section');
			$this->load->view('admin/withdrawals');
			$this->load->view('admin/inc/footer');
		}
		else{
			$data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
			$data['members']=$this->Admin_model->all_members();
			$data['months']=$this->Admin_model->get_months();
			$data['withdraw']=$this->Admin_model->all_withdrawals();
			$data['total_withdraw']=$this->Admin_model->totalWithdraw();

			$data['sum']=$this->Admin_model->contributed();

			$this->load->view('admin/inc/header',$data);
			$this->load->view('admin/inc/side_section');
			$this->load->view('admin/withdrawals');
			$this->load->view('admin/inc/footer');
		}
	}
	public function account_summary(){
		$data['total']=$this->Admin_model->totalContribution();
		$data['total_drawn']=$this->Admin_model->totalWithdraw();

		//$data['confirm_no']=$this->Admin_model->confirm_no($no);

		$data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
		$data['members']=$this->Admin_model->all_members();
		$data['months']=$this->Admin_model->get_months();
		$data['payments']=$this->Admin_model->all_withdrawals();
		$data['totalSum']=$this->Admin_model->contributionPerMember();
		$data['sum']=$this->Admin_model->contribute();
		$data['subtract']=$this->Admin_model->withdraw();
		$this->load->view('admin/inc/header',$data);
		$this->load->view('admin/inc/side_section');
		$this->load->view('admin/account_summary');
		$this->load->view('admin/inc/footer');
	}
    public function loan_type(){
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['total']=$this->Admin_model->totalContribution();
        $data['totMember']=$this->Admin_model->countMembers();
        $data['total_withdraw']=$this->Admin_model->totalWithdraw();
        $data['loan_type']=$this->Admin_model->all_loantypes();
        $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/inc/side_section');
        $this->load->view('admin/loan_type');
        $this->load->view('admin/inc/footer');
    }
    public function loan_list(){
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['total']=$this->Admin_model->totalContribution();
        $data['totMember']=$this->Admin_model->countMembers();
        $data['borrowers']=$this->Admin_model->all_members();
        $data['loan_type']=$this->Admin_model->all_loantypes();
        $data['borrowdetails']=$this->Admin_model->borrowedloan_details();
        $data['loan_status']=$this->Admin_model->getRepaymentStatus();
        $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/inc/side_section');
        $this->load->view('admin/loan_list');
        $this->load->view('admin/inc/footer');
    }
    public function loan_repayment($id){//getPaidAmount
        $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
        $data['total']=$this->Admin_model->totalContribution();
        $data['totMember']=$this->Admin_model->countMembers();
        $data['total_withdraw']=$this->Admin_model->totalWithdraw();
        $data['loan_type']=$this->Admin_model->all_loantypes();
        $data['payment_mode']=$this->Admin_model->payment_mode();
        $data['borrow_id']=$this->Admin_model->getborrowedloan_id($id);
        $data['repayment_details']=$this->Admin_model->loan_repayment($id);
        $data['repaid_amount']=$this->Admin_model->getPaidAmount($id);
        $this->load->view('admin/inc/header',$data);
        $this->load->view('admin/inc/side_section');
        $this->load->view('admin/loan_repayment');
        $this->load->view('admin/inc/footer');
    }
    public function loan_calculator(){
        if(isset($_POST['calculate_btn'])){
            $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
            $data['total']=$this->Admin_model->totalContribution();
            $data['totMember']=$this->Admin_model->countMembers();
            $data['total_withdraw']=$this->Admin_model->totalWithdraw();
            $data['loan_type']=$this->Admin_model->all_loantypes();
            $data2['result']=$this->Admin_model->calculate($this->input->post('principle'),$this->input->post('loan_type'));
            $this->load->view('admin/inc/header',$data);
            $this->load->view('admin/inc/side_section');
            $this->load->view('admin/loan_calculator',$data2);
            $this->load->view('admin/inc/footer');
        }
        else{
            $data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
            $data['total']=$this->Admin_model->totalContribution();
            $data['totMember']=$this->Admin_model->countMembers();
            $data['total_withdraw']=$this->Admin_model->totalWithdraw();
            $data['loan_type']=$this->Admin_model->all_loantypes();
            $this->load->view('admin/inc/header',$data);
            $this->load->view('admin/inc/side_section');
            $this->load->view('admin/loan_calculator');
            $this->load->view('admin/inc/footer');
        }
    }
	public function profile(){
		$data['details']=$this->Admin_model->member_details($this->session->userdata('id'));
		$this->load->view('admin/inc/header',$data);
		$this->load->view('admin/inc/side_section');
		$this->load->view('admin/profile');
		$this->load->view('admin/inc/footer');
	}

	public function new_member(){
		if(isset($_POST['newmember_btn'])){
			$pass=1234;
			$qry=array(
                'serial'=>$this->input->post('member_no'),
				'first_name'=>$this->input->post('first_name'),
				'middle_name'=>$this->input->post('middle_name'),
				'last_name'=>$this->input->post('last_name'),
				'gender'=>$this->input->post('gender'),
				'id'=>$this->input->post('id'),
				'phone_no'=>$this->input->post('phone'),
				'box_address'=>$this->input->post('box_address'),
				'email'=>$this->input->post('email'),
				'role'=>$this->input->post('role'),
				'status'=>'Active',
				'password'=>password_hash($pass,PASSWORD_DEFAULT)
			);
			$result=$this->Admin_model->new_member($qry);
			if($result){
				$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Member account successfully created.</div>');
				redirect('System/members');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Member account not created. Please try again.</div>');
				redirect('System/members');
			}
		}
	}
    public function add_kin(){
        if(isset($_POST['addkin_btn'])){
            $qry=array(
                'member_no'=>$this->input->post('member_no'),
                'fullname'=>$this->input->post('fullname'),
                'relationship'=>$this->input->post('relationship'),
                'date_of_birth'=>$this->input->post('dob'),
                'kin_national_id'=>$this->input->post('id'),
                'kin_phone'=>$this->input->post('phone'),
                'box_address'=>$this->input->post('box_address'),
                'kin_email'=>$this->input->post('email'),
                'city'=>$this->input->post('city')
            );
            $result=$this->Admin_model->add_kin($qry);
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Kin successfully added.</div>');
                redirect('System/next_kin/'.$this->input->post('member_no'));
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Kin not added. Please try again.</div>');
                redirect('System/next_kin/'.$this->input->post('member_no'));
            }
        }
    }
    public function addregistrationfee(){
        if(isset($_POST['registrationfee_btn'])){
            $data=array(
                'member'=>$this->input->post('member'),
                'amount_paid'=>$this->input->post('amount'),
                'payment_date'=>$this->input->post('payment_date'),
                'comment'=>$this->input->post('comment'),
                'payment_mode'=>$this->input->post('pay_mode'),
                'recorded_by'=>$this->session->userdata['member_no']
            );
            $result=$this->Admin_model->addregistrationfee($data);
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Registration fee successfully recorded.</div>');
                redirect('System/registration_fee');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Registration fee not recorded. Please try again.</div>');
                redirect('System/registration_fee');
            }
        }
    }
    public function addloan_repayment(){
        if(isset($_POST['addrepayment_btn'])){
            $data=array(
                'borrowloan_id'=>$this->input->post('borrowedloan_id'),
                'paid_amount'=>$this->input->post('amount'),
                //'comment'=>$this->input->post('comment'),
                'payment_mode'=>$this->input->post('pay_mode'),
                'payment_date'=>$this->input->post('repayment_date')
                //'recorded_by'=>$this->session->userdata['member_no']
            );
            $result=$this->Admin_model->addloan_repayment($data);
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Repayment amount successfully recorded.</div>');
                redirect('System/loan_repayment/'.$this->input->post('borrowedloan_id'));
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Repayment amount not recorded. Please try again.</div>');
                redirect('System/loan_repayment/'.$this->input->post('borrowedloan_id'));
            }
        }
    }
	public function new_admin(){
		if(isset($_POST['signup_btn'])){
			$data=array(
				'national_id'=>$this->input->post('id_no'),
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'password'=>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			);
			$result=$this->Admin_model->new_admin($data);
			if($result){
				$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Admin account successfully created.</div>');
				redirect('System/sign_up');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Admin account not created. Please try again.</div>');
				redirect('System/sign_up');
			}
		}
	}
    public function addloantype(){
        if(isset($_POST['loantype_btn'])){
            $data=array(
                'loan_type'=>$this->input->post('loan_type'),
                'interest_rate'=>$this->input->post('interest_rate'),
                'frequency'=>$this->input->post('frequency'),
                'payment_term'=>$this->input->post('payment_term'),
            );
            $result=$this->Admin_model->addloantype($data);
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Loan type successfully added.</div>');
                redirect('System/loan_type');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Loan type no added. Please try again.</div>');
                redirect('System/loan_type');
            }
        }
    }
    //award loan
    public function addborrowedloan(){
        if(isset($_POST['borrowloan_btn'])){
            //SI=P*(R/100)*(T/12)
            $interest_rate=$this->Admin_model->interest_rate($this->input->post('frequency'));
            $term=$this->Admin_model->payment_term($this->input->post('frequency'));
            $frequency=$this->Admin_model->payment_frequency($this->input->post('frequency'));
            switch ($frequency) {
                case 'Monthly':
                    $divisor = 1;
                    $days = 30;
                    $tot1=$term*$days;
                    break;
                case '2 Weeks':
                    $divisor = 2;
                    $days = 15;
                    $tot1=$term*$days;
                    break;
                case 'Weekly':
                    $divisor = 4;
                    $days = 7;
                    $tot1=$term*$days;
                    break;
            }

            $i=($interest_rate/100)*($this->input->post('amount'))/$divisor;//*$term/12
            $a=$i+($this->input->post('amount'));
            $start_date=$this->input->post('start_date');
            $number_of_days=$tot1;
            $deadline=date('Y-m-d', strtotime($start_date. ' + '.$number_of_days.' days'));
            $data=array(
                'borrower_id'=>$this->input->post('borrower'),
                'type_id'=>$this->input->post('frequency'),
                'borrowed_amount'=>$this->input->post('amount'),
                'interest_amount'=>$i,
                'expected_amount'=>$a,
                'start_date'=>$this->input->post('start_date'),
                'deadline_date'=>$deadline,
                'loan_status'=>'PAID'
            );
            $result=$this->Admin_model->addborrowedloan($data);
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Loan transaction successfully added.</div>');
                redirect('System/loan_list');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Loan transaction not added. Please try again.</div>');
                redirect('System/loan_list');
            }
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
				redirect('System/contributions');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Contribution not added. Please try again later.</div>');
				redirect('System/contributions');
			}
		}
	}
	public function add_withdraw(){
		if(isset($_POST['withdraw_btn'])){
			$year=date('Y');
			$month=date('M');
			$qry=array(
				'member_id'=>$this->input->post('member'),
				'month_c'=>$month,
				'w_date'=>$this->input->post('date_txt'),
				'amount'=>$this->input->post('amount'),
				'year_name'=>$year
			);
			$result=$this->Admin_model->new_withdrawal($qry);
			if($result){
				$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Withdrawal successfully saved.</div>');
				redirect('System/withdrawals');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Withdrawal not added. Please try again later.</div>');
				redirect('System/withdrawals');
			}
		}
	}
	public function members_bulk_upload()
	{
		//$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
        //$file_data = get_array($_FILES["csv_file"]["tmp_name"]);
        $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
//exit();
		foreach($file_data as $row)
		{
			$pass=1234;
			$data[]= array(
				'first_name' => $row['First Name'],
				'middle_name' =>$row['Middle Name'],
				'last_name' =>$row['Last Name'],
				'gender' =>$row['Gender'],
				'id' =>$row['ID Number'],
				'phone_no' =>$row['Phone'],
				'box_address' =>$row['Address'],
				'email' =>$row['Email'],
				'role'=>$row['Role'],
				'status'=>'Active',
				'password'=>password_hash($pass,PASSWORD_DEFAULT)
			);
		}
		$import=$this->Admin_model->members_bulk_upload($data);
		if($import){
			$this->session->set_flashdata('message', ' <div class="alert alert-danger">Sorry! an error Occurred while trying to upload the data. Please try again.<button class="close" data-dismiss="alert" >&times;</button></div>');
			redirect('System/members');
		}
		else{

			$this->session->set_flashdata('message', ' <div class="alert alert-success">Members data Successfully Uploaded.<button class="close" data-dismiss="alert" >&times;</button></div>');
			redirect('System/members');
		}

	}

	/*------------------------------SELECT QUERIES STARTS HERE------------------------------*/
	//Recover Password
	public function recover_password(){
	if(isset($_POST['forgotpass_btn'])){
		$mail=$this->input->post('email');
		function randomPassword(){
			$alphabet="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$pass=array();
			$alphaLength=strlen($alphabet)-1;
			for($i=0; $i<8; $i++){
				$n=rand(0,$alphaLength);
				$pass[]=$alphabet[$n];
			}
			return implode($pass);
		}

		$newpassword=randomPassword();
		$new=password_hash($newpassword, PASSWORD_DEFAULT);

		$result=$this->Admin_model->check_admin($mail);
		if($result){
			// Configure email library
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'ssl://smtp.googlemail.com';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = 'journalreagan@gmail.com';
			$config['smtp_pass'] = 'Jevanjee40c';
			// load email library
			$this->load->library('email');
			// Loading email library and passing configured values to email library
			$config['mailtype'] = 'html';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['newline'] = "\r\n"; //use double quotes

			$this->email->initialize($config);

			// Sender email address
			$this->email->from('SEASONS HOTEL', 'CHAMA SYSTEM');
			// Receiver email address(recipient)
			$email=$mail;
			//The member to which the recovered password is sent to.
			$this->email->to($email);
			// Email subject
			$subject = 'Password Recovery';
			$message = 'Thank you for staying with us. Your new password is: <b style="color: green;">'.$newpassword.'</b>';
			$this->email->subject($subject);
			// Message in email
			$this->email->message($message);

			$sending_mail=$this->email->send();

			//end of smtp
			if ($sending_mail) {
				$p=array(
					'password'=>$new
				);
				$pass=$this->Admin_model->recoverPassword($mail,$p);
				if($pass){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><strong>SUCCESS</strong> Your new password has been sent to: '.$mail.'</div>');
					redirect('System/forgot_password');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger">SORRY! Your password recovery failed. Please try again later.</div>');
					redirect('System/forgot_password');
				}
			}
		}
		else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger">SORRY! Provided email address is invalid.</div>');
			redirect('System/forgot_password');
		}
	}
	}
	/*------------------------------SELECT QUERIES ENDS HERE------------------------------*/

    public function updateregfee(){
        if(isset($_POST['updateregfee_btn'])){
            $id=$this->uri->segment(3);
            $member=$this->input->post('member_number');
            $qry=array(
                'amount_paid'=>$this->input->post('amount_paid'),
                'payment_mode'=>$this->input->post('pay_mode')
            );
            $update=$this->Admin_model->updateregfee($id,$qry);
            if($update){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Data successfully updated.</div>');
                redirect('System/registrationfee_payment/'.$member);
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Data not updated. Please try again later.</div>');
                redirect('System/registrationfee_payment/'.$member);
            }
        }
    }
    public function updaterepayment(){
        if(isset($_POST['updaterepay_btn'])){
            $id=$this->uri->segment(3);
            $repay=$this->input->post('repay_id');
            $qry=array(
                'paid_amount'=>$this->input->post('amount_paid'),
                'payment_mode'=>$this->input->post('pay_mode')
            );
            $update=$this->Admin_model->updaterepayment($id,$qry);
            if($update){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Data successfully updated.</div>');
                redirect('System/loan_repayment/'.$repay);
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Data not updated. Please try again later.</div>');
                redirect('System/loan_repayment/'.$repay);
            }
        }
    }
	public function update_Contribution(){
		if(isset($_POST['updatepay_btn'])){
			$id=$this->uri->segment(3);
			$qry=array(
				//'month_c'=>$this->input->post('month_txt'),
				'amount'=>$this->input->post('amount_txt')
			);
			$update=$this->Admin_model->updateContribution($id,$qry);
			if($update){
				$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Contribution successfully updated.</div>');
				redirect('System/contributions');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Contribution not updated. Please try again later.</div>');
				redirect('System/contributions');
			}
		}
	}
	public function updateWithdraw(){
		if(isset($_POST['updatewithdraw_btn'])){
			$id=$this->uri->segment(3);
			$qry=array(
				//'month_c'=>$this->input->post('month_txt'),
				'amount'=>$this->input->post('amount_txt')
			);
			$update=$this->Admin_model->updateWithdraw($id,$qry);
			if($update){
				$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Data successfully updated.</div>');
				redirect('System/withdrawals');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Data not updated. Please try again later.</div>');
				redirect('System/withdrawals');
			}
		}
	}
	public function updateMemberDetails(){
		if(isset($_POST['updatemember_btn'])){
			$id=$this->uri->segment(3);
			$qry=array(
                'serial'=>$this->input->post('member_no'),
				'first_name'=>$this->input->post('first_name'),
				'middle_name'=>$this->input->post('middle_name'),
				'last_name'=>$this->input->post('last_name'),
				'gender'=>$this->input->post('gender'),
				'id'=>$this->input->post('id'),
				'phone_no'=>$this->input->post('phone'),
				'box_address'=>$this->input->post('box_address'),
				'email'=>$this->input->post('email'),
				'role'=>$this->input->post('role'),
                'status'=>$this->input->post('status')
			);
			$update=$this->Admin_model->updateMember($id,$qry);
			if($update){
				$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Member details successfully updated.</div>');
				redirect('System/members');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Member details not updated. Please try again later.</div>');
				redirect('System/members');
			}
		}
	}
	public function updateAdminDetails(){
		if(isset($_POST['updateadmin_btn'])){
			$id=$this->uri->segment(3);
			$qry=array(
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
			);
			$update=$this->Admin_model->update_admin($id,$qry);
			if($update){
				$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Details successfully updated.</div>');
				redirect('System/profile');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Details not updated. Please try again later.</div>');
				redirect('System/profile');
			}
		}
	}
	public function updatePassword(){
		if(isset($_POST['updatepass_btn'])){
			$id=$this->uri->segment(3);
			$new=$this->input->post('password');
			$confirm=$this->input->post('password1');
			if($new==$confirm){
				$qry=array(
					'password'=>password_hash($this->input->post('password'),PASSWORD_DEFAULT)
				);
				$update=$this->Admin_model->update_password($id,$qry);
				if($update){
					$this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Password successfully updated.</div>');
					redirect('System/profile');
				}
				else{
					$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Password not updated. Please try again later.</div>');
					redirect('System/profile');
				}
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Password do not match. Please check and try again.</div>');
				redirect('System/profile');
			}

		}
	}
    public function updateloantype(){
        if(isset($_POST['updateloantype_btn'])){
            $id=$this->uri->segment(3);
            $data=array(
                'loan_type'=>$this->input->post('loan_type'),
                'interest_rate'=>$this->input->post('interest_rate'),
                'frequency'=>$this->input->post('frequency'),
                'payment_term'=>$this->input->post('payment_term'),
            );
            $result=$this->Admin_model->updateloantype($id,$data);
            if($result){
                $this->session->set_flashdata('message','<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button><strong>Success! </strong>Data successfully updated.</div>');
                redirect('System/loan_type');
            }
            else{
                $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry! </strong>Data not updated. Please try again.</div>');
                redirect('System/loan_type');
            }
        }
    }
	/*--------------------------DELETE QUERIES STARTS HERE-------------------------- */
	//Delete payment
	public function deletePayment(){
		$id = $this->uri->segment(3);
		$result=$this->Admin_model->deletePayment($id);
		if($result){
			$this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Payment data successfully deleted.</div>');
			redirect('System/contributions');
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Payment data not deleted. Please try again later. </div>');
			redirect('System/contributions');
		}
	}
    //Delete loan type
    public function deleteloantype(){
        $id = $this->uri->segment(3);
        $result=$this->Admin_model->deleteloantype($id);
        if($result){
            $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
            redirect('System/loan_type');
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
            redirect('System/loan_type');
        }
    }
	//Delete payment
	public function deleteMember(){
		$id = $this->uri->segment(3);
		$confirm=$this->Admin_model->confirm_memberno($id);
		if($confirm){
			$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> You cannot delete this member. He/she already has contributions. </div>');
			redirect('System/members');
		}
		else{
			$result=$this->Admin_model->deleteMember($id);
			if($result){
				$this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Member details successfully deleted.</div>');
				redirect('System/members');
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Member details not deleted. Please try again later. </div>');
				redirect('System/members');
			}
		}

	}
	//delete registration fee
    public function deleteregfee(){
        $id = $this->uri->segment(3);
        $member=$this->input->post('member');
        $result=$this->Admin_model->deleteregfee($id);
        if($result){
            $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
            redirect('System/registrationfee_payment/'.$member);
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
            redirect('System/registrationfee_payment/'.$member);
        }
    }
	//Delete payment
	public function deleteWithdraw(){
		$id = $this->uri->segment(3);
		$result=$this->Admin_model->deleteWithdraw($id);
		if($result){
			$this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
			redirect('System/withdrawals');
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
			redirect('System/withdrawals');
		}
	}
    public function deleterepayment(){
        $id = $this->uri->segment(3);
        $r=$this->input->post('repay_id');
        $result=$this->Admin_model->deleterepayment($id);
        if($result){
            $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
            redirect('System/loan_repayment/'.$r);
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
            redirect('System/loan_repayment/'.$r);
        }
    }
    public function deleteloan(){
        $id = $this->uri->segment(3);
        $result=$this->Admin_model->deleteloan($id);
        if($result){
            $this->session->set_flashdata('message', '<div class="alert alert-success"><button class="close" data-dismiss="alert">&times;</button>Data successfully deleted.</div>');
            redirect('System/loan_list');
        }
        else{
            $this->session->set_flashdata('message','<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button><strong>Sorry!! </strong> Data not deleted. Please try again later. </div>');
            redirect('System/loan_list');
        }
    }

	//Session logout
	public function logout(){
		$this->session->unset_userdata('national_id');
		//$this->session->unset_userdata('isloggedin');
		$this->session->sess_destroy();
		redirect('System/index');
	}
}
