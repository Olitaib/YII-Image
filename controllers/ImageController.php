<?php

namespace app\controllers;

use app\DataStore\ImageDataStore;
use app\models\Image;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class ImageController extends Controller
{

    public $model;
    public $dataStore;

    public function __construct($id, $module, Image $model, ImageDataStore $imageDataStore, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->model = $model;
        $this->dataStore = $imageDataStore;
    }

    public function actionStore(): string
    {
        if (Yii::$app->request->isPost) {
            $this->model->images = UploadedFile::getInstances($this->model, 'images');

            if ($this->dataStore->store($this->model->images)) {
                return "Successfully uploaded";
            }
        }

        return $this->render('upload', ['model' => $this->model]);
    }

    public function actionShow(): string
    {
        return $this->render('show', ['dataProvider' => $this->dataStore->show()]);
    }

    public function actionView($id): string
    {
        return $this->render('view', ['model' => $this->dataStore->view($id)]);
    }

    public function actionGet($id): Response
    {
        return $this->asJson($this->dataStore->get($id));
    }

    public function actionTotal(): Response
    {
        return $this->asJson($this->dataStore->total());
    }

    public function actionRows($page): Response
    {
        return $this->asJson($this->dataStore->rows($page));
    }

}
