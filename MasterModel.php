<?php 
abstract class MasterModel extends CActiveRecord
{
	public function behaviors()
    {
        return array(
            'HGuidBehavior' => array(
                'class' => 'application.behaviors.HGuidBehavior',
            ),
            'SlugBehavior' => array(
				'class' => 'application.behaviors.SlugBehavior',
				'slug_col' => 'slug',
				'title_col' => 'title',
				'max_slug_chars' => 125,
				'overwrite' => false
			),
           
        );
    }
    public function beforeSave()
    {
        $current_time = date('Y-m-d H:i:s');
        if ( $this->isNewRecord )
        {
           $this->created = $current_time;
           $this->modified = $current_time;
          // if(array_key_exists('user_id',$this))
           $this->user_id = Yii::app()->user->id;
        }
        if ( ! $this->isNewRecord )
        {
           $this->modified = $current_time;
           //$this->updated_by = Yii::app()->user->id;
        }
        return parent::beforeSave();
    }
}

?>
