<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends MY_backend
{
    function __construct()
    {
        parent::__construct();

		
		$GLOBALS['folder_foto_pengunjung'] = 'public/daftar_pengunjung_foto_pengunjung/';
		$this->allowed_types = array('jpg','jpeg','png','jpg','jpeg','svg');
		$this->file_size = array(10,10000);		
		$GLOBALS['thumb_foto_pengunjung'] = '145,200';			
        //library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->load->library('urlcrypt');
		
		//breadcrumb untuk navigasi
		$this->breadcrumb->add_crumb('Home');
		$this->breadcrumb->add_crumb('Pengunjung');
		
		$this->data['primary_title'] = '<i class="fa fa fa-gear"></i> Pengunjung';
		$this->data['sub_primary_title'] = '';
		
		$this->data['sub_title'] = 'Pengunjung';
		$this->layout->set_title($this->data['sub_title']);
		
		$this->table_daftar_pengunjung = 'daftar_pengunjung'; 
			
		$this->validation_rule();
    }
	
	// {VIEW} //
	function index(){
		$this->rule->type('R');
	
		$this->layout->set_include_group('index');
		$this->layout->set_include('inline',getview('index_js',$this->data));
		$this->layout->theme('backend','index', $this->data);	
	}
	
	function show(){
		$this->rule->type('R');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));

		$this->data['list'] = $this->wd_db->get_data_row($this->table_daftar_pengunjung,array('id'=>$id));
		
		$this->layout->theme('backend','show', $this->data);
	}
	
	// {VALIDATION RULE} //
	public function validation_rule(){
		$this->data['rules'] = array(
			array('field'   => 'nama_pengunjung', 'label' => 'Nama_pengunjung','rules'   => 'required|max_length=20'),
			array('field'   => 'tgl_daftar', 'label' => 'Tgl_daftar','rules'   => 'required|max_length=11'),
		);
		$this->data['rules_message'] = array();
	}
	
	function add(){
		$this->rule->type('C');
		array_push( $this->data['rules'],array('field'   => 'foto_pengunjung', 'label' => 'Foto_pengunjung','rules'   => 'required'));
		//Run validate with js
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');

		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js'));
		$this->layout->theme('backend','add', $this->data);	
	}
	
	function edit(){
		$this->rule->type('U');
		
		$this->wd_validation->run_validate_js($this->data['rules'],$this->data['rules_message'],'#dt_form','.validate-js-message');
		
		$this->load->library('urlcrypt');
		$id = $this->urlcrypt->decode($this->input->get('id'));
		
		$this->layout->set_include_group('form');
		$this->layout->set_include('inline',getview('form_js')); 

		$this->data['list'] = $this->wd_db->get_data_row($this->table_daftar_pengunjung,array('id'=>$id));
		
		$this->layout->theme('backend','edit', $this->data);	
	}
	
	// {ACTION} //
	function save_action(){
		$this->rule->type('C');

		if (isset($_FILES['foto_pengunjung']['name']) && $_FILES['foto_pengunjung']['name']!= '') {
			check_files('foto_pengunjung','/add',$this->file_size,$this->allowed_types);
			$updata = file_upload($GLOBALS['folder_foto_pengunjung'],'foto_pengunjung',$GLOBALS['thumb_foto_pengunjung'],'crop');
			if ($updata['error']==1) {
				$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/add');
				exit();
			}
			$foto_pengunjung = $updata['name'];
		}else{
			$foto_pengunjung = '';
		}
					
		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/add');

		$data = array(
			'nama_pengunjung' => $this->input->post('nama_pengunjung'),
			'tgl_daftar' => $this->input->post('tgl_daftar'),
			'foto_pengunjung' => $foto_pengunjung
		);
		
		$this->wd_db->add_dml_get_id($this->table_daftar_pengunjung,$data);
		
		redirect(admin_dir().this_module().'/add');
	}
	
	function update_action(){
		$this->rule->type('U');		
		$id = $this->input->post('id');
		$id = $this->urlcrypt->decode($id);

		if($this->ci_validation()==FALSE)
			redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
		
		$old = $this->wd_db->get_data($this->table_daftar_pengunjung,array('id' => $id)) ;

		if (isset($_FILES['foto_pengunjung']['name']) && $_FILES['foto_pengunjung']['name']!= '') {
			check_files('foto_pengunjung','/edit?id='.$this->input->post('id'),$this->file_size,$this->allowed_types);
			$updata = file_upload($GLOBALS['folder_foto_pengunjung'],'foto_pengunjung',$GLOBALS['thumb_foto_pengunjung'],'crop');
			if ($updata['error']==1) {
				$this->session->set_flashdata('danger_message', 'Error uploading file !!');
				redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));
				exit();
			}
			$foto_pengunjung = $updata['name'];
			@unlink($GLOBALS['folder_foto_pengunjung'].$old[0]['foto_pengunjung']);
			@unlink($GLOBALS['folder_foto_pengunjung'].'thumb/thumb_'.$old[0]['foto_pengunjung']);	
		}else{
			$foto_pengunjung = $old[0]['foto_pengunjung'];
		}
			
		$data = array(
			'nama_pengunjung' => $this->input->post('nama_pengunjung'),
			'tgl_daftar' => $this->input->post('tgl_daftar'),
			'foto_pengunjung' => $foto_pengunjung
		);

		
		
		$where = array(
			'id' => $id
		);
		
		$this->wd_db->edit_dml($this->table_daftar_pengunjung,$data,$where);
			
		redirect(admin_dir().this_module().'/edit?id='.$this->input->post('id'));	
	}
	
	function delete_action(){
		
		if($this->input->get('confirm') == null){
			$this->confirm_delete($this->table_daftar_pengunjung,'id','nama_pengunjung');
			return;
		}
			
		$del_id = $this->session->flashdata('del_id');
		$this->rule->type('D');
		foreach ($del_id as $id) {
			$old = $this->wd_db->get_data($this->table_daftar_pengunjung,array('id' => $id)) ;
			@unlink($GLOBALS['folder_foto_pengunjung'].$old[0]['foto_pengunjung']);
			@unlink($GLOBALS['folder_foto_pengunjung'].'thumb/thumb_'.$old[0]['foto_pengunjung']);
		}
		$this->wd_db->del_dml_where_in($this->table_daftar_pengunjung,'id',$del_id);
		
		redirect(admin_dir().this_module());
	}
	
	// {EXTEND FUNCTION} //
	public function dataTable() {
		$this -> load -> library('Datatable', array('model' => 'm_datatables', 'rowIdCol' => 'daftar_pengunjung.id'));
		$jsonArray = $this -> datatable -> datatableJson(array());


		foreach ($jsonArray['data'] as $index => $json) {
			$jsonArray['data'][$index]['daftar_pengunjung']['tgl_daftar']=convertDate($jsonArray['data'][$index]['daftar_pengunjung']['tgl_daftar'], 'd m y');

			$data = $json['daftar_pengunjung']['foto_pengunjung'];
			$size = FileSizeConvert("public/daftar_pengunjung_foto_pengunjung/$data");
			$jsonArray['data'][$index]['daftar_pengunjung']['foto_pengunjung']="<img title='$size' width='145px' alt='$data' src='".base_url()."public/daftarpengunjung_foto_pengunjung/$data'>";

		}

		$this -> output -> set_header('Pragma: no-cache');
        $this -> output -> set_header('Cache-Control: no-store, no-cache');
        $this -> output -> set_content_type('application/json') -> set_output(json_encode($jsonArray));
	}
}




/* End of file Pengunjung.php */
/* Location: ./application/modules/Pengunjung/controllers/Pengunjung.php */
/* Please DO NOT modify this information : */
/* Generated by IndonesiaIT Codeigniter CRUD Generator 2019-07-02 07:54:10 */
/* indonesiait.com */