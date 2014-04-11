<?php

class MessageController extends Controller {

    private $model;

    public function init() {
        parent::init();
        $this->model = new Messages();
    }

    public function actionDelete() {
        $this->render('delete');
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionNew() {
        $this->render('new', array('model' => $this->model,));
    }

    public function actionShow() {
        $this->render('show');
    }

    public function actionAjax() {

        if (isset($_POST['MessageForm'])) {


            $this->model->attributes = $_POST['MessageForm'];
            if ($this->model->validate()) {
// form inputs are valid, do something here
                print_r($_REQUEST);
                return;
            }
        }
// Validate ok! Saving your data from form okay!
// Send a response back!
        header('Content-type: application/json');
        echo json_encode(array('result' => true, 'data' => '$modelDataOrSomeJunkToGiveBackToBrowser')); // Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
        Yii::app()->end(); // Properly end the appÏ
    }

// Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}