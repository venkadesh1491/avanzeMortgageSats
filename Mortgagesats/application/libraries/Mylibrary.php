<?php  
//  include MAINPATH.'utils.php';
// require "vendor/autoload.php";
class Mylibrary
{
 
    public function __construct()
    {
        $this->CI =& get_instance();
        $result=array();
		$resultData=array();
		$missedPages=array();
		$message='';
		
		
    }
function sendData($filename){
	
	//$filename=$_FILES['file']['name'];
	$parts = explode("/", $filename);
	$file= end($parts);
	$split_name=explode(".", $file);
	$orderNo=$split_name[0];
	//print_r($orderNo);


$source=MAINPATH.$orderNo.'/'.$file;

$docDef=file_get_contents(MAINPATH.'docDef.json');
$docType='PDF';
$allData = array(
		"sourceApp"=> "StacX",
		"orderNo"=> $orderNo,
		"orderUID"=> "107", 
		"docType" => $docType,
		"source" => $source,
		//"features" => $_POST['features'],
		//"featuresInput" => $_POST['featuresInput'],
		//"outputFormat" => $_POST['outputFormat'],
		//"outputLocation" => $_POST['outputLocation'],
		"engine" => "TESSERACT",
		"docDef" => $docDef
	);
//print_r($allData);exit;

	$url= $allData['source'];
			$parts = explode("/", $url);
			$content['source']= end($parts);
	$data['pdf']=$source;
	
	$text = '<div class="alert alert-warning">
				<p class="text-center">Uploading File</p>
			</div>';
	// $pdf_text='<embed src="'.base_url().$source.'uploads/1436789612.pdf"  class="pdf" width="100%"  alt="pdf">';
	// write_file(MAINPATH.'docpdf.php', $pdf_text);
	write_file(MAINPATH.'progressbar.php', $text);

	$result=$this->tessaract($allData);
	$data['result']=$result;
	$directory = MAINPATH.$allData['orderNo'].'/images/';
	$count = 0;
	$files = glob($directory . "*");
	if ($files){
	 $count = count($files);
	}
	//$data['count']=$count;
	write_file(MAINPATH.'progressbar.php', '');
	$data=$this->CI->Home_model->getTpagesByOrderUid($content['source']);
	//echo json_encode($data);

}

	function tessaract($allData){	
		//print_r($allData);
		LOG_MSG('INFO','tessaract(): START \n');
		$filepath=$allData["source"];
		GLOBAL $countTime;
		GLOBAL $result;
		GLOBAL $message;
		$countTime=0;
		
		if (file_exists($filepath)){ 
	 
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
			// end of split;
				// print_r(end($parts));	 
			// check if directory exists
			// if (!is_dir(MAINPATH.$allData['orderNo'])) {
			// 	mkdir(MAINPATH.$allData['orderNo'], 0777, true);
			// }
			$this->CI->Home_model->updateTpagesByOrderUID($content['source']);
			

			if (!is_dir(MAINPATH.$allData['orderNo']."/text")) {	
				mkdir(MAINPATH.$allData['orderNo']."/text", 0777, true);
			}
			
			if (!is_dir(MAINPATH.$allData['orderNo']."/pages")) {	
				mkdir(MAINPATH.$allData['orderNo']."/pages", 0777, true);
			}

			if ($allData["docType"] == 'pdf' || $allData["docType"] == 'PDF') {
				if (!is_dir(MAINPATH.$allData['orderNo']."/images")) {
					mkdir(MAINPATH.$allData['orderNo']."/images", 0777,true);					 	
				}

				$text = '<div class="alert alert-warning">
						  <p class="text-center">Uploading File Completed</p>
						</div>';
	    		write_file(MAINPATH.'progressbar.php', $text);

				$resultData=$this->getWithoutSplitPdfResult($allData);	

			}else{
				$resultData=$this->getImageResult($allData);	

			}
			
			$result['data']=$resultData;	
		
			
			//echo json_encode($result);
			$directory = MAINPATH.$allData['orderNo'].'/images/';
			$count = 0;
			$files = glob($directory . "*");
			if ($files){
			 $count = count($files);
			}
			$result['count']=$count;
		//return $result;			
		} 
		else{ 
			echo "The file $filepath does not exists"; 
		} 
		LOG_MSG('INFO','tesseract(): END \n');	
	}

function getWithoutSplitPdfResult($allData){
	$text = '<div class="alert alert-warning">
				<p class="text-center">Uploading File</p>
			</div>';
	write_file(MAINPATH.'progressbar.php', $text);
	LOG_MSG('INFO','getWithoutSplitPdfResult(): START \n');
	GLOBAL $resultData;
	GLOBAL $result;
	$filepath=$allData["source"];
	$url= $allData['source'];
	$parts = explode("/", $url);
	$content['source']= end($parts);
	$split_name=explode(".", $content['source']);
	$text = '<div class="alert alert-warning">
				<p class="text-center">Uploading File Completed</p>
			</div>';
	write_file(MAINPATH.'progressbar.php', $text);
	// Convert pdf to image
	
	$cmd="gs -dSAFER -sDEVICE=jpeg -dINTERPOLATE -dNumRenderingThreads=4 -o ".MAINPATH.$allData['orderNo'].'/images/'.$split_name[0]."-%01d.jpg -r300 ".$filepath;
	
	$res = exec($cmd);

	$text = '<div class="alert alert-warning">
					  <p class="text-center">converting to image File</p>
					</div>';
	write_file(MAINPATH.'progressbar.php', $text);
	$imagePath=MAINPATH.$allData['orderNo'].'/images/'.$split_name[0]."-%01d.jpg";
	LOG_MSG('INFO','getWithoutSplitPdfResult(): Convert to image {imageFile=['.$imagePath.'],} \n');
	// Get count of PDF pages
	$cmd='gs -q -dNODISPLAY -c "('.$filepath.') (r) file runpdfbegin pdfpagecount = quit"';
	$count=exec($cmd);
	$directory = MAINPATH.$allData['orderNo'].'/images/';
	$count = 0;
	$files = glob($directory . "*");
	if ($files){
	 $count = count($files);
	}

	$this->CI->load->helper('file');
	$filename=MAINPATH.$allData['orderNo']."/text/".$split_name[0];

	for ($i=1; $i <=$count ; $i++) {	
		//if (!file_exists(MAINPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt")){	
			LOG_MSG('INFO','getSplittedPdfResult(): tesseractInstance START  \n'); 		 	 		
			$tesseractInstance = new TesseractOCR(MAINPATH.$allData['orderNo'].'/images/"'.$split_name[0]."-".$i.'.jpg"');
			$ocrResult = $tesseractInstance->run();

			$text = '<div class="alert alert-warning">
					  <p class="text-center">'.$split_name[0]."-".$i.' OCR in progress</p>
					</div>';
			write_file(MAINPATH.'progressbar.php', $text);	
			write_file(MAINPATH.'docpdf.php', $i);
			LOG_MSG('INFO','getSplittedPdfResult(): tesseractInstance END \n');			
			$fp = fopen(MAINPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.'.txt', 'w');
			$cmd = "sudo chown www-data:www-data ".MAINPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt";
			$res = exec($cmd);
			$cmd = "sudo chmod 777 www-data:www-data ".MAINPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt";
			$res = exec($cmd);
			//chown(M, 'www-data');
			//chmod(MAINPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt", 0777); 
			fwrite($fp,$ocrResult);
			fclose($fp);
			$path=MAINPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.'.txt';
			LOG_MSG('INFO','getSplittedPdfResult(): Writting {TextFile=['.$path.'],} \n');
			$resp=$this->checkConfidence(MAINPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt",$allData['docDef'],$i,$filename);
			$this->writeHtml($resp,$i,$content["source"]);			
			$result=$resultData;

			
				
		// }else{
		// 	$resp=$this->checkConfidence(MAINPATH.$allData['orderNo']."/text/".$split_name[0]."-".$i.".txt",$allData['docDef'],$i,$filename);
		// 	$this->writeHtml($resp,$i,$content["source"]);			
		// 	$result=$resultData;

		// 	$text = '<div class="alert alert-warning">
		// 			  <p class="text-center">'.$split_name[0]."-".$i.' OCR in progress</p>
		// 			</div>';
		// 	write_file(MAINPATH.'progressbar.php', $text);
		// }	
}
	LOG_MSG('INFO','getWithoutSplitPdfResult(): END \n');
	

	return $resultData;
}
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
	
	$fp = fopen(MAINPATH.$allData['orderNo']."/text/".$split_name[0].'.txt', 'w');
	chmod(MAINPATH.$allData['orderNo']."/text/".$split_name[0].".txt", 0777); 
	chown(MAINPATH.$allData['orderNo']."/text/".$split_name[0].".txt", 'www-data');     
	fwrite($fp, json_encode($result));
	fclose($fp);
	$filename=MAINPATH.$allData['orderNo']."/text/".$split_name[0];
	$this->checkConfidence(MAINPATH.$allData['orderNo']."/text/".$split_name[0].".txt",$allData['docDef'],$pageNo,$filename);		
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
				if($k=='KeyWordCutOff')$KeyWordCutOff=$v;
				if($k=='LowerCaseSearch')$LowerCaseSearch=$v;
				
				// Document Mandatory Keywords search loop

				if ($k == 'MandatoryKeywords') {
					$getPageContent=$this->getPageContent($ocrText,$Header,$Footer,$LowerCaseSearch);
					foreach ($v as $section) {
						foreach ($section as $keys => $words) {
							switch ($keys) {
								case 'Header':
									foreach ($words as $word) {$countTime++;
									$result = substr_count($tempHeader,$word);
									if($result) $ManKeyCount++;
								}
								break;
								case 'Footer':
									foreach ($words as $word) {$countTime++;
									$result = substr_count($tempFooter,$word);
									if($result) $ManKeyCount++;
								}
								break;
								case 'Body':
									foreach ($words as $word) {$countTime++;
									$result = substr_count($tempBody,$word);
									if($result) $ManKeyCount++;
								}
								break;
								default:
									foreach ($words as $word) {$countTime++;
									$result = substr_count($ocrText,$word);
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
									$result = substr_count($tempHeader,$keyword);
									if($result) $KeyCount++;
								}
								break;
								case 'Footer':
									foreach ($keywords as $keyword) {
										$countTime++;
									$result = substr_count($tempFooter,$keyword);
									if($result) $KeyCount++;
								}
								break;
								case 'Body':
									foreach ($keywords as $keyword) {$countTime++;
									$result = substr_count($tempBody,$keyword);
									if($result) $KeyCount++;
								}
								break;
								default:
									foreach ($keywords as $keyword) {$countTime++;
									$result = substr_count($ocrText,$keyword);
									if($result) $KeyCount++;
								}
								break;
							}
						}
					}
					//print_r($pageNo);exit;
					$pageConfidence =(($KeyWordCutOff != 0)? 0.5 + (($KeyCount/$KeyWordCutOff)/2):0.5 + (($KeyCount/$KeywordsCount)/2));

					if($pageConfidence >= $Confidence){
						
						if(isset($resultData[$pageNo])){
							$k = count($resultData[$pageNo]);
							$sameDocTypeMatch=false;
							$diffDocTypeMatch=false;
							for($i=0;$i<$k;$i++){
								if($pageConfidence > $resultData[$pageNo][$i]['pageConfidence'] &&$resultData[$pageNo][$i]['docTypeUID'] == $docTypeUID ){
									$sameDocTypeMatch=$i;
								}else if($resultData[$pageNo][$i]['docTypeUID'] != $docTypeUID ){
									$diffDocTypeMatch=$i;
								}
							}
							if($sameDocTypeMatch && !$diffDocTypeMatch){
								$resultData[$pageNo][$sameDocTypeMatch]['pageConfidence']=$pageConfidence;
							}
							if($diffDocTypeMatch && !$sameDocTypeMatch){
								$PageArray = [];
									$PageArray['docName']=$key;
									$PageArray['docTypeUID']=$docTypeUID;
									$PageArray['pageConfidence']=$pageConfidence;
									$PageArray['pageNo']=$pageNo;
									array_push($resultData[$pageNo],$PageArray);
							}

						}else{

						
							$resultData[$pageNo]=array();
							$PageArray = [];
							$PageArray['docName']=$key;
							$PageArray['docTypeUID']=$docTypeUID;
							$PageArray['pageConfidence']=$pageConfidence;
							$PageArray['pageNo']=$pageNo;
							array_push($resultData[$pageNo],$PageArray);
							$pattern='/\bPage(\\s*).(\\d+)(\\s+)((?:[a-z][a-z]+))(\\s+)(\\d+)\b/i';
							$pattern1='/\bPage(\\s+)(\\d+$)\b/i';
							if(preg_match($pattern, $tempHeader.$tempFooter, $matches)){
								//print_r($matches);echo "sushma";exit;	
								$string=$matches[0];
								$this->getUnclassifiedPages($string,$filename,$pageNo,$key,$docTypeUID,$tempHeader.$tempFooter,$pattern,$Header,$Footer,$LowerCaseSearch);
							}elseif (preg_match($pattern1, $tempHeader.$tempFooter, $matches)) {
								//print_r($matches);echo "sushma";exit;	
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
	//print_r($tempOcrText);exit;
	$lines =($LowerCaseSearch == 1? explode("\n",strtolower($tempOcrText)):explode("\n",$tempOcrText));
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
	$start=preg_replace("/[^0-9]/", "", $explode[1]);
	$end=(isset($explode[3]))?($explode[3]):0;
	GLOBAL $resultData;
	GLOBAL $missedPages;
	GLOBAL $tempHeader;
	GLOBAL $tempFooter;
	GLOBAL $tempBody;

	$tempHeader="";$tempFooter="";$tempBody="";
	$startPage = (($pageNo-$start)+1>0)?(($pageNo-$start)+1):1;
	$endPage = ($start && $end!=0)?$pageNo+($end - $start):$pageNo;
	$matchedEnd=0;	
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
			$matchedEnd=$i;
			if(!$end)$endPage++; 
		}
		for ($m=$startPage; $m < $matchedEnd; $m++) { 
			if(!isset($resultData[$m])){
				$resultData[$m]=array();
				$PageArray = [];
				$PageArray['docName']=$key;
				$PageArray['docTypeUID']=$docTypeUID;
				$PageArray['pageConfidence']=0;
				$PageArray['pageNo']=$m;
				array_push($resultData[$m],$PageArray);
			}
		}
	}

	LOG_MSG('INFO','getUnclassifiedPages(): END \n');
	return ;
}
/*mandatoryKey search headerContent end*/


function deleteDirectory($dir) {
	LOG_MSG('INFO','deleteDirectory(): START \n');

	if (is_dir($dir)) {
		exec('rm -rf ' . escapeshellarg($dir), $retval);
		return $retval == 0; 
	}else{
		echo "No such directory found";
	}

	LOG_MSG('INFO','deleteDirectory(): END \n');
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
				$this->CI->Home_model->updateTpages($data);
				//write the file here
		$response=$this->CI->Home_model->getTpagesd($file,$i);

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
				$this->CI->Home_model->updateTpages($data);
		$response=$this->CI->Home_model->getTpagesd($file,$i);		
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
	  $cmd = "sudo chown www-data:www-data ".MAINPATH.$split_name[0].'/pages/table-'.$i.'.php';
			$res = exec($cmd);
			$cmd = "sudo chmod 777 www-data:www-data ".MAINPATH.$split_name[0].'/pages/table-'.$i.'.php';
			$res = exec($cmd);
			//chmod(MAINPATH.$split_name[0].'/pages/table-'.$i.'.php', 0777); 
			//chown(MAINPATH.$split_name[0].'/pages/table-'.$i.'.php', 'www-data');
			fwrite($fp,$text);
			fclose($fp);

		    // if ( ! write_file(MAINPATH.$split_name[0].'/table-'.$i.'.php', $text)){ }
	    	// else{}
}

}
?>