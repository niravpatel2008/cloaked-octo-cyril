<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

    function __construct(){
        parent::__construct();
		$this->front_session = $this->session->userdata('front_session');
    }

	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
