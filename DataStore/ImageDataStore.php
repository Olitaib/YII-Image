<?php

namespace app\DataStore;
use app\DTO\ImageResponse;
use app\models\Image;
use yii\data\ActiveDataProvider;
use yii\helpers\Inflector;
use Yii;

class ImageDataStore
{

    public string $path = "img/";

    public function store($files): bool
    {
        foreach ($files as $image) {
            $imageName = $this->naming($image->name, $image->extension);

            $image->saveAs($imageName);

            Yii::$app->db->createCommand()->insert('image', [
                'image' => $imageName
            ])->execute();
        }

        return true;
    }

    public function show(): object
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Image::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }

    public function view($id): object
    {
        return Image::findOne($id);
    }

    public function get($id): object
    {
        if (Image::findOne($id)) {
            return Image::findOne($id);
        }
        return new ImageResponse('This id is not found');
    }

    public function total(): array
    {
        $return['total'] = count(Image::find()->all());

        return $return;
    }

    public function rows($page): array
    {
        $return = array_chunk(Image::find()->all(), 10);

        if (isset($return[$page - 1])){
            return $return[$page - 1]; //"-1" needs pages to start from 1
        }

        return ['This page is not found'];
    }

    public function naming(string $imageName, string $imageExtension): string
    {
        $name = $this->path .  Inflector::transliterate(mb_strtolower($imageName));

        if (file_exists($name)) {
            $numbers = 1;

            while (file_exists(str_replace(".$imageExtension", "_copy_$numbers" . ".$imageExtension", $name))) {
                $numbers++;
            }

            $name = str_replace(".$imageExtension", "_copy_$numbers" . ".$imageExtension", $name);
        }

        return $name;
    }
}