<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends CI_Controller {

	function __construct(){
		parent::__construct();

		is_login();

		$this->user_session = $this->session->userdata('user_session');
	}

	public function index()
	{
		#pr($this->session->flashdata('flash_msg'));
		$data['view'] = "index";
		$this->load->view('admin/content', $data);
	}

	public function ajax_list($limit=0)
	{
		$post = $this->input->post();

		$columns = array(
			array( 'db' => 'u_fname', 'dt' => 0 ),
			array( 'db' => 'al_name', 'dt' => 1 ),
			array( 'db' => 'al_ownercountry',  'dt' => 2 ),
			array( 'db' => 'al_price',  'dt' => 3 ),
			array('db'        => 'u_created_date',
					'dt'        => 4,
					'formatter' => function( $d, $row ) {
						return date( 'jS M y', strtotime($d));
					}
			),
			array( 'db' => 'al_id',
					'dt' => 5,
					'formatter' => function( $d, $row ) {
						return '<a href="'.site_url('/admin/album/edit/'.$d).'" class="fa fa-edit"></a> <a href="javascript:void(0);" onclick="delete_album('.$d.')" class="fa fa-trash-o"></a>';
					}
			),
		);
		$join1 = array(USERS,'u_id = al_uid');
		echo json_encode( SSP::simple( $post, TICKET_ALBUM, "al_id", $columns,array($join1) ) );exit;
	}

	public function add()
	{
		$post = $this->input->post();
		if ($post) {
			#pr($post);
			$error = array();
			$e_flag=0;

			if(trim($post['al_name']) == ''){
				$error['al_name'] = 'Please enter album name.';
				$e_flag=1;
			}

			if ($e_flag == 0) {
				$data = array('al_name' => $post['al_name'],
								'al_uid' => $this->user_session['u_id'],
								'al_ownercountry' => $post['al_ownercountry'],
								'al_price' => $post['al_price'],
								'al_url' => $post['al_url'],
								'al_created_date' =>  date('Y-m-d H:i:s'),
								'al_modified_date' => date('Y-m-d H:i:s')
							);
				
				$ret = $this->common_model->insertData(TICKET_ALBUM, $data);

				if ($ret > 0) {
					$flash_arr = array('flash_type' => 'success',
										'flash_msg' => 'Album added successfully.'
									);
				}else{
					$flash_arr = array('flash_type' => 'error',
										'flash_msg' => 'An error occurred while processing.'
									);
				}
				$this->session->set_flashdata($flash_arr);
				redirect("admin/album");
			}
			$data['error_msg'] = $error;
		}
		$data['users'] = $this->common_model->selectData(USERS, 'u_id,u_fname,u_email');
		$data['view'] = "add_edit";
		$this->load->view('admin/content', $data);
	}

	public function edit($id)
	{
		if ($id == "" || $id <= 0) {
			redirect('admin/album');
		}

		$where = 'u_id = '.$id;

		$post = $this->input->post();
		if ($post) {
			#pr($post);
			$error = array();
			$e_flag=0;

			if(trim($post['al_name']) == ''){
				$error['al_name'] = 'Please enter album name.';
				$e_flag=1;
			}
			
			if ($e_flag == 0) {

				$data = array('al_name' => $post['al_name'],
								'al_ownercountry' => $post['al_ownercountry'],
								'al_url' => $post['al_url'],
								'al_price' => $post['al_price'],
								'al_modified_date' => date('Y-m-d H:i:s')
							);

				$ret = $this->common_model->updateData(TICKET_ALBUM, $data, $where);

				if ($ret > 0) {
					$flash_arr = array('flash_type' => 'success',
										'flash_msg' => 'Album updated successfully.'
									);
				}else{
					$flash_arr = array('flash_type' => 'error',
										'flash_msg' => 'An error occurred while processing.'
									);
				}
				$this->session->set_flashdata($flash_arr);
				redirect("admin/album");
			}
			$data['error_msg'] = $error;
		}
		$data['album'] = $album= $this->common_model->selectData(TICKET_ALBUM, '*', $where);

		if (empty($album)) {
			redirect('admin/album');
		}
		$data['view'] = "add_edit";
		$data['users'] = $this->common_model->selectData(USERS, 'u_id,u_fname,u_email');
		$this->load->view('admin/content', $data);
	}


	public function delete()
	{
		$post = $this->input->post();

		if ($post) {
			$ret = $this->common_model->deleteData(TICKET_ALBUM, array('al_id' => $post['id'] ));
			if ($ret > 0) {
				echo "success";
			}else{
				echo "error";
			}
		}
	}
}