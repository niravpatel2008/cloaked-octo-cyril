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

	public function autocomplete()
	{
		$get = $this->input->get();
		$term = $get['term'];
		$tags = $this->common_model->getAutocompleteTag($term);
		$tagsArr = array();
		foreach($tags as $tag)
		{
			$tagsArr[] = array("id"=>$tag['tag_id'],"value"=>$tag['tag_name'],"label"=>$tag['tag_name']);
		}
		echo json_encode($tagsArr);exit;
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
						return '<a title="Edit" href="'.site_url('/admin/stamp/edit/'.$d).'" class="fa fa-edit"></a> <a title="Delete" href="javascript:void(0);" onclick="delete_stamp('.$d.')" class="fa fa-trash-o"></a>';
					}
			),
		);
		$join1 = array(USERS,'u_id = t_uid');
		$join2 = array(TICKET_ALBUM,'al_id = t_albumid',"LEFT");
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
								't_price' => $post['t_price'],
								't_year' => $post['t_year'],
								't_bio' => $post['t_bio'],
								't_ownercountry' => $post['t_ownercountry'],
								't_uid' => (isset($post['t_uid']) && $post['t_uid'] != "")?$post['t_uid']:$this->user_session['u_id'],
								't_mainphoto'=> $post['t_mainphoto'],
								't_albumid' => $post['t_albumid'],
								't_created_date' => date('Y-m-d H:i:s'),
								't_modified_date' => date('Y-m-d H:i:s'),
								't_tags' => implode(',',$post['t_tags']),
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
							$this->common_model->insertData(TICKET_TAG_MAPPING, $tagmapdata);
						}
					}

					/*update deal id to uploaded image link*/
					$newimages = array_filter(explode(",",$post['newimages']));
					if (count($newimages) > 0)
						$this->common_model->assingImagesToStamp($ret_stamp,$newimages);


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
		//$data['albums'] = $this->common_model->selectData(TICKET_ALBUM, 'al_id,al_name',array("al_uid"=>$this->user_session['u_id']));
		$data['albums'] = $this->common_model->selectData(TICKET_ALBUM, 'al_id,al_name',array());
		$data['ticket_links'] = array();
		$data['view'] = "add_edit";
		$this->load->view('admin/content', $data);
	}

	public function edit($id)
	{
		if ($id == "" || $id <= 0) {
			redirect('admin/stamp');
		}

		$where = 't_id = '.$id;

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
				$tagStr = '';
				if(isset($post['t_tags']))
					$tagStr = implode(',',$post['t_tags']);
				$data = array('t_name' => $post['t_name'],
								't_price' => $post['t_price'],
								't_year' => $post['t_year'],
								't_bio' => $post['t_bio'],
								't_uid' => (isset($post['t_uid']) && $post['t_uid'] != "")?$post['t_uid']:$this->user_session['u_id'],
								't_mainphoto'=> $post['t_mainphoto'],
								't_ownercountry' => $post['t_ownercountry'],
								't_albumid' => $post['t_albumid'],
								't_modified_date' => date('Y-m-d H:i:s'),
								't_tags' => $tagStr,
							);
			
				$ret = $this->common_model->updateData(TICKET_COLLECTION, $data, $where);

				if ($ret > 0) {
					/*Add/Update tags */
					if(isset($post['t_tags']))
					{
						$post_tags = $post['t_tags'];
						$old_tags = $this->common_model->getTags($id,"stamp");

						foreach ($post_tags as $tag)
						{
							$tag = trim($tag);

							$found = false;
							foreach ($old_tags as $k=>$v)
							{
								if ($tag == $v['tag_name'])
								{
									$found = true;
									unset($old_tags[$k]);
								}
							}

							if ($found) continue;

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

							$tagmap = $this->common_model->selectData(TICKET_TAG_MAPPING,"*",array("tm_object_id"=>$id,"tm_tagid"=>$tagid,"tm_type"=>"stamp"));
							if (!$tagmap)
							{
								$tagmapdata =  array("tm_object_id"=>$id,"tm_tagid"=>$tagid,"tm_type"=>"stamp");
								$this->common_model->insertData(TICKET_TAG_MAPPING, $tagmapdata);
							}
						}
						//pr($old_tags,1);
						if (count($old_tags)>0)
						{
							$del_ids = array_reduce($old_tags,function($arr,$k){ $arr[] = $k['tag_id']; return $arr;});
							$this->common_model->deleteTags($del_ids,$id,"stamp");
						}
					}

					/*Deal Images sorting.*/
					if($post['sortOrder'] != "")
						$this->common_model->setImageOrder($post['sortOrder'],$id,'stamp');

					$flash_arr = array('flash_type' => 'success',
										'flash_msg' => 'Stamp updated successfully.'
									);
				}else{
					$flash_arr = array('flash_type' => 'error',
										'flash_msg' => 'An error occurred while processing.'
									);
				}
				$this->session->set_flashdata($flash_arr);
				//redirect("admin/stamp");
			}
			$data['error_msg'] = $error;
		}
		$data['stamp'] = $stamp = $this->common_model->selectData(TICKET_COLLECTION, '*', $where);
		if (empty($stamp)) {
			redirect('admin/stamp');
		}
		
		$data['users'] = $this->common_model->selectData(USERS, 'u_id,u_fname,u_email');
		$data['albums'] = $this->common_model->selectData(TICKET_ALBUM, 'al_id,al_name',array("al_uid"=>$this->user_session['u_id']));
		$data['ticket_links'] = $this->common_model->selectData(TICKET_LINKS, 'link_id,link_url',array("link_object_id"=>$id,"link_type"=>"stamp"),"link_order","ASC");
		$data['view'] = "add_edit";
		$data['t_tags'] = $this->common_model->getTags($id,"stamp");
		$this->load->view('admin/content', $data);
	}

	public function fileupload()
	{
		$file_name = "";
		$error = "";
		$post = $this->input->post();
		if($_FILES['file']['name'] != '' && $_FILES['file']['error'] == 0){
			$config['upload_path'] = UPLOADPATH;
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
			$imgPath = UPLOADPATH;
			
			if(!isset($post['from']))
				$resStamp = $this->common_model->deleteData(TICKET_COLLECTION, array('t_id' => $post['id'] )); ## Delete stamp details entry from Stamp(collection) table .
			
			$whereCol = 'link_object_id';
			if(isset($post['from']) && $post['from'] == 'addedit')
				$whereCol = 'link_id';
			$imgPath = $this->common_model->selectData(TICKET_LINKS, 'link_url',array($whereCol=>$post['id']));
			if(!empty($imgPath))
				deleteImage($imgPath);
			$ret = $this->common_model->deleteData(TICKET_LINKS, array($whereCol => $post['id'],"link_type"=>"stamp"));

			if ($ret > 0) {
				echo "success";
				#echo success_msg_box('record deleted successfully.');;
			}else{
				echo "error";
				#echo error_msg_box('An error occurred while processing.');
			}
		}
	}

	
}
