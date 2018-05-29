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
class Program extends \yii\db\ActiveRecord
{
    
    public function removeServiceDay($o = []){
        $a = ['item_id','service_id','type_id','day_id','time_id','package_id'];
        foreach ($a as $b){
            $$b = isset($o[$b]) ? $o[$b] : 0;
            $con[$b] = $$b;
        }
        Yii::$app->db->createCommand()->delete('{{%tours_programs_services_prices}}',$con)->execute();
        Yii::$app->db->createCommand()->delete('{{%tours_programs_services_days}}',$con)->execute();
    }
    
    public function insertServiceDay($o = []){
        $a = ['item_id','service_id','type_id','day_id','time_id','package_id'];
        foreach ($a as $b){
            $$b = isset($o[$b]) ? $o[$b] : 0;
            $con[$b] = $$b;
        }
        //
        $a = ['quantity','price1','currency','sub_item_id'];
        
    }
    
    /**
     * Update service day
     * @param array $o
     */
    public function changeServiceDay($param, $o = []){
        $a = ['item_id','type_id','day_id','time_id','package_id'];
        foreach ($a as $b){
            $$b = isset($o[$b]) ? $o[$b] : 0;
            $con[$b] = $$b;
        }
        /**
         * Check existed
         */
        if((new \yii\db\Query())->from('{{%tours_programs_services_prices}}')->where($con)->count(1) == 0){
            Yii::$app->db->createCommand()->insert('{{%tours_programs_services_prices}}',$con)->execute();
        }
        
        Yii::$app->db->createCommand()->update('{{%tours_programs_services_days}}',$param,$con)->execute();
        $param['supplier_id'] = Yii::$app->tour->getSupplierIDFromService($param['service_id'],$type_id);
        Yii::$app->db->createCommand()->update('{{%tours_programs_services_prices}}',$param,$con)->execute();
    }
    
    
    
    
    public function removeServiceDayPrice($o = []){
        $a = ['item_id','service_id','type_id','day_id','time_id','package_id'];
        foreach ($a as $b){
            $$b = isset($o[$b]) ? $o[$b] : 0;
            $con[$b] = $$b;
        }
        Yii::$app->db->createCommand()->delete('{{%tours_programs_services_prices}}',$con)->execute();
    }
    
    public function insertServiceDayPrice($o = []){
        $a = ['item_id','service_id','type_id','day_id','time_id','package_id','quantity','price1','sub_item_id'];
        foreach ($a as $b){
            $$b = isset($o[$b]) ? $o[$b] : 0;
            $con[$b] = $$b;
        }
        //
        $currency = isset($o['currency']) ? $o['currency'] : 1;
        
        
        
    }
    
}