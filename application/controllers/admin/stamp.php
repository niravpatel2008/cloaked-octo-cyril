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
			array( 'db' => 't_name', 'dt' => 1 ),
			array( 'db' => 'al_name', 'dt' => 2 ),
			array( 'db' => 't_price',  'dt' => 3 ),
			array( 'db' => 't_year',  'dt' => 4 ),
			array( 'db' => 't_bio',  'dt' => 5 ),
			array( 'db' => 't_ownercountry',  'dt' => 6 ),
			array('db'        => 't_modified_date',
					'dt'        => 7,
					'formatter' => function( $d, $row ) {
						return date( 'jS M y', strtotime($d));
					}
			),
			array( 'db' => 't_id',
					'dt' => 8,
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
				
				$ret_stamp = $this->common_model->insertData(TICKET_COLLECTION, $data);

				if ($ret_stamp > 0) {
					/*ADd Tags*/
					$post_tags = $post['t_tags'];
					foreach ($post_tags as $tag)
					{
						$tag = trim($tag);
						$tagid = $this->common_model->selectData(TICKET_TAG,"tag_id",array("tag_name"=>$tag));
						if(!$tagid)
						{
							$tagdata =  array("tag_name"=>$tag);
							$tagid = $this->common_model->insertData(TICKET_TAG, $tagdata);
						}
						else
						{
							$tagid = ($tagid[0]->tag_id);
						}


						$tagmap = $this->common_model->selectData(TICKET_TAG_MAPPING,"*",array("tm_object_id"=>$ret_stamp,"tm_tagid"=>$tagid,"tm_type"=>"stamp"));
						if (!$tagmap)
						{
							$tagmapdata =  array("tm_object_id"=>$ret_stamp,"tm_tagid"=>$tagid,"tm_type"=>"stamp");
							$this->common_model->insertData(DEAL_MAP_TAGS, $tagmapdata);
						}
					}

					/*update deal id to uploaded image link*/
					$newimages = array_filter(explode(",",$post['newimages']));
					if (count($newimages) > 0)
						$this->common_model->assingImagesToDeal($ret_stamp,$newimages);


					/*Deal Images sorting.*/
					if($post['sortOrder'] != "")
						$this->common_model->setImageOrder($post['sortOrder'],$ret_stamp,"stamp");

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

	public function fileupload()
	{
		$file_name = "";
		$error = "";
		$post = $this->input->post();
		if($_FILES['file']['name'] != '' && $_FILES['file']['error'] == 0){
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';

			$file_name_arr = explode('.',$_FILES['file']['name']);
			$file_name_arr = array_reverse($file_name_arr);
			$file_extension = $file_name_arr[0];
			$file_name = $config['file_name'] = "stamp_".time().".".$file_extension;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('file'))
			{
				$e_flag = 1;
				$error = $this->upload->display_errors();
			}

			if ($error != "")
				echo "Error:".$error;
			else
			{
				$t_id = isset($post['t_id'])?$post['t_id']:"";
				$linkdata =  array("link_object_id"=>$t_id,"link_type"=>"stamp","link_url"=>$file_name);
				$link_id = $this->common_model->insertData(TICKET_LINKS, $linkdata);
				echo '{"id":"'.$link_id.'","path":"'.base_url()."uploads/stamp/".$file_name.'"}';
			}
			exit;
		}else
		{
			echo "Error: File not uploaded to server.";
		}
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
