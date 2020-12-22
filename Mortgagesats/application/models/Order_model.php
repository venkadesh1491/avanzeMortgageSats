<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'tOrders';
        // Set orderable column fields
        $this->column_order = array(null, 'OrderNumber','LoanNumber','OrderUID');
        // Set searchable column fields
        $this->column_search = array('OrderNumber','LoanNumber','OrderUID');
        // Set default order
        $this->order = array('OrderNumber' => 'asc');
    }
    
    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
          $this->db->where('StatusUID=',15);
        $this->db->from($this->table);
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    public function getTDocs($OrderUID){
        $sql=$this->db->query("select * from tDocuments where OrderUID=".$OrderUID);
        return $sql->row_array();
    }
    public function getstatusTDocs($OrderUID){
        $sql=$this->db->query("select * from tOrders where StatusUID=100 order by OrderNumber asc");
        return $sql->row_array();
    }

    public function insertTDocument($data){
        $this->db->where('DocumentUID',$data['DocumentUID']);
        $this->db->update('tDocuments',$data);
        return true;
    }


    
    function insertTpages($data){
        $this->db->insert('tPage',$data);
        return true;
    }


    function getTpagesByOrderUid($orderUid){
        //$query=$this->db->query("select t.PageNo,t.ocrCategoryName,t.manualOCR,t.pageConfidence,c.CategoryName from tPage t,mCategory c where t.CategoryName=c.HashCode and t.OrderUID=".$orderUid." order by t.PageNo ASC");

        $query=$this->db->query("select t.PageNo,t.DocumentTypeUID,t.manualDocumentTypeUID,t.pageConfidence,t.ocrDocumentTypeUID,c.DocumentTypeName,c.DocumentTypeUID from tPage t LEFT JOIN mDocumentType c ON t.DocumentTypeUID=c.DocumentTypeUID where t.OrderUID=".$orderUid."  order by t.PageNo ASC");

        //$query=$this->db->query("select t.PageNo,t.ocrCategoryName,t.pageConfidence,c.CategoryName from tPage t LEFT JOIN  mCategory as c ON t.ocrCategoryName=c.HashCode where t.OrderUID='".$orderUid."' order by t.PageNo ASC");
        //$query=$this->db->query("SELECT t.* FROM tPage t where t.OrderUID='".$orderUid."' order by t.PageNo ASC");
        return $query->result_array();
    }


    function updateTpages($data){
        $sql="update tpage set ocrDocType=?,pageConfidence=?,flag=1 where OrderUID=? and PageNo=?";
        $query=$this->db->query($sql,array('ocrDocType'=>$data['ocrDocType'],'pageConfidence'=>$data['pageConfidence'],'OrderUID'=>$data['OrderUID'],'PageNo'=>$data['pageNo']));
        return true;
    }



    function updateTpagesByOrderUID($OrderUID){
        $sql="update tpage set ocrDocType='',pageConfidence=null where OrderUID=?";
        $query=$this->db->query($sql,array('OrderUID'=>$OrderUID));
        return true;
    }




    function getTpagesd($orderUid,$PageNo){
        $query=$this->db->query("SELECT t.* FROM tpage t where t.ocrDocType!='' and t.pageConfidence!='' and t.OrderUID='".$orderUid."' and t.PageNo=".$PageNo);
        return $query->row_array();
    }

        function getAllDocumentType(){
        $query=$this->db->query("SELECT DocumentTypeName,DocumentTypeUID FROM mDocumentType WHERE Active =1 order by DocumentTypeUID ASC");
        return $query->result_array();
    }


// Sushma
    function getAllHeaderTypes(){
        $query=$this->db->query("SELECT * FROM mPageSection");
        return $query->result_array();
    }
// 

        function addDocDef($data){
        $this->db->insert('mDocDef',$data);
        return $this->db->insert_id();
    }

    function addDocDefKeywords($data){
       
        $this->db->insert('mKeywords',$data);
       // return $this->db->insert_id();
    }
    function getDocDefById($DocumentTypeUID){

         $query=$this->db->query("select * from mDocDef where DocTypeUID='".$DocumentTypeUID."'");
         return $query->row_array();
    }

    function getKeywordsByDocDefId($DocDefUID){
        $query=$this->db->query("select * from mKeywords where DocDefUID='".$DocDefUID."'");
      //  print_r($query->result_array());
        return $query->result_array();
    }

    function deleteDocDef($id){
        $this->db->delete('mDocDef', array('DocDefUID' => $id));
        return true;
    }

    function deleteKeywords($id){
        $this->db->delete('mKeywords', array('DocDefUID' => $id));
        return true;
    }

        function getAllDocDef(){
        $query=$this->db->query("select * from mDocDef");
        return $query->result_array();
    }

    function getAllKeywords(){
        $query=$this->db->query("select * from mKeywords");
        return $query->result_array();
    }


    function getAllOrders(){
        $query=$this->db->query("select * from tOrders  order by OrderNumber asc");
        return $query->result_array();
    }


    function getCompletedOrders(){
        $query=$this->db->query("select * from tOrders where StatusUID!=100 order by OrderNumber asc");
        return $query->result_array();
    }


    function getInCompleteOrders(){
        $query=$this->db->query("select * from tOrders where StatusUID=100 order by OrderNumber asc");
        return $query->result_array();
    }


    function getCategories(){
        $query=$this->db->query("SELECT CategoryName,HashCode FROM mCategory order by CategoryName ASC");
        return $query->result_array();
    }

    function getOrdersByOrderUid($OrderUID){
        $query=$this->db->query("SELECT * FROM tOrders where OrderUID=".$OrderUID);
        return $query->row_array();
    }
    function getOrderslistByOrderUid($OrderUID){
        $query=$this->db->query("SELECT * FROM tOrders where StatusUID = 100 and OrderUID=".$OrderUID);
        return $query->row_array();
    }

    function updateManualTPages($data){
        $query=$this->db->query("Update tPage set manualDocumentTypeUID='".$data['manualDocumentTypeUID']."' where OrderUID=".$data['OrderUID']." and pageNo=".$data['pageNo']);
        return true;
    }

    function checkForDuplicates($DocTypeUID){
        $query=$this->db->query("select * from mDocDef where DocTypeUID='".$DocTypeUID."'");
        return $query->row_array();
    }

    function deleteAllDocDef(){
        $query=$this->db->query("delete from mDocDef");
        return true;
    }

    function deleteAllDocDefKeywords(){
        $query=$this->db->query("delete from mKeywords ");
        return true;
    }

    function getCategoriesByHash($HashCode){
        $query=$this->db->query("select c.CategoryName from mCategory c where c.HashCode='".$HashCode."'");
        return $query->row_array();
    }


    function deleteDocTypeByUID($id){
        $this->db->delete('mDocumentType', array('DocumentTypeUID' => $id));
        return true;
    }

    function addDocumentType($data){
        $this->db->insert('mDocumentType',$data);
        return $this->db->insert_id();
    }

    function updateTOrders($OrderUID){
        $query=$this->db->query("Update tOrders set StatusUID=15 where OrderUID=".$OrderUID);
        return true;
    }


    function getOrderDetailsByOrderNo($OrderNumber){
        $query=$this->db->query("SELECT * FROM tOrders where OrderNumber='".$OrderNumber."'");
        return $query->row_array();
    }

    function checkForDuplicatePages($PageNo,$OrderUID){
        $query=$this->db->query("select * from tPage where OrderUID=".$OrderUID." AND PageNo=".$PageNo);
        return $query->row_array();
    }

    function getDocumentTypesByTpages(){
        $query=$this->db->query("select mDocumentType.*,tPage.ocrDocumentTypeUID from tPage LEFT JOIN mDocumentType ON mDocumentType.DocumentTypeUID=tPage.ocrDocumentTypeUID WHERE tPage.ocrDocumentTypeUID!='' GROUP BY mDocumentType.DocumentTypeUID");
        return $query->result_array();
    }

    function getTpagesByDocId($DocumentTypeUID,$OrderUID){
        $query=$this->db->query("SELECT * FROM tPage where ocrDocumentTypeUID=".$DocumentTypeUID." AND OrderUID=".$OrderUID);
        return $query->result_array();
    }

    function getTDocuments($OrderUID){
        $query=$this->db->query("SELECT * FROM `tOrders` 
        LEFT JOIN tDocuments ON tDocuments.OrderUID = tOrders.OrderUID 
        WHERE tOrders.OrderUID=".$OrderUID." GROUP by tOrders.OrderUID");
        return $query->row_array();
    }

    function insertDocumentTypes($data){
        $result=$this->db->query("select DocumentTypeName,DocumentTypeUID from mDocumentType where DocumentTypeName='".$data['DocumentTypeName']."'")->row();
        
        if(!empty($result)){
            $insert_id = $result->DocumentTypeUID;
            
        }else{
            $this->db->insert('mDocumentType',$data);
            $insert_id = $this->db->insert_id();
        }
        return $insert_id;
    }
    
    function SaveOrder($post)
        {
            $productArr = array( 
                                    'OrderNumber'=>$post['OrderNumber'],
                					'OrderEntryDateTime'=>date('Y-m-d H:i:s'),
                					'OrderDueDate'=>date('Y-m-d H:i:s'),
                					'CustomerUID'=>15,
                					'LenderUID'=>1,
                					'LoanNumber'=>$post['LoanNumber'],
                					'PropertyAddress1'=>$post['PropertyAddress1'],
                					'PropertyZipCode'=>$post['PropertyZipCode'],
                					'PropertyCityName'=>$post['PropertyCityName'],
                					'PropertyStateCode'=>$post['PropertyStateCode'],
                					'PropertyCountyName'=>$post['PropertyCountyName'],
                					'ProjectUID'=>14,
                					'StatusUID'=>100
                              );
            $this->db->insert('tOrders',$productArr);  
            $insert_id = $this->db->insert_id();

            if(isset($_FILES['DocumentURL']))
            {
                
                $uploaddir = 'uploads/OrderDocumentPath/'.$post['OrderNumber'].'/';
                if(!is_dir($uploaddir)) 
                { 
                    mkdir($uploaddir, 0777, true); 
                    $cmd = "sudo chown -R www-data:www-data ".$uploaddir;
                    $res = exec($cmd);
                    $cmd = "sudo chmod -R 777 ".$uploaddir;
                    $res = exec($cmd);
                }
                $uploadfile = $uploaddir . basename($_FILES['DocumentURL']['name']);

                if (move_uploaded_file($_FILES['DocumentURL']['tmp_name'], $uploadfile)) {
                   // echo "File is valid, and was successfully uploaded.\n";
                    $cmd = "sudo chown -R www-data:www-data sample.txt";
                    $res = exec($cmd);
                    $cmd = "sudo chmod -R 777 sample.txt";
                    $res = exec($cmd);
                } 

                        $productImg =  array();
                        $productImg['DocumentName'] = $_FILES['DocumentURL']['name'];
                        $productImg['DocumentURL'] = $uploaddir.$_FILES['DocumentURL']['name'];
                        $productImg['OrderUID'] = $insert_id;
                        $productImg['IsStacking'] = 1;
                        $productImg['TypeofDocument'] = 'Stacking';
                        $productImg['UploadedDateTime'] =date('Y-m-d H:i:s');
                        $productImg['UploadedByUserUID'] = 1;
                        $productImg['TotalPages'] = 0;
                        $this->db->insert('tDocuments',$productImg);
            
            }
            if($this->db->insert_id() > 0)
            {
                return 1;
            }
            else
            {
                return 0;
            }
    }
    

}