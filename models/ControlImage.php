<?php namespace app\models;

use app\models\Entity\Image;
use yii\base\Model;

class ControlImage extends Model
{
    public static function ImageDelete($image_id)
    {
        $image = Image::findOne($image_id);
        if($image){
            $app = \Yii::getAlias('@app');
            $file_name = $app.'/web'.$image->image;
            if(file_exists($file_name)){
                unlink($app.'/web'.$image->image);
            }
            return $image->delete();
        }
    }
}
