<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'scripts/utils.php';
//include MAINPATH.'stacxCron.php';
require "scripts/vendor/autoload.php";

class Ocr extends CI_Controller {
	public $id = null;
	function __construct(){
		parent::__construct();
        $this->load->library('session');
        $this->load->model('Order_model');
        $this->load->helper('file');
        $result=array();
		$resultData=array();
		$missedPages=array();
		$message='';
		define('REQIP',get_ip());
		define('REQID',uniqid());
		$this->id = $this->session->userdata('message');
	}
	
	public function index(){
		if(!$this->session->has_userdata('IsLogged')){  
		 redirect('Login');
		}
		GLOBAL $result;
		$data['result']=$result;
		$data['message']=$this->id;

		//write_file(MAINPATH.'docpdf.php','');
		//write_file(MAINPATH.'progressbar.php','');
		//write_file(MAINPATH.'table.php','');   

		$this->load->view('templates/header');
		//$this->load->view('main/index_v2',$data);
		$this->load->view('templates/footer');
	}


	public function sendData(){
	LOG_MSG('INFO','sendData(): START \n');
	
  	if (file_exists(MAINPATH.'json/docDef.json')) {
  		if (!empty(file_get_contents(MAINPATH.'json/docDef.json'))) {
  			$docDef=file_get_contents(MAINPATH.'json/docDef.json');
  		}else{
  			$docDef = $this->createJson();
  		$docDef=file_get_contents($docDef);
  		}
  		
  	}else{
  		$docDef = $this->createJson();
  		$docDef=file_get_contents($docDef);
  	}
	$OrderUID=$this->input->post('OrderUID');
	$orders=$this->Order_model->getOrdersByOrderUid($OrderUID);
	
	$orderNo=$orders['OrderNumber'];
	$query=$this->db->query("SELECT td.DocumentName FROM tDocuments as td JOIN  tOrders as o ON o.OrderUID = td.OrderUID where o.OrderNumber='".$orderNo."' AND td.IsStacking = 1");
		$file = $query->row();
	
	$source=DOCPATH.$orderNo.'/'.$file->DocumentName;
	$docType='PDF';
	$allData = array(
		"sourceApp"=> "StacX",
		"orderNo"=> $orderNo,
		"orderUID"=> $OrderUID, 
		"docType" => $docType,
		"source" => $source,
		//"features" => $_POST['features'],
		//"featuresInput" => $_POST['featuresInput'],
		//"outputFormat" => $_POST['outputFormat'],
		//"outputLocation" => $_POST['outputLocation'],
		"engine" => "TESSERACT",
		"docDef" => $docDef
	);
	
		
	$result=$this->tessaract($allData);
	if (!empty($result['data'])) {
		$query=$this->db->query("Update tOrders set StatusUID=16 where OrderUID=".$OrderUID);
	}
	LOG_MSG('INFO','sendData(): END \n');
	echo json_encode($result);
}

function tessaract($allData){	
	//print_r($allData);
	LOG_MSG('INFO','tessaract(): START \n');
	$filepath=$allData["source"];
	GLOBAL $countTime;
	GLOBAL $result;
	GLOBAL $message;
	$countTime=0;
	$this->session->set_userdata('message','tesssss');
	if (file_exists($filepath) && is_dir(DOCPATH.$allData['orderNo'].'/text/') && !is_dir_empty(DOCPATH.$allData['orderNo'].'/text/')){ 
		// Split function to extract filename
		$result_array = [];
		$result['sourceApp']=$allData['sourceApp'];
		$result['orderNo']=$allData['orderNo'];
		$result['orderUID']=$allData['orderUID'];
		$result['file']=$allData['source'];
		$result['data'] = [];
		$url= $allData['source'];
		$parts = explode("/", $url);
		$content['source']= end($parts);
		$split_name=explode(".", $content['source']);
		$result['pdf']=$content['source'];
		// end of split;
		if (!is_dir(DOCPATH.$allData['orderNo']."/text")) {	
			//mkdir(MAINPATH.$allData['orderNo']."/text", 0777, true);
			$cmd ="sudo mkdir -R 777 ".DOCPATH.$allData['orderNo']."/text";
			print_r($cmd);exit;
			exec($cmd);
		}
		
		if (!is_dir(DOCPATH.$allData['orderNo']."/pages")) {	
			mkdir(DOCPATH.$allData['orderNo']."/pages", 0777, true);
		}

		if ($allData["docType"] == 'pdf' || $allData["docType"] == 'PDF') {
			if (!is_dir(DOCPATH.$allData['orderNo']."/images")) {
				mkdir(DOCPATH.$allData['orderNo']."/images", 0777,true);					 	
			}
			// $text = '<div class="alert alert-warning">
			// 			  <p class="text-center">Uploading File Completed</p>
			// 			</div>';
	  //   	write_file(MAINPATH.'progressbar.php', $text);

			$resultData=$this->getWithoutSplitPdfResult($allData);	
		}
		else{
			$resultData=$this->getImageResult($allData);	
		}
		$result['data']=$resultData;	
		//echo json_encode($result);
		$this->Receive_OCR_Details($result);
		$directory = DOCPATH.$allData['orderNo'].'/images/';
		$count = 0;
		$files = glob($directory . "*");
		if ($files){
		 	$count = count($files);
		}
		$result['count']=$count;
		return $result;			
	} 
	else{ 
		return $result;
		//echo "The file $filepath does not exists"; 
	} 
	LOG_MSG('INFO','tesseract(): END \n');	
}

function getWithoutSplitPdfResult($allData){
	// $text = '<div class="alert alert-warning">
	// <p class="text-center">Uploading File</p>
	// </div>';
	// write_file(MAINPATH.'progressbar.php', $text);
	LOG_MSG('INFO','getWithoutSplitPdfResult(): START \n');
	GLOBAL $resultData;
	$filepath=$allData["source"];
	$url= $allData['source'];
	$parts = explode("/", $url);
	$content['source']= end($parts);
	$split_name=explode(".", $content['source']);
	// $text = '<div class="alert alert-warning">
	// 			<p class="text-center">Uploading File Completed</p>
	// 		</div>';
	// write_file(MAINPATH.'progressbar.php', $text);
	// Fetch Order details by order number
	$OrderDetails = $this->Order_model->getOrderDetailsByOrderNo($allData['orderNo']);
	// Convert pdf to image
	if(IMAGESPLIT){
		$cmd="gs -dSAFER -sDEVICE=jpeg -dINTERPOLATE -dNumRenderingThreads=8 -o ".DOCPATH.$allData['orderNo'].'/images/'.$split_name[0]."-%01d.jpg -r300 ".$filepath;
		$res = exec($cmd);
	}
	$imagePath=DOCPATH.$allData['orderNo'].'/images/'.$split_name[0]."-%01d.jpg";
	LOG_MSG('INFO','getWithoutSplitPdfResult(): Convert to image {imageFile=['.$imagePath.'],} \n');
	// Get count of PDF pages
	$cmd='gs -q -dNODISPLAY -c "('.$filepath.') (r) file runpdfbegin pdfpagecount = quit"';
	$count=exec($cmd);
	$filename=DOCPATH.$allData['orderNo']."/text/".$split_name[0];
	if(OCR){
		for ($i=1; $i <=$count ; $i++) {	
			if (!file_exists(DOCPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt")){		
			LOG_MSG('INFO','getSplittedPdfResult(): tesseractInstance START  \n'); 		 	 		
			$tesseractInstance = new TesseractOCR(DOCPATH.$allData['orderNo'].'/images/"'.$split_name[0]."-".$i.'.jpg"');
			$ocrResult = $tesseractInstance->run();
			LOG_MSG('INFO','getSplittedPdfResult(): tesseractInstance END \n');			
			$fp = fopen(DOCPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.'.txt', 'w');

			 $cmd = "sudo chown -R www-data:www-data ".DOCPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt";
			$res = exec($cmd);
			$cmd = "sudo chmod -R 0777 ".DOCPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt";
			$res = exec($cmd);
			fwrite($fp,$ocrResult);
			fclose($fp);
			$path=DOCPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.'.txt';
			LOG_MSG('INFO','getSplittedPdfResult(): Writting {TextFile=['.$path.'],} \n');	
			$this->writeHtml($resp,$i,$content["source"]);			
			$result=$resultData;

			// $text = '<div class="alert alert-warning">
			// 		  <p class="text-center">'.$split_name[0]."-".$i.' OCR in progress</p>
			// 		</div>';
			// write_file(MAINPATH.'progressbar.php', $text);	
			}			
		}
	}
	$directory = DOCPATH.$allData['orderNo'].'/text/';
		$count = 0;
		$files = glob($directory . "*");
		if ($files){
		 	$count = count($files);
		}
	
	// SEARCH  is config in StacxCron
	if(SEARCH){
		
		for ($m=1; $m <=$count ; $m++) { 
			if (file_exists(DOCPATH.$allData['orderNo']."/text/".$split_name[0]."-".$m.".txt")) {
				
			$this->checkConfidence(DOCPATH.$allData['orderNo']."/text/".$split_name[0]."-".$m.".txt",$allData['docDef'],$m,$filename);
		
			}
			
			$duplicates = $this->Order_model->checkForDuplicatePages($m,$OrderDetails['OrderUID']);

			if (empty($duplicates)) {
				$data=array('PageNo'=>$m,'OrderUID'=>$OrderDetails['OrderUID']);
				$this->Order_model->insertTpages($data);
			}
			
		}
	}
	
	LOG_MSG('INFO','getWithoutSplitPdfResult(): END \n');
	
	return $resultData;
}
#################################################################################
function Receive_OCR_Details($Json_request){

	LOG_MSG('INFO','Receive_OCR_Details(): START \n');
	$hostname = $this->db->hostname;
	$username = $this->db->username;
	$password = $this->db->password;
	$database = $this->db->database;
	$con=mysqli_connect($hostname,$username,$password,$database) or die(mysqli_error());

	//$Fetch_Request_Details = json_decode($Json_request);
	$Fetch_Request_Details = $Json_request;
	$data['OrderUID'] = $Fetch_Request_Details['orderUID'];
	$OrderUID = $Fetch_Request_Details['orderUID'];
	$data['orderNo'] = $Fetch_Request_Details['orderNo'];
	$data['data'] = $Fetch_Request_Details['data'];	
		$sql="";
	if(!empty($data['data'])){
	foreach ($data['data'] as $key => $fetchValue) {
		$object = (array)$fetchValue;
		$DocumentTypeName = key($object);
		$confidence = '';
		$this->db->query("Update tPage set ocrDocumentTypeUID=NULL,pageConfidence=NULL,manualDocumentTypeUID=NULL where OrderUID=".$data['OrderUID']);
		/*comparation of the orders details*/
		foreach ($object as $objkey => $objvalue) {
		
			$DocumentTypeUID =$objvalue['docTypeUID'];
			$DocName =$objvalue['docName'];
			//$query=$this->db->query("SELECT DocumentTypeUID,DocumentTypeName FROM mDocumentType  where DocumentTypeUID='".$DocumentTypeUID."'");
			$query=$this->db->query("SELECT DocumentTypeUID,DocumentTypeName FROM mDocumentType  where DocumentTypeName='".$DocName."'");
			$mDocumentTypeData = $query->result_array();
			if(!empty($mDocumentTypeData)){
				 $DocumentTypeUID = $mDocumentTypeData[0]['DocumentTypeUID'];
			}else{
				$DocumentTypeUID = 0;
			}
			$pageConfidence=$objvalue['pageConfidence']==0?'0.000':$objvalue['pageConfidence'];
			$pageConfidence=round($pageConfidence, 3);
			$pageNo=$objvalue['pageNo'];

			//$sql =$sql." UPDATE tPage SET ocrCategoryName='".$CategoryName."' , pageConfidence=".$pageConfidence." WHERE  PageNo=".$pageNo." AND OrderUID = ".$OrderUID."; ";
			$sql =$sql."INSERT INTO tPage(ocrDocumentTypeUID,pageConfidence,PageNo,OrderUID,DocumentTypeUID) VALUES (".$DocumentTypeUID.",".$pageConfidence.",".$pageNo.",".$OrderUID.",".$DocumentTypeUID.") ON DUPLICATE KEY UPDATE ocrDocumentTypeUID = ".$DocumentTypeUID.",pageConfidence=".$pageConfidence.";";
		}
    }
  //print_r($sql);exit;
    mysqli_multi_query($con,$sql);
	}

}
######################################################################################
function getImageResult($allData){
	LOG_MSG('INFO','getImageResult(): START \n');
	GLOBAL $resultData;
	$filepath=$allData["source"];
	$url= $allData['source'];
	$parts = explode("/", $url);
	$content['source']= end($parts);
	$split_name=explode(".", $content['source']);
				
	$tesseractInstance = new TesseractOCR($filepath);
	$pageNo=1;
	$result = $tesseractInstance->run();
	
	$fp = fopen(DOCPATH.$allData['orderNo']."/text/".$split_name[0].'.txt', 'w');
	chmod(DOCPATH.$allData['orderNo']."/text/".$split_name[0].".txt", 0777); 
	chown(DOCPATH.$allData['orderNo']."/text/".$split_name[0].".txt", 'www-data');     
	fwrite($fp, json_encode($result));
	fclose($fp);
	$filename=DOCPATH.$allData['orderNo']."/text/".$split_name[0];
	$this->checkConfidence(DOCPATH.$allData['orderNo']."/text/".$split_name[0].".txt",$allData['docDef'],$pageNo,$filename);		
	LOG_MSG('INFO','getImageResult(): END \n');
	return $resultData;
}

function checkConfidence($txtFile,$data,$pageNo,$filename){

	LOG_MSG('INFO','checkConfidence(): START \n');
	
	$ocrText = file_get_contents($txtFile);	
	$count_words = 0;
	$fdata=json_decode($data);
	GLOBAL $tempHeader;
	GLOBAL $tempFooter;
	GLOBAL $tempBody;
	$tempHeader="";$tempFooter="";$tempBody="";
	GLOBAL $resultData,$countTime;
	$Count=0;
	$pageConfidence=0;
	GLOBAL $lastMatchDocTypeUID;
	GLOBAL $lastMatchPageNo;
	//$lastMatchDocTypeUID="";
	//$lastMatchPageNo="";

	// Document Type Array loop
	foreach ($fdata as $key => $value){ 
		if ($key == 'Count') {
			$Count=$value;	
		}else{
			$MandatoryKeywords=0;
			$ManKeyCount =0; 
			$KeyCount =0;
			$Confidence=0; 
			$docTypeUID=0;
			$Header=0;
			$Footer=0;
			$KeyWordCutOff=0;
			$LowerCaseSearch=0;
			
			// Document Keywords Array loop
			foreach( $value as $k => $v) { 
			
				if ($k == 'Confidence') $Confidence=$v;
				if ($k == 'KeywordsCount') $KeywordsCount=$v;
				if ($k == 'MandatoryKeywordsCount') $MandatoryKeywords=$v;
				if ($k == 'docTypeUID') $docTypeUID=$v;
				if ($k == 'Header')$Header=$v;
				if ($k == 'Footer')$Footer=$v;
				if ($k=='KeyWordCutOff')$KeyWordCutOff=$v;
				if ($k=='LowerCaseSearch')$LowerCaseSearch=$v;
				
				// Document Mandatory Keywords search loop
				if ($k == 'MandatoryKeywords') {

					$getPageContent=$this->getPageContent($ocrText,$Header,$Footer,$LowerCaseSearch);
					foreach ($v as $section) {
						foreach ($section as $keys => $words) {
							switch ($keys) {
								case 'Header':
									foreach ($words as $word) {$countTime++;
									$result=($LowerCaseSearch)?stripos($tempHeader,$word):strpos($tempHeader,$word);
									if($result) $ManKeyCount++;
								}
								break;
								case 'Footer':
									foreach ($words as $word) {$countTime++;
									$result=($LowerCaseSearch)?stripos($tempFooter,$word):strpos($tempFooter,$word);
									if($result) $ManKeyCount++;
								}
								break;
								case 'Body':
									foreach ($words as $word) {$countTime++;
									$result=($LowerCaseSearch)?stripos($tempBody,$word):strpos($tempBody,$word);
									if($result) $ManKeyCount++;
								}
								break;
								default:
									foreach ($words as $word) {$countTime++;
								   $result=($LowerCaseSearch)?stripos($ocrText,$word):strpos($ocrText,$word);
									if($result) $ManKeyCount++;
								}
								break;
							}
						}
					}
				}
				
			// Document Keywords search loop
				if($ManKeyCount && $k == 'Keywords'){ 
					foreach ($v as $section) {
						foreach ($section as $s => $keywords) {
							switch ($s) {
								case 'Header':
									foreach ($keywords as $keyword) {
										$countTime++;
										$result=($LowerCaseSearch)?stripos($tempHeader,$keyword):strpos($tempHeader,$keyword);
									if($result) $KeyCount++;
								}
								break;
								case 'Footer':
									foreach ($keywords as $keyword) {
										$countTime++;
										$result=($LowerCaseSearch)?stripos($tempFooter,$keyword):strpos($tempFooter,$keyword);
									if($result) $KeyCount++;
								}
								break;
								case 'Body':
									foreach ($keywords as $keyword) {$countTime++;
									$result=($LowerCaseSearch)?stripos($tempBody,$keyword):strpos($tempBody,$keyword);
									if($result) $KeyCount++;
								}
								break;
								default:
									foreach ($keywords as $keyword) {$countTime++;
										$result=($LowerCaseSearch)?stripos($ocrText,$keyword):strpos($ocrText,$keyword);
									if($result) $KeyCount++;
								}
								break;
							}
						}
					}
	
						
					$pageConfidence =(($KeyWordCutOff != 0)? 0.5 + (($KeyCount/$KeyWordCutOff)/2):0.5 + (($KeyCount/$KeywordsCount)/2));
					if($pageConfidence >= $Confidence){
						if($lastMatchDocTypeUID == $docTypeUID && $lastMatchPageNo<($pageNo-1)) {
							for ($l=$lastMatchPageNo+1;$l<$pageNo;$l++){
							    $resultData[$l]=array();
								$PageArray = [];
								$PageArray['docName']=$key;
								$PageArray['docTypeUID']=$docTypeUID;
								$PageArray['pageConfidence']=0;
								$PageArray['pageNo']=$l;
								array_push($resultData[$l],$PageArray);
						    }  
						   $lastMatchDocTypeUID =$docTypeUID;
					       $lastMatchPageNo =$pageNo;
						}
						else{
							$lastMatchDocTypeUID = $docTypeUID;
						     $lastMatchPageNo = $pageNo;	
						 }
						 
						if(isset($resultData[$pageNo])){
							$k = count($resultData[$pageNo]);
							$sameDocTypeMatch="Empty";
							$diffDocTypeMatch="Empty";
							for($i=0;$i<$k;$i++){
								if($pageConfidence > $resultData[$pageNo][$i]['pageConfidence'] &&$resultData[$pageNo][$i]['docTypeUID'] == $docTypeUID ){
									$sameDocTypeMatch=$i;
								}else if($resultData[$pageNo][$i]['docTypeUID'] != $docTypeUID ){
									$diffDocTypeMatch=$i;
									}
							if(($sameDocTypeMatch != "Empty") && !$diffDocTypeMatch){
								$resultData[$pageNo][$sameDocTypeMatch]['pageConfidence']=$pageConfidence;
							}
							if(($diffDocTypeMatch != "Empty") && !$sameDocTypeMatch){
								$PageArray = [];
									$PageArray['docName']=$key;
									$PageArray['docTypeUID']=$docTypeUID;
									$PageArray['pageConfidence']=$pageConfidence;
									$PageArray['pageNo']=$pageNo;
									array_push($resultData[$pageNo],$PageArray);
							    }
						    }

						}else{
							$resultData[$pageNo]=array();
							$PageArray = [];
							$PageArray['docName']=$key;
							$PageArray['docTypeUID']=$docTypeUID;
							$PageArray['pageConfidence']=$pageConfidence;
							$PageArray['pageNo']=$pageNo;
							array_push($resultData[$pageNo],$PageArray);
							$pattern='/\bage(\\s*).(\\d+)(\\s+)((?:[a-z][a-z]+))(\\s+)(\\d+)\b/i';
							$pattern1='/\bage(\\s+)(\\d+)\b/i';
							if(preg_match($pattern, $tempHeader.$tempFooter, $matches)){
								$string=$matches[0];
								$this->getUnclassifiedPages($string,$filename,$pageNo,$key,$docTypeUID,$tempHeader.$tempFooter,$pattern,$Header,$Footer,$LowerCaseSearch);
							}elseif (preg_match($pattern1, $tempHeader.$tempFooter, $matches)) {
								$string=$matches[0];
								$this->getUnclassifiedPages($string,$filename,$pageNo,$key,$docTypeUID,$tempHeader.$tempFooter,$pattern1,$Header,$Footer,$LowerCaseSearch);
							}

						}
					}
				}
			} 
		}
	}

	LOG_MSG('INFO','checkConfidence(): END \n');
	return $resultData;
}

/*mandatoryKey search headerContent start*/
function getPageContent($ocrText,$Header,$Footer,$LowerCaseSearch){

	LOG_MSG('INFO','getPageContent(): START \n');
	GLOBAL $tempHeader,$tempFooter,$tempBody;
	$tempHeader="";$tempFooter="";$tempBody="";
	$tempOcrText= preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $ocrText);
	$lines=explode("\n",$tempOcrText);
	$count=count($lines);
	for($i=0; $i<$count; $i++){
		if($count==0 &&  $count<=$Header)return;
		if($count!=0 &&  $count>$Footer)$eof = ($count-$Footer);
		else return;
		if($i<$Header){
			$tempHeader.=$lines[$i];
			$tempHeader.="\n";continue;
		}
		if($i>=$eof && $i<$count){
			$tempFooter.= $lines[$i];
			$tempFooter.= "\n";continue;
		}
		if($count>($Header+$Footer) && $i>$Header && $i<$eof){
			$tempBody.= $lines[$i];
			$tempBody.= "\n";continue;
		}
	}
	LOG_MSG('INFO','getPageContent(): END \n');
}

function getUnclassifiedPages($string,$filename,$pageNo,$key,$docTypeUID,$ocrText,$pattern,$Header,$Footer,$LowerCaseSearch){
	LOG_MSG('INFO','getUnclassifiedPages(): START \n');
	$explode=explode(' ', $string);
	// Madhuri starts
	if (array_key_exists('1',$explode)) {
		$start=preg_replace("/[^0-9]/", "", $explode[1]);
	}else{
		$start=1;
	}
	// Madhuri ends
	$start=preg_replace("/[^0-9]/", "", $explode[1]);
	$end=(isset($explode[3]))?($explode[3]):0;
	GLOBAL $resultData;
	GLOBAL $missedPages;
	GLOBAL $tempHeader;
	GLOBAL $tempFooter;
	GLOBAL $tempBody;

	// Madhuri starts
	if (is_int($start)) {
	// print_r($start."\n");
	}else{
		$start = (int)$start;
		// print_r("non_integer ".$start."\n");
	}
	// Madhuri ends

	$tempHeader="";$tempFooter="";$tempBody="";
	$startPage = (($pageNo-$start)+1>0)?(($pageNo-$start)+1):1;
	$endPage = ($start && $end!=0)?$pageNo+($end - $start):$pageNo;
	for($i=$startPage, $n=1 ;$i<=$endPage;$i++,$n++){
		if (!file_exists($filename.'-'.$i.'.txt')) break;
		$ocrText=file_get_contents($filename.'-'.$i.'.txt');
		$getPageContent=$this->getPageContent($ocrText,$Header,$Footer,$LowerCaseSearch);
		$pagePattern='Page '.$n;
		if(stripos($tempHeader.$tempFooter,$pagePattern)){
			//will not come to know if multiple matches are there which one is correct
			if(!isset($resultData[$i])){
				$resultData[$i]=array();
				$PageArray = [];
				$PageArray['docName']=$key;
				$PageArray['docTypeUID']=$docTypeUID;
				$PageArray['pageConfidence']=0;
				$PageArray['pageNo']=$i;
				array_push($resultData[$i],$PageArray);
			}else{
				$m = count($resultData[$i]);
				for($j=0;$j<$m;$j++){
					 if($resultData[$i][$j]['docTypeUID'] != $docTypeUID ){
						$PageArray = [];
						$PageArray['docName']=$key;
						$PageArray['docTypeUID']=$docTypeUID;
						$PageArray['pageConfidence']=0;
						$PageArray['pageNo']=$i;
						array_push($resultData[$i],$PageArray);
					}	
				}
			}
			if(!$end)$endPage++; 
		}
	}
	LOG_MSG('INFO','getUnclassifiedPages(): END \n');
	return ;
}

function writeHtml($result,$i,$file){
	//print_r($result);
	$split_name=explode('.', $file);
	$color='';
	$text='';
	write_file(MAINPATH.'table.php','');
if (isset($result[$i])) {
	if (sizeof($result[$i])>1) {
		for ($j=0; $j <sizeof($result[$i]) ; $j++) { 
			$data=array('OrderUID'=>$file,'ocrDocType'=>$result[$i][$j]['docName'],'pageConfidence'=>$result[$i][$j]['pageConfidence'],'pageNo'=>$i);
				$this->Order_model->updateTpages($data);
				//write the file here
$response=$this->Order_model->getTpagesd($file,$i);

		if(($result[$i][$j]['pageConfidence']*100) >= 75 || ($result[$i][$j]['pageConfidence']*100) == 0){
			$color='#0080009c';

			}else if(($result[$i][$j]['pageConfidence']*100) > 50 || ($result[$i][$j]['pageConfidence']*100) <75){
				$color='#0000ff38';
			}else if(($result[$i][$j]['pageConfidence']*100) <= 50 || ($result[$i][0]['pageConfidence']*100) != 0){
				$color='#ffa5005c';
			}
			$text=
			'<td id="'.$i.'" style="font-size: 12px;color: #000;">'.$response['ocrDocType'].'</td>'.

			'<td class="item-stock" style="background:'.$color.';font-size: 12px;color: #000;">'.round($response['pageConfidence']*100).'</td>';
		}
	}else{

		if(($result[$i][0]['pageConfidence']*100) >= 75 || ($result[$i][0]['pageConfidence']*100) == 0){
			$color='#0080009c';

			}else if(($result[$i][0]['pageConfidence']*100) > 50 || ($result[$i][0]['pageConfidence']*100) <75){
				$color='#0000ff38';
			}else if(($result[$i][0]['pageConfidence']*100) <= 50 || ($result[$i][0]['pageConfidence']*100) != 0){
				$color='#ffa5005c';
			}

	$data=array('OrderUID'=>$file,'ocrDocType'=>$result[$i][0]['docName'],'pageConfidence'=>$result[$i][0]['pageConfidence'],'pageNo'=>$i);
				$this->Order_model->updateTpages($data);
		$response=$this->Order_model->getTpagesd($file,$i);		
				//write the file here

		
		$text=
		'<td id="'.$i.'" style="font-size: 12px;color: #000;">'.$response['ocrDocType'].'</td>'.

		'<td class="item-stock" style="background:'.$color.';font-size: 12px;">'.round($response['pageConfidence']*100).'</td>';
		
	}
}else {
	$text=
	'<td id="'.$i.'" style="font-size: 12px;color: #000;"></td>'.
	'<td class="item-stock" style="font-size: 12px;"> <i class="fa fa-question-circle" aria-hidden="true"></i> </td>';
}

	$fp = fopen(MAINPATH.$split_name[0].'/pages/table-'.$i.'.php', 'w');
	$cmd="sudo chmod 777 ".MAINPATH.$split_name[0].'/pages/table-'.$i.'.php';
	exec($cmd);
	$cmd="sudo chown www-data:www-data ".MAINPATH.$split_name[0].'/pages/table-'.$i.'.php';
	exec($cmd);
	
	fwrite($fp,$text);
	fclose($fp);

    // if ( ! write_file(MAINPATH.$split_name[0].'/table-'.$i.'.php', $text)){ }
	// else{}
}


	public function checkValid(){
		$file=$this->input->post('file');
		$page=$this->input->post('pageNo');
		$data=$this->Order_model->getTpagesByOrderUid($file,$page);
		echo json_encode($data);
	}


function sendDataByDocdef(){
	GLOBAL $resultData;
	$file=$this->input->post('file');
	$resp=array();
	$PageNo=$this->input->post('PageNo');
	$ocrType=$this->input->post('ocrType');
	$docDef=$this->input->post('docDef');
	
	
	$split_name=explode(".", $file);
 	$filename1=$split_name[0];
	$OrderUID=$this->input->post('OrderUID');
	$docTypeUID=$this->input->post('docTypeUID');
	if ($ocrType ==1 || $ocrType ==2) {
		$docDef=$this->input->post('docDef');
	}else{
		$docDef=$this->writeJson($docDef,$docTypeUID);
		$docDef=file_get_contents(MAINPATH.'scripts/tempDocDef.json');
	}
	$orders=$this->Order_model->getOrdersByOrderUid($OrderUID);
	$orderNo=$orders['OrderNumber'];
	$source=MAINPATH.$orderNo.'/'.$file;
	$docType='PDF';
	$allData = array(
		"sourceApp"=> "StacX",
		"orderNo"=> $orderNo,
		"orderUID"=> $OrderUID, 
		"docType" => $docType,
		"source" => $source,
		"engine" => "TESSERACT",
		"docDef" => $docDef
	);

	$cmd='gs -q -dNODISPLAY -c "('.$source.') (r) file runpdfbegin pdfpagecount = quit"';
	$count=exec($cmd);

	$filename=DOCPATH.$allData['orderNo']."/text/".$split_name[0];

	if ($ocrType == 1) {
		$this->checkConfidence(DOCPATH.$allData['orderNo']."/text/".$filename1."-".$PageNo.".txt",$allData['docDef'],$PageNo,$filename);
	}else if($ocrType == 2){
		$tPages = $this->Order_model->getTpagesByDocId($docTypeUID,$OrderUID);
		if ($tPages) {
			foreach ($tPages as $t) {
				$this->checkConfidence(DOCPATH.$allData['orderNo']."/text/".$filename1."-".$t['PageNo'].".txt",$allData['docDef'],$t['PageNo'],$filename);
			}
		}
	}else if($ocrType == 3){
		$this->checkConfidence(DOCPATH.$allData['orderNo']."/text/".$filename1."-".$PageNo.".txt",$allData['docDef'],$PageNo,$filename);
	}else if($ocrType == 4){
		for ($i=1; $i <=$count ; $i++) {	
			$this->checkConfidence(DOCPATH.$allData['orderNo']."/text/".$filename1."-".$i.".txt",$allData['docDef'],$i,$filename);
		}
	}
	
//echo "<pre>";print_r($allData['docDef']);exit;
	echo json_encode($resultData);
}

	public function writeJson($docDef,$docTypeUID){
		
		$docdef=$this->Order_model->getAllDocDef();
		$keywords=$this->Order_model->getAllKeywords();
		$def='{"Count":"'.count($docdef).'",';
		$count=0;
		foreach ($docdef as $d) {
			if ($d['DocTypeUID'] != $docTypeUID) {
				
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
		}
		$def.=$docDef;
		$def.='}';
	
		write_file(MAINPATH.'scripts/tempDocDef.json',$def);
		
	}


		public function createJson(){
		
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
				
				if ($d['DocDefUID']==$k['DocDefUID'] && $k['is_mandatory']==1) {
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
		$fp = fopen(MAINPATH.'json/docDef.json', 'w');
				fwrite($fp,$def);
					fclose($fp);
		//write_file(MAINPATH.'json/docDef.json',$def);
		return MAINPATH.'json/docDef.json';
	}

}
