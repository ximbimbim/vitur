<?php

namespace app\modules\controllers\admin;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render( 'index' );
    }
}
