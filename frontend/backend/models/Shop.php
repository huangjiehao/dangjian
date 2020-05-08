<?php
	namespace backend\models;
    use yii\base\Model;		
	use yii\db\ActiveRecord;
	/**
	 *门店模型类 
	 */
	class Shop extends ActiveRecord{
		
	public $name;
    public $email;
	public $content;
	
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
	
	public function add(){
		if($this->validate()){
			
			
			
			
		}
		
		
		
	}	
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	?>