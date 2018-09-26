<?php
/***********************************************************/
class Dashboard extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('index.php/auth', 'refresh');
		}
	}
/***********************************************************/
	function index()
	{
		$data['_view'] = 'dashboard';
		$this->load->view('layouts/main',$data);
	}
/***********************************************************/
	public function teste(){
		$nome = 'CB'.Date('dmy').'01';
		echo($nome);
	}

}