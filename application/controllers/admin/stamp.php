<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stamp extends CI_Controller {

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
			array( 'db' => 't_name', 'dt' => 0 ),
			array( 'db' => 'al_name', 'dt' => 0 ),
			array( 'db' => 't_price',  'dt' => 1 ),
			array( 'db' => 't_year',  'dt' => 2 ),
			array( 'db' => 't_bio',  'dt' => 3 ),
			array( 'db' => 't_ownercountry',  'dt' => 3 ),
			array('db'        => 't_modified_date',
					'dt'        => 4,
					'formatter' => function( $d, $row ) {
						return date( 'jS M y', strtotime($d));
					}
			),
			array( 'db' => 't_id',
					'dt' => 5,
					'formatter' => function( $d, $row ) {
						return '<a href="'.site_url('/admin/stamp/edit/'.$d).'" class="fa fa-edit"></a> <a href="javascript:void(0);" onclick="delete_stamp('.$d.')" class="fa fa-trash-o"></a>';
					}
			),
		);
		$join1 = array(USERS,'u_id = t_uid');
		$join2 = array(TICKET_ALBUM,'al_id = t_albumid');
		echo json_encode( SSP::simple( $post, TICKET_COLLECTION, "t_id", $columns,array($join1,$join2)) );exit;
	}

	public function add()
	{
		$post = $this->input->post();
		if ($post) {
			#pr($post);
			$error = array();
			$e_flag=0;

			if(trim($post['t_name']) == ''){
				$error['t_name'] = 'Please enter stamp name.';
				$e_flag=1;
			}
			
			if ($e_flag == 0) {
				$data = array('t_name' => $post['t_name'],
								't_url' => $post['t_url'],
								't_price' => $post['t_price'],
								't_year' => $post['t_year'],
								't_bio' => $post['t_bio'],
								't_ownercountry' => $post['t_ownercountry'],
								't_uid' => $this->user_session['u_id'],
								't_albumid' => $post['t_albumid'],
								't_created_date' => date('Y-m-d H:i:s'),
								't_modified_date' => date('Y-m-d H:i:s'),
							);
				
				$ret = $this->common_model->insertData(TICKET_COLLECTION, $data);

				if ($ret > 0) {
					$flash_arr = array('flash_type' => 'success',
										'flash_msg' => 'Stamp added successfully.'
									);
				}else{
					$flash_arr = array('flash_type' => 'error',
										'flash_msg' => 'An error occurred while processing.'
									);
				}
				$this->session->set_flashdata($flash_arr);
				redirect("admin/stamp");
			}
			$data['error_msg'] = $error;
		}

		$data['users'] = $this->common_model->selectData(USERS, 'u_id,u_fname,u_email');
		$data['albums'] = $this->common_model->selectData(TICKET_ALBUM, 'al_id,al_name',array("al_uid"=>$this->user_session['u_id']));
		
		$data['view'] = "add_edit";
		$this->load->view('admin/content', $data);
	}

	public function edit($id)
	{
		if ($id == "" || $id <= 0) {
			redirect('admin/stamp');
		}

		$where = 'u_id = '.$id;

		$post = $this->input->post();
		if ($post) {
			#pr($post);
			$error = array();
			$e_flag=0;

			if(trim($post['t_name']) == ''){
				$error['t_name'] = 'Please enter stamp name.';
				$e_flag=1;
			}

			if ($e_flag == 0) {

				$data = array('t_name' => $post['t_name'],
								't_url' => $post['t_url'],
								't_price' => $post['t_price'],
								't_year' => $post['t_year'],
								't_bio' => $post['t_bio'],
								't_ownercountry' => $post['t_ownercountry'],
								't_albumid' => $post['t_albumid'],
								't_modified_date' => date('Y-m-d H:i:s'),
							);
			
				$ret = $this->common_model->updateData(TICKET_COLLECTION, $data, $where);

				if ($ret > 0) {
					$flash_arr = array('flash_type' => 'success',
										'flash_msg' => 'Stamp updated successfully.'
									);
				}else{
					$flash_arr = array('flash_type' => 'error',
										'flash_msg' => 'An error occurred while processing.'
									);
				}
				$this->session->set_flashdata($flash_arr);
				redirect("admin/stamp");
			}
			$data['error_msg'] = $error;
		}
		$data['stamp'] = $stamp = $this->common_model->selectData(TICKET_COLLECTION, '*', $where);
		if (empty($stamp)) {
			redirect('admin/stamp');
		}

		$data['users'] = $this->common_model->selectData(USERS, 'u_id,u_fname,u_email');
		$data['albums'] = $this->common_model->selectData(TICKET_ALBUM, 'al_id,al_name',array("al_uid"=>$this->user_session['u_id']));
		$data['view'] = "add_edit";
		$this->load->view('admin/content', $data);
	}


	public function delete()
	{
		$post = $this->input->post();

		if ($post) {
			$ret = $this->common_model->deleteData(TICKET_COLLECTION, array('u_id' => $post['id'] ));
			if ($ret > 0) {
				echo "success";
				#echo success_msg_box('User deleted successfully.');;
			}else{
				echo "error";
				#echo error_msg_box('An error occurred while processing.');
			}
		}
	}
}
