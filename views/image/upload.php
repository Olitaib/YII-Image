<?php

use yii\bootstrap5\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
?>
<div style="align-items: center" >
    <?= $form->field($model, 'images[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <button>Submit</button>
</div>
<?php ActiveForm::end(); ?>

