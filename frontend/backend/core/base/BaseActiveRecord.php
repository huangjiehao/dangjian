<?php

namespace app\core\base;

use Yii;


class BaseActiveRecord
{
    public static function find()
    {
        return parent::find();
    }
    
    public static function findOne()
    {
        return 'sunshine';
    }
//     public static function findOne($where = null,$orderBy = null)
//     {
//         $query = static::find();
        
//         if($where !==null)
//         {
//             $query->andWhere($where)->one();
//         }
//         if($orderBy !== null)
//         {
//             $query->orderBy($orderBy);
//         }

//         return $query->one();
//     }
    
    /**
     * @inheritdoc
     * @return static[] an array of ActiveRecord instances, or an empty array if nothing matches.
     */
    public static function findAll($where =null,$orderBy=null,$limit=null)
    {
        $query = static::find();
        
        if($where !==null)
        {
            $query->andWhere($where)->one();
        }
        if($orderBy !== null)
        {
            $query->orderBy($orderBy);
        }

        if($limit !== null)
        {
            $query->limit($limit);
        }
        return $query->all();
    }
    
    
    public function afterValidate()
    {
        parent::afterValidate();
        if($this->hasErrors())
        {
            var_dump($this->errors);
        }
    }
}
