<?php
namespace common\models;
/**
 * Created by PhpStorm.
 * User: Mars
 * Date: 2017/1/20/0020
 * Time: 15:07
 */
class Sort{
    //数组排序
    static function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){
        if(is_array($arrays)){
            foreach ($arrays as $array){
                if(is_array($array)){
                    $key_arrays[] = $array[$sort_key];
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
        return $arrays;
    }
}