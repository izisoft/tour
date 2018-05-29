<?php
/**
 * 
 * @link http://iziweb.vn
 * @copyright Copyright (c) 2016 iziWeb
 * @email zinzinx8@gmail.com
 *
 */
namespace izi\tour;
use Yii;
class Tour extends \yii\base\Component
{
	 
    private $_program, $_quotation;
	 
	public function getProgram(){
	    if($this->_program === null){
	        $this->_program = new \izi\tour\Program();
	    }
	    return $this->_program;
	}
	
	public function setProgram($param){
	    
	    $this->_program = $param;
	    
	}
	
	public function getQuotation(){
	    if($this->_quotation === null){
	        $this->_quotation = new \izi\tour\Quotation();
	    }
	    return $this->_quotation;
	}
	
	public function setQuotation($param){
	    
	    $this->_quotation = $param;
	    
	}
	public function getSupplierIDFromService($id = 0,$type = 0){
	    $supplier_id = 0;
	    switch ($type){
	        case TYPE_ID_SCEN: // Thang canh
	        case TYPE_ID_TRAIN: // Ve tau hoa
	            $supplier_id = (new \yii\db\Query())->from('tickets_to_suppliers')->where([
	            'ticket_id'=>$id
	            ])->select('supplier_id')->scalar();
	            break;
	        case TYPE_ID_GUIDES: //HDV
	            
	            $supplier_id = (new \yii\db\Query())->from('guides_to_suppliers')->where([
	            'guide_id'=>$id
	            ])->select('supplier_id')->scalar();
	            break;
	        case TYPE_ID_SHIP:
	            $supplier_id = (new \yii\db\Query())->from('distances_to_suppliers')->where([
	            'item_id'=>$id
	            ])->select('supplier_id')->scalar();
	            break;
	        case TYPE_ID_TEXT: break;
	        default: $supplier_id = $id; break;
	    }
	    return $supplier_id;
	}
}