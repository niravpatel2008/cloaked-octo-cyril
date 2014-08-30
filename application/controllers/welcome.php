<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->front_session = $this->session->userdata('front_session');
	}
	public function index()
	{
		$post = $this->input->post();
		if(isset($post['getStamps']) && $post['getStamps'] == '1')
		{
			/*$selectFields = '*';
			$where = array();
			$sortBy = 't_modified_date';
			$sortType = 'ASC';
			$limit =  20;
			$page = 1;
			$stampRes = $this->common_model->selectData(TICKET_COLLECTION, $selectFields,$where,$sortBy,$sortType,'',$limit,$page);
			pr($stampRes,1);
			if (count($stampRes) > 0) {
				
			}*/

			$where = array();
			$sortBy = (isset($post) && isset($post['sortBy']))?$post['sortBy']:"t_modified_date";
			$sortType = (isset($post) && isset($post['sortType']))?$post['sortType']:"ASC";
			$page = (isset($post) && isset($post['page']))?$post['page']:1;
			$limit = (isset($post) && isset($post['limit']))?$post['limit']:21;
			$selectFields = (isset($post) && isset($post['selectFields']))?$post['selectFields']:"*";
			$stampRes = $this->common_model->selectData(TICKET_COLLECTION, $selectFields,$where,$sortBy,$sortType,'',$page,$limit);
			if (count($stampRes) > 0) {
				echo json_encode($stampRes);exit;	
			}else
				return null;
			//pr($stampRes,1);
			
		}
		$data['view'] = "index";
		$this->load->view('content', $data);
	}


	public function login()
	{
		$post = $this->input->post();
		$where = array('u_email' => $post['txtuseremail'],
							'u_password' => sha1(trim($post['txtpassword']))
						);
			$user = $this->common_model->selectData(USERS, '*', $where);
			
			if (count($user) > 0) {
				# create session
				$data = array('id' => $user[0]->u_id,
								'u_fname' => $user[0]->u_fname,
								'u_email' => $user[0]->u_email,
								'u_created_date' => $user[0]->u_created_date
							);
				$this->session->set_userdata('front_session',$data);
				echo "success";
			}else{
				echo "Invalid username or password";
			}

		}

	

	public function signup()
	{
		$post = $this->input->post();
		//echo '<pre>';print_r($post);die;
		if ($post) {
			$is_unique_email = $this->common_model->isUnique(USERS, 'u_email', trim($post['email']));

			if (!$is_unique_email) {
				echo 'Email already exists.';
				exit;
			}

			$data = array('u_fname' => $post['name'],
								'u_email' => $post['email'],				
								'u_password' => sha1(trim($post['password'])),
								'u_created_date' => date('Y-m-d H:i:s'),
								'u_modified_date' => date('Y-m-d H:i:s')
						);
			$ret = $this->common_model->insertData(USERS, $data);
			
			if ($ret > 0) {
				# create session
				$data = array('id' => $ret,
								'u_fname' => $post['name'],
								'u_email' => $post['email'],
								'u_created_date' => date('Y-m-d H:i:s')
							);
				$this->session->set_userdata('front_session',$data);

				$login_details = array('username' => $post['email'],
										'password' => trim($post['password'])
									);
				//$emailTpl = $this->get_welcome_tpl($login_details);
				//$ret = sendEmail($post['email'], SUBJECT_LOGIN_INFO, $emailTpl, FROM_EMAIL, FROM_NAME);
				$emailTpl = $this->load->view('email_templates/signup', '', true);

				$search = array('{username}', '{password}');
				$replace = array($login_details['username'], $login_details['password']);
				$emailTpl = str_replace($search, $replace, $emailTpl);

				$ret = sendEmail($post['email'], SUBJECT_LOGIN_INFO, $emailTpl, FROM_EMAIL, FROM_NAME);

				echo "success";
			}else{
				#show error
				echo "An error occurred while processing.";
			}

		}
	}

	public function autosuggest()
	{
		$get = $this->input->get();
		if (!isset($get["keyword"])) exit;
		$tag = $get["keyword"];
		$tags = $this->common_model->getTagAutoSuggest($tag);
		echo json_encode($tags);exit;
	}


	public function forgotpassword()
	{
		$post = $this->input->post();
		if ($post) {
			$where = array('u_email' => trim($post['txtemail']));
			$user = $this->common_model->selectData(USERS, '*', $where);
			if (count($user) > 0) {

				$newpassword = random_string('alnum', 8);
				$data = array('u_password' => sha1($newpassword));
				$upid = $this->common_model->updateData(USERS,$data,$where);

				$login_details = array('username' => $user[0]->u_email,'password' => $newpassword);
				$emailTpl = $this->load->view('email_templates/forgot_password', '', true);

				$search = array('{username}', '{password}');
				$replace = array($login_details['username'], $login_details['password']);
				$emailTpl = str_replace($search, $replace, $emailTpl);

				$ret = sendEmail($user[0]->u_email, SUBJECT_LOGIN_INFO, $emailTpl, FROM_EMAIL, FROM_NAME);
				print_r($ret);die;
				if ($ret) {
					echo "success";
				}else{
					echo 'An error occurred while processing.';
					exit;
				}

			}else{
				echo "User does not exist.";
				exit;
			}

		}
	}

	public function contact()
	{
		$post = $this->input->post();
		if ($post)
		{
		
		exit;
		}
		$data['view'] = 'contactus';
		$this->load->view('content',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
