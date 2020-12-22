<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'scripts/utils.php';
require "scripts/vendor/autoload.php";
//include MAINPATH.'stacxCron.php';

class Main extends CI_Controller {
	public $id = null;
	function __construct(){
		parent::__construct();
        $this->load->library('session');
        $this->load->model('Order_model');
		$this->load->model('Completed_model');
		$this->load->model('Neworder_model');
		$this->load->helper('file');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
        $this->output->nocache();

        $result=array();
		$resultData=array();
		$missedPages=array();
		$message='';
		define('REQIP',get_ip());
		define('REQID',uniqid());
		$this->id = $this->session->userdata('message');
		$this->load->library('Mylibrary');
		//$this->result=$result;		
	}
	

		public function index()
	{
		if(!$this->session->has_userdata('IsLogged'))
		{  
		   
		 redirect('Login');
		}
		GLOBAL $result;
		$data['result']=$result;
		$data['message']=$this->id;
		$data['orders']=$this->Order_model->getAllOrders();
		$data['categories']=$this->Order_model->getCategories();
		$this->load->view('templates/header');
		$this->load->view('main/index',$data);
		$this->load->view('templates/footer');
	}

	public function list(){
		GLOBAL $result;
		$data['result']=$result;
		$data['message']=$this->id;
		$data['docPDF']=$this->Order_model->getTDocuments($this->uri->segment(4));
		$data['categories']=$this->Order_model->getCategories();
		$data['types']=$this->Order_model->getAllHeaderTypes();
		$data['pages']=$this->Order_model->getTpagesByOrderUid($this->uri->segment(4));
		$data['DocumentType']=$this->Order_model->getAllDocumentType();
		$data['ocrDocuments']=$this->Order_model->getDocumentTypesByTpages();
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', FALSE);
		header('Pragma: no-cache');
		$this->load->view('templates/header');
		$this->load->view('main/list',$data);
		$this->load->view('templates/footer');
	}

		public function test(){
		GLOBAL $result;
		$data['result']=$result;
		$data['message']=$this->id;
		//$data['cats']=$this->Order_model->getAllCategories();
		$data['categories']=$this->Order_model->getCategories();

		$data['pages']=$this->Order_model->getTpagesByOrderUid(1);
		$data['DocumentType']=$this->Order_model->getAllDocumentType();
		$data['ocrDocuments']=$this->Order_model->getDocumentTypesByTpages();
		$this->load->view('templates/header');
		$this->load->view('main/test',$data);
		$this->load->view('templates/footer');
	}


	public function getT(){
		$filename=$_FILES['file']['name'];
		$parts = explode("/", $filename);
		$file= end($parts);
		$split_name=explode(".", $file);
		$orderNo=$split_name[0];
	
		if (is_dir(MAINPATH.$orderNo)) {
		//$this->deleteDirectory(MAINPATH.$orderNo);
		}
		if (!is_dir(MAINPATH.$orderNo)) {
			mkdir(MAINPATH.$orderNo, 0777, true);
		} 
		if(!empty($_FILES['file']['name'])){
                $config['upload_path'] = 'uploads/'.$orderNo.'/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                $config['file_name'] = $_FILES['file']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
            if (!file_exists(MAINPATH.$orderNo.'/'.$_FILES['file']['name'])) {   
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            
            }else{
            	$picture=$_FILES['file']['name'];
            }
    	}
		$data=$this->Order_model->getTpagesByOrderUid($file);
		echo json_encode($data);
		
		// write_file(MAINPATH.'docpdf.php',"jsjj");
		//$this->mylibrary->sendData($filename);
	}


	function ocrData(){
		//$count=0;
		$filename=$_FILES['file']['name'];
		// $data=array();
		
		// if ($count==0) {
		// 	$data=array('success'=>'success');
		// }

		//echo json_encode($data);
		$this->mylibrary->sendData($filename);

	}

	public function checkValid(){
		$file=$this->input->post('file');
		$page=$this->input->post('pageNo');
		$data=$this->Order_model->getTpagesd($file,$page);
		echo json_encode($data);
	}


	public function insertTpages(){
		$count=10;
		for ($i=1; $i <=$count ; $i++) { 
			$data=array('PageNo'=>$i,'CategoryName'=>'Disclosure','OrderUID'=>'1436826141-Disclosure.pdf');
			$this->Order_model->insertTpages($data);
		}
	}

	public function docDef(){
		$data['DocumentType']=$this->Order_model->getAllDocumentType();
		$data['PageSection']=$this->Order_model->getAllHeaderTypes();

		$this->load->view('templates/header');
		$this->load->view('main/docDef',$data);
		$this->load->view('templates/footer');
	}

	public function addorder(){
		
		$this->load->view('templates/header');
		$this->load->view('main/addorder');
		$this->load->view('templates/footer');
	}

	public function addDocDef(){
		$header_len=$this->input->post('header_length');
		$docType=$this->input->post('docType');
		$docdef_id=$this->input->post('docdef_id');
		$footer_len=$this->input->post('footer_length');
		$mand_key_count=$this->input->post('MandatoryKeywordsCount');
		$key_count=$this->input->post('KeywordsCount');
		$min_confidence=$this->input->post('min_confidence');
		$KeyWordCutOff=$this->input->post('KeyWordCutOff');
		$LowerCaseSearch=$this->input->post('LowerCaseSearch');
		$docTypeUID=$this->input->post('docTypeUID');
		$is_active=$this->input->post('is_active');
		date_default_timezone_set('Asia/Kolkata');
		$createdOn=date('Y-m-d H:i:s');
		if ($docdef_id!='') {
			$this->Order_model->deleteDocDef($docdef_id);
			$this->Order_model->deleteKeywords($docdef_id);
		}
		$data=array('HeaderLen'=>$header_len,'FooterLen'=>$footer_len,'MandKeyCount'=>$mand_key_count,'KeyCount'=>$key_count,'MinConfidence'=>$min_confidence,'KeyWordCutOff'=>$KeyWordCutOff,'LowerCaseSearch'=>$LowerCaseSearch,'DocTypeUID'=>$docTypeUID,'IsActive'=>$is_active,'CreatedOn'=>$createdOn,'DocType'=>$docType);
		$docdef_id=$this->Order_model->addDocDef($data);
		
		$resp=array('docdef_id'=>$docdef_id);
		echo json_encode($resp);
	}

	public function addDocDefKeywords(){
		date_default_timezone_set('Asia/Kolkata');
		$createdOn=date('Y-m-d H:i:s');
		
		$keywords=$this->input->post('keywords');
		$key_type=$this->input->post('key_type');
		$docdef_id=$this->input->post('docdef_id');
		$is_mandatory=$this->input->post('is_mandatory');
		$headerkey=array('IsMandatory'=>$is_mandatory,'KeyType'=>$key_type,'Keywords'=>$keywords,'DocDefUID'=>$docdef_id,'CreatedOn'=>$createdOn);
		$this->Order_model->addDocDefKeywords($headerkey);
		$this->writeJson();
		$resp=array('success'=>'successfull');
		echo json_encode($resp);

	}


	public function getDocDef(){
		$DocumentTypeUID=$this->input->post('docTypeUID');

		$data['docdef']=$this->Order_model->getDocDefById($DocumentTypeUID);
		$data['types']=$this->Order_model->getAllHeaderTypes();
		 if ($data['docdef']) {
		
		$data['keywords']=$this->Order_model->getKeywordsByDocDefId($data['docdef']['DocDefUID']);
		 }
		echo json_encode($data);
	}

	public function getCategoriesByHash(){
		$HashCode=$this->input->post('CategoryName');
		$data=$this->Order_model->getCategoriesByHash($HashCode);
		echo json_encode($data);
	}

	public function writeJson(){
		
		$docdef=$this->Order_model->getAllDocDef();
		$keywords=$this->Order_model->getAllKeywords();
		$def='{"Count":"'.count($docdef).'",';
		$count=0;
		foreach ($docdef as $d) {
			$mand='';
				$normal='';
				$count_mand=0;
				$count_norm=0;
				
			foreach ($keywords as $k) {
				
				if ($d['DocDefUID']==$k['DocDefUID'] && $k['IsMandatory']==1) {
					$count_mand++;
					if ($count_mand>1) {
						$mand.=',';
					}else{
						$mand.='';
					}
					$explode=explode(',', $k['Keywords']);
					$string='"'.implode('","',array_unique($explode)).'"';
					$mand.='{"'.$k['KeyType'].'":['.$string.']}';

				}
				

				if ($d['DocDefUID']==$k['DocDefUID'] && $k['IsMandatory']==0) {
					$count_norm++;
					if ($count_norm>1) {
						$normal.=',';
					}else{
						$normal.='';
					}
					$explode=explode(',', $k['Keywords']);
					$string='"'.implode('","',array_unique($explode)).'"';
					$normal.='{"'.$k['KeyType'].'":['.$string.']}';
				}
				
			}
			$count++;
			
			$def.='"'.$d['DocType'].'":{"Header":"'.$d['HeaderLen'].'","Footer":"'.$d['FooterLen'].'","KeyWordCutOff":"'.$d['KeyWordCutOff'].'","LowerCaseSearch":"'.$d['LowerCaseSearch'].'","Confidence":"'.$d['MinConfidence'].'","docTypeUID":"'.$d['DocTypeUID'].'","KeywordsCount":"'.$d['KeyCount'].'","MandatoryKeywordsCount":"'.$d['MandKeyCount'].'","MandatoryKeywords":['.$mand.'],"Keywords":['.$normal.']}';
			if (count($docdef)>1 && count($docdef)!=($count)) {
				$def.=',';
			}else{
				$def.='';
			}
		}
		$def.='}';
	
		//write_file(MAINPATH.'json/docDef.json',$def);
		$fp = fopen(MAINPATH.'json/docDef.json', 'w');
				fwrite($fp,$def);
					fclose($fp);
		// $fp = fopen(MAINPATH.'docDef.json', 'w');
		// 		chmod(MAINPATH.'docDef.json', 0777); 
		// 		chown(MAINPATH.'docDef.json', 'www-data');
		// 		fwrite($fp,$def);
		// 		fclose($fp);
	}

	public function getOrderList(){
		$data = $row = array();
        
        // Fetch member's records
        $memData = $this->Neworder_model->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($memData as $member){
            $i++;
            $count=0;
            $tdoc=$this->Order_model->getTDocs($member->OrderUID);
            if ($tdoc) {
            	$filepath=MAINPATH.$tdoc['DocumentURL'];
            	if (file_exists($filepath)) {
            		$cmd='gs -q -dNODISPLAY -c "('.$filepath.') (r) file runpdfbegin pdfpagecount = quit"';
					$count=exec($cmd);
            	}else{
            		$count=0;
            	}
            	$resp=array('DocumentUID'=>$tdoc['DocumentUID'],'TotalPages'=>$count);
            	$this->Order_model->insertTDocument($resp);
            }else{
            	$count=0;
            }

            $pages=$this->Order_model->getOrderslistByOrderUid($member->OrderUID);
			$data[] = array($i, '<a onclick="send('.$member->OrderUID.')" class="order_num" style="cursor: pointer;text-decoration:underline;color:blue;">'.$member->OrderNumber.'</a>',
			$member->OrderUID,             	
            $member->LoanNumber);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Neworder_model->countAll(),
            "recordsFiltered" => $this->Neworder_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }
	public function getLists(){
        $data = $row = array();
        
        // Fetch member's records
        $memData = $this->Order_model->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($memData as $member){
            $i++;
            $count=0;
            $tdoc=$this->Order_model->getTDocs($member->OrderUID);
            if ($tdoc) {
            	$filepath=MAINPATH.$tdoc['DocumentURL'];
            	if (file_exists($filepath)) {
            		$cmd='gs -q -dNODISPLAY -c "('.$filepath.') (r) file runpdfbegin pdfpagecount = quit"';
					$count=exec($cmd);
            	}else{
            		$count=0;
            	}
            	$resp=array('DocumentUID'=>$tdoc['DocumentUID'],'TotalPages'=>$count);
            	$this->Order_model->insertTDocument($resp);
            }else{
            	$count=0;
            }
            
            $data[] = array($i, 
            	'<a onclick="send('.$member->OrderUID.')" class="order_num" style="cursor: pointer;text-decoration:underline;color:blue;">'.$member->OrderNumber.'</a>', 
            	$member->OrderUID,             	
            $member->LoanNumber,
        	$count);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Order_model->countAll(),
            "recordsFiltered" => $this->Order_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }


    public function getCompletedLists(){
        $data = $row = array();
        
        // Fetch member's records
        $memData = $this->Completed_model->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($memData as $member){
            $i++;
            $count=0;
            $tdoc=$this->Order_model->getTDocs($member->OrderUID);
            if ($tdoc) {
            	$filepath=MAINPATH.$tdoc['DocumentURL'];
            	if (file_exists($filepath)) {
            		$cmd='gs -q -dNODISPLAY -c "('.$filepath.') (r) file runpdfbegin pdfpagecount = quit"';
					$count=exec($cmd);
            	}else{
            		$count=0;
            	}
            	$resp=array('DocumentUID'=>$tdoc['DocumentUID'],'TotalPages'=>$count);
            	$this->Order_model->insertTDocument($resp);
            }else{
            	$count=0;
            }

            $pages=$this->Order_model->getOrdersByOrderUid($member->OrderUID);
            $data[] = array($i, 
            	'<a href="'.base_url().'main/list/'.$pages['OrderNumber'].'/'.$pages['OrderUID'].'/'.$pages['LoanNumber'].'.pdf" class="order_num" style="cursor: pointer;text-decoration:underline;color:blue;">'.$member->OrderNumber.'</a>', 
            	$member->OrderUID,             	
            $member->LoanNumber,'<button class="btn btn-danger btn-sm" style="padding: 0px 10px;" onclick="reRunOCR('.$member->OrderUID.')">Re-Run</button>');
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Completed_model->countAll(),
            "recordsFiltered" => $this->Completed_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }


    public function updateManualTPages(){
		$OrderUID=$this->input->post('OrderUID');
		$manualOCR=$this->input->post('manualOCR');
		$pageNo=$this->input->post('pageNo');
		$data=array('OrderUID'=>$OrderUID,'manualDocumentTypeUID'=>$manualOCR,'pageNo'=>$pageNo);
		$this->Order_model->updateManualTPages($data);
		$resp=array('success'=>'success');
		echo json_encode($resp);
	}



	public function import(){
		if($_FILES['file']['name']!=""){

		//load library
		$this->load->library('upload');

		//Set the config
		$config['upload_path'] = './json/'; //Use relative or absolute path
		$config['allowed_types'] = 'gif|jpg|png|json|txt'; 
		$config['max_size'] = '5000';
		$config['max_width'] = '1900';
		$config['max_height'] = '1200';
		$config['overwrite'] = FALSE; //If the file exists it will be saved with a progressive number appended

		//Initialize
		$this->upload->initialize($config);

		//Upload file
		if( ! $this->upload->do_upload("file")){

		//echo the errors
		echo $this->upload->display_errors();
		}


		//If the upload success
		$image ="json/".$this->upload->file_name;

		//Save the file name into the db
		}else{

		$image='';

		}
		$json=file_get_contents(base_url().$image);
		//$json=file_get_contents(base_url().'docDef.json');
		
		$fdata=json_decode($json);
		$this->Order_model->deleteAllDocDef();
		$this->Order_model->deleteAllDocDefKeywords();
		$Count=0;
		$docName='';
		// Document Type Array loop
		foreach ($fdata as $key => $value){ 

			if ($key == 'Count') {
				$Count=$value;	
			}else{
				$DocumentTypeName = ucfirst($key);
				$data=array('DocumentTypeName'=>$DocumentTypeName);
				$DocumentTypeUID = $this->Order_model->insertDocumentTypes($data);
				$MandatoryKeywordsCount=0;
				$ManKeyCount =0; 
				$KeywordsCount =0;
				$Confidence=0; 
				$docTypeUID=0;
				$Header=0;
				$Footer=0;
				$KeyWordCutOff=0;
				$LowerCaseSearch=0;
				$MandatoryKeywords=[];
				$Keywords=0;
				$docType=$key;
				$is_mandatory=0;
				
				// Document Keywords Array loop
				foreach( $value as $k => $v) { 
				//$MandHeadArray='';
				$prefixMH = $MandHeadArray = '';
				$prefixMB = $MandBodyArray= '';
				$prefixMF = $MandFootArray= '';
				$prefixKH = $KeyHeadArray= '';
				$prefixKB = $KeyBodyArray= '';
				$prefixKF = $KeyFootArray= '';
					if ($k == 'Confidence') $Confidence=$v;
					if ($k == 'KeywordsCount') $KeywordsCount=$v;
					if ($k == 'MandatoryKeywordsCount') $MandatoryKeywordsCount=$v;
					if ($k == 'docTypeUID') $docTypeUID=$v;
					if ($k == 'Header') $Header=$v;
					if ($k == 'Footer') $Footer=$v;
					if ($k == 'KeyWordCutOff') $KeyWordCutOff=$v;
					if ($k == 'LowerCaseSearch') $LowerCaseSearch=$v;
					if ($k == 'MandatoryKeywords') $MandatoryKeywords=$v;
					if ($k == 'Keywords') $Keywords=$v;

					if (!empty($MandatoryKeywords) && empty($Keywords)) {
					// Add docdef
					$is_active=1;
					date_default_timezone_set('Asia/Kolkata');
					$createdOn=date('Y-m-d H:i:s');

					$data=array('HeaderLen'=>$Header,'FooterLen'=>$Footer,'MandKeyCount'=>$MandatoryKeywordsCount,'KeyCount'=>$KeywordsCount,'MinConfidence'=>$Confidence,'KeyWordCutOff'=>$KeyWordCutOff,'LowerCaseSearch'=>$LowerCaseSearch,'DocTypeUID'=>$DocumentTypeUID,'IsActive'=>$is_active,'CreatedOn'=>$createdOn,'DocType'=>$docType);
					$duplicates=$this->Order_model->checkForDuplicates($docTypeUID);
					//if (empty($duplicates)) {
						$docdef_id=$this->Order_model->addDocDef($data);
					// }else{
					// 	$docdef_id=$duplicates['docdef_id'];
					// }
					
					// end docdef

						foreach ($MandatoryKeywords as $mv) {
							$is_mandatory=1;
						// $List = implode(', ', $Array); 
							foreach ($mv as $mmk=>$mmv) {
								if($mmk=='Header'){
									//$MandHeadArray[] = implode(', ', $mmv); 
									foreach($mmv as $fv){
									$MandHeadArray .= $prefixMH . '' . $fv . '';
	    							$prefixMH = ', '; 	
									}
									$headerkey=array('IsMandatory'=>$is_mandatory,'KeyType'=>$mmk,'Keywords'=>$MandHeadArray,'DocDefUID'=>$docdef_id,'CreatedOn'=>$createdOn);
									
										$this->Order_model->addDocDefKeywords($headerkey);
									
									
								}

								if($mmk=='Body'){
									//$MandHeadArray[] = implode(', ', $mmv); 
									foreach($mmv as $fv){
									$MandBodyArray .= $prefixMB . '' . $fv . '';
	    							$prefixMB = ', '; 	
									}
									$headerkey=array('IsMandatory'=>$is_mandatory,'KeyType'=>$mmk,'Keywords'=>$MandBodyArray,'DocDefUID'=>$docdef_id,'CreatedOn'=>$createdOn);
									
										$this->Order_model->addDocDefKeywords($headerkey);
									
									
								}

								if($mmk=='Footer'){
									//$MandHeadArray[] = implode(', ', $mmv); 
									foreach($mmv as $fv){
									$MandFootArray .= $prefixMF . '' . $fv . '';
	    							$prefixMF = ', '; 	
									}
									$headerkey=array('IsMandatory'=>$is_mandatory,'KeyType'=>$mmk,'Keywords'=>$MandFootArray,'DocDefUID'=>$docdef_id,'CreatedOn'=>$createdOn);
									
										$this->Order_model->addDocDefKeywords($headerkey);
									
									
								}
							}
						}
					}
					
					if (!empty($Keywords)) {
						foreach ($Keywords as $mv) {
							$is_mandatory=0;
						// $List = implode(', ', $Array); 
							foreach ($mv as $mmk=>$mmv) {
								if($mmk=='Header'){
									//$MandHeadArray[] = implode(', ', $mmv); 
									foreach($mmv as $fv){
									$KeyHeadArray .= $prefixKH . '' . $fv . '';
	    							$prefixKH = ', '; 	
									}
									$headerkey=array('IsMandatory'=>$is_mandatory,'KeyType'=>$mmk,'Keywords'=>$KeyHeadArray,'DocDefUID'=>$docdef_id,'CreatedOn'=>$createdOn);
									
										$this->Order_model->addDocDefKeywords($headerkey);
									
									
								}

								if($mmk=='Body'){
									//$MandHeadArray[] = implode(', ', $mmv); 
									foreach($mmv as $fv){
									$KeyBodyArray .= $prefixKB . '' . $fv . '';
	    							$prefixKB = ', '; 	
									}
									$headerkey=array('IsMandatory'=>$is_mandatory,'KeyType'=>$mmk,'Keywords'=>$KeyBodyArray,'DocDefUID'=>$docdef_id,'CreatedOn'=>$createdOn);
									
										$this->Order_model->addDocDefKeywords($headerkey);
									
									
								}

								if($mmk=='Footer'){
									//$MandHeadArray[] = implode(', ', $mmv); 
									foreach($mmv as $fv){
									$KeyFootArray .= $prefixKF . '' . $fv . '';
	    							$prefixKF = ', '; 	
									}
									$headerkey=array('IsMandatory'=>$is_mandatory,'KeyType'=>$mmk,'Keywords'=>$KeyFootArray,'DocDefUID'=>$docdef_id,'CreatedOn'=>$createdOn);
									
										$this->Order_model->addDocDefKeywords($headerkey);
									
									
								}
							}
						}
					}
					
				}
				
			}
		}
		$this->writeJson();
		//redirect('main/docDef');
	}


	public function deleteDocType(){
		$DocumentTypeUID=$this->input->post('docTypeUID');

		$data['docdef']=$this->Order_model->getDocDefById($DocumentTypeUID);
		//echo "<pre>";print_r($data['docdef']);exit;
		$data['keywords'] = [];
		if ($data['docdef']) {
			$data['keywords']=$this->Order_model->getKeywordsByDocDefId($data['docdef']['DocDefUID']);
		}
		if (!empty($data['keywords'])) {
			$response=array('validation_error'=>1,'message'=>'Failed to delete as there are associated mKeywords for this Document');
		}else{
			$this->Order_model->deleteDocTypeByUID($DocumentTypeUID);
			$response=array('validation_error'=>0,'message'=>'Deleted successfully');
		}
		echo json_encode($response);
	}

	public function addDocumentType(){
		$DocumentTypeName=$this->input->post('DocumentTypeName');
		$data=array('DocumentTypeName'=>$DocumentTypeName);
		$this->Order_model->addDocumentType($data);
		$response=array('validation_error'=>0,'message'=>'Added successfully');
		
		echo json_encode($response);
	}

	public function updateTOrders(){
		$OrderUID=$this->input->post('OrderUID');
		$id=$this->Order_model->updateTOrders($OrderUID);
		$response=array('validation_error'=>0,'message'=>'Updated successfully');
		echo json_encode($response);
	}
	
	public function SaveOrder(){

		if ($this->input->server('REQUEST_METHOD') === 'POST') 
		{
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('OrderNumber', '', 'required');
			$this->form_validation->set_rules('LoanNumber', '', 'required');
			$this->form_validation->set_rules('DocumentURL', 'Document', 'required');

			$this->form_validation->set_message('required', 'This Field is required');
			$post = $this->input->post();
				$result=$this->Order_model->SaveOrder($post);
				
				if( $result == 1)
				
				{
					//print_r($result);exit;
					$res = array('Status' => 0,'message'=>'Order added Successfully');
					echo json_encode($res);exit();
					
				}
				else
				{

					array('Status' => 2,'message'=>'Order added failed');
					echo json_encode($res);exit();
				}
		}
		else
		{
			$Msg = $this->lang->line('Empty_Validation');
			$data = array(
				'Status' => 1,
				'message' => $Msg,
				'OrderNumber' => form_error('OrderNumber'),
				'LoanNumber'  => form_error('LoanNumber'),
				'DocumentURL' => form_error('DocumentURL'),
				'type' => 'danger',
			);
			foreach ($data as $key => $value) {
				if (is_null($value) || $value == '')
					unset($data[$key]);
			}

			echo json_encode($data);
		}
	}	
}
