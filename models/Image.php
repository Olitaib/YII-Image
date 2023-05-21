<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Image extends ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $images;

    public static function tableName()
    {
        return 'image';
    }

    public function rules(): array
    {
        return [
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, jfif', 'maxFiles' => 5],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'image' => 'image',
            'created_at' => 'created_at',
        ];
    }

}