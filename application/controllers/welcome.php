<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->front_session = $this->session->userdata('front_session');
	}


	public function index()
	{
		/*$this->load->helper('htmltopdf/WKPDF_MULTI');
		$templateHtml = "<html><body><b>This is testing.</b></body></html>";
		$pdf = new WKPDF();
		$pdf->set_html($templateHtml);
		$pdf->render();
		$pdf->output('I','sample.pdf');
		exit;*/
		$data['categories'] = $this->common_model->selectData(DEAL_CATEGORY, 'dc_catname,dc_catid');
		$data['view'] = "index";
		$this->load->view('content', $data);
	}

	public function login()
	{
		$post = $this->input->post();
		$where = array('u_email' => $post['txtuseremail'],
							'u_password' => sha1(trim($post['txtpassword']))
						);
			$user = $this->common_model->selectData('users', '*', $where);
			if (count($user) > 0) {
				# create session
				$data = array('id' => $user[0]->u_id,
								'uname' => $user[0]->u_fname,
								'email' => $user[0]->u_email,
								'create_date' => $user[0]->u_create_date
							);
				$this->session->set_userdata('front_session',$data);
				echo "success";
			}else{
				echo "Invalid username or password";
			}

		}

	}

	public function signup()
	{
		$post = $this->input->post();
		//echo '<pre>';print_r($post);die;
		if ($post) {
			//$is_unique_email = $this->common_model->isUnique(DEAL_USER, 'du_email', trim($post['email']));

		/*	if (!$is_unique_email) {
				echo 'Email already exists.';
				exit;
			}*/

			$data = array('u_fname' => $post['name'],
								'u_email' => $post['email'],				
								'u_password' => sha1(trim($post['password'])),
								'u_created_date' => date('Y-m-d H:i:s'),
								'u_modified_date' => date('Y-m-d H:i:s')
						);
			$ret = $this->common_model->insertData('users', $data);
			echo $ret;die;
			if ($ret > 0) {
				# create session
				$data = array('id' => $ret,
								'uname' => $post['name'],
								'email' => $post['email'],
								'create_date' => date('Y-m-d H:i:s')
							);
				$this->session->set_userdata('front_session',$data);

				$login_details = array('username' => $post['email'],
										'password' => trim($post['password'])
									);
				$emailTpl = $this->get_welcome_tpl($login_details);
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
			$user = $this->common_model->selectData('users', '*', $where);
			if (count($user) > 0) {

				$newpassword = random_string('alnum', 8);
				$data = array('u_password' => sha1($newpassword));
				$upid = $this->common_model->updateData('users',$data,$where);

				$login_details = array('username' => $user[0]->u_email,'password' => $newpassword);
				$emailTpl = $this->get_forgotpassword_tpl($login_details);
				$ret = sendEmail($user[0]->u_email, SUBJECT_LOGIN_INFO, $emailTpl, FROM_EMAIL, FROM_NAME);
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
