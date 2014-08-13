<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->front_session = $this->session->userdata('front_session');
		is_front_login();
	}


	public function index()
	{

		$data['view'] = "index";
		$this->load->view('content', $data);
	}

	public function edit()
	{
		$post = $this->input->post();
		if ($post) {
			#pr($post);
			$error = array();
			$e_flag=0;
			if(trim($post['username']) == ''){
				$error['username'] = 'Please enter username.';
				$e_flag=1;
			}
			if(!valid_email(trim($post['email'])) && trim($post['email']) == ""){
				$error['email'] = 'Please enter email.';
				$e_flag=1;
			}
			if(trim($post['contact']) == ''){
				$error['contact'] = 'Please enter contact.';
				$e_flag=1;
			}

			if ($_FILES['profile_image']['error'] > 0) {
				$error['profile_image'] = 'Error in image upload.';
				$e_flag=1;
			}

			$config['file_name'] = $this->front_session['profile_picture'];
			if ($_FILES['profile_image']['error'] == 0) {
				if ($this->front_session['profile_picture'] != "") {
					unlink(DOC_ROOT_PROFILE_IMG.$this->front_session['profile_picture']);
				}
				$config['overwrite'] = TRUE;
				$config['upload_path'] = DOC_ROOT_PROFILE_IMG;
				$config['allowed_types'] = '*';

				$img_arr = explode('.',$_FILES['profile_image']['name']);
				$img_arr = array_reverse($img_arr);

				$config['file_name'] = $this->front_session['id']."_img.".$img_arr[0];

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload("profile_image"))
				{
					$error['profile_image'] = $this->upload->display_errors();
					$e_flag=1;
				}
			}

			if ($e_flag == 0) {

				$data = array('du_uname' => $post['username'],
								'du_contact' => $post['contact'],
								'du_email' => $post['email'],
								'du_profile_picture' => $config['file_name']
							);
				$ret = $this->common_model->updateData(DEAL_USER, $data, 'du_autoid = '.$this->front_session['id']);
				if ($ret > 0) {
					# update session
					$session_data = array('id' => $this->front_session['id'],
									'uname' => $post['username'],
									'contact' => $post['contact'],
									'email' => $post['email'],
									'profile_picture' => $config['file_name'],
									'create_date' => $this->front_session['create_date']
								);
					$this->session->set_userdata('front_session',$session_data);
					$this->front_session = $this->session->userdata('front_session');

					$flash_arr = array('flash_type' => 'success',
										'flash_msg' => 'Profile updated successfully.'
									);
					#$this->session->set_flashdata($flash_arr);
				}else{
					$flash_arr = array('flash_type' => 'error',
										'flash_msg' => 'An error occurred while processing.'
									);
					#$this->session->set_flashdata($flash_arr);
				}
				$data['flash_msg'] = $flash_arr;
			}
			$data['error_msg'] = $error;
		}
		$result = $this->common_model->selectData(USERS,"*",$data);
		$data['view'] = "edit";
		$data['userinfo'] = $result;
		$this->load->view('content', $data);
	}

	public function change_password()
	{
		$post = $this->input->post();
		if ($post) {

			$error = array();
			$e_flag=0;
			if(trim($post['password']) == ''){
				$error['password'] = 'Please enter new password.';
				$e_flag=1;
			}
			if(trim($post['re_password']) == ''){
				$error['re_password'] = 'Please enter repeat password.';
				$e_flag=1;
			}
			if(trim($post['password']) != trim($post['re_password'])){
				$flash_arr = array('flash_type' => 'error',
									'flash_msg' => 'Both paswords should be same.'
								);
				$e_flag=1;
			}

			if ($e_flag == 0) {
				# update password
				$data = array('u_password' => sha1(trim($post['password'])) );
				$ret = $this->common_model->updateData(USERS, $data, 'u_id = '.$this->front_session['id']);

				if ($ret > 0) {
					$flash_arr = array('flash_type' => 'success',
										'flash_msg' => 'Password updated successfully.'
									);
					#$this->session->set_flashdata($flash_arr);
				}else{
					$flash_arr = array('flash_type' => 'error',
										'flash_msg' => 'An error occurred while processing.'
									);
					#$this->session->set_flashdata($flash_arr);
				}
			}

			$data['error_msg'] = $error;
			$data['flash_msg'] = @$flash_arr;
		}
		$data['view'] = "password";
		$this->load->view('content', $data);
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

/* End of file profile.php */
/* Location: ./application/controllers/profile.php */
