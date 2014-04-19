<?php

class MessageController extends Controller {

    private $model;

    public function actionDelete() {
        $this->render('delete');
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionNew() {
        $this->render('new');
    }

    public function actionShow() {
        $this->render('show');
    }

    public function actionSse() {
        header("Content-Type: text/event-stream\n\n");
        header('Cache-Control: no-cache');

        $lastPushedMessageID = 0;

        while (1) {
            //Schicke alle 10 Sekunden neue Nachrichten
            //Lade Nachrichten der letzten 24 Stunden (max 10 Nachrichten)
            $criteria = new CDbCriteria;
            $criteria->select = 'id, text, created';
            $criteria->addCondition('board = "1"');
            $criteria->addCondition('deleted IS NULL');



            if ($lastPushedMessageID == 0) {
                $aDay = 60 * 60 * 24 * 7;
                $now = new CDbExpression("(NOW()-$aDay)");
                $criteria->addCondition('created > "' . $now . '"');
            } else {
                $criteria->addCondition('published = "0"');
                $criteria->addCondition('id > "' . $lastPushedMessageID . '"');
            }

            $criteria->limit = 10;
            $criteria->order = "id ASC"; //id DESC

            $messages = Messages::model()->findAll($criteria);
            var_dump($messages);

            if (is_array($messages)) {
                foreach ($messages as $message) {
                    //Wenn ID groesser als zuletzt gesendete Nachricht, schicke wieder raus.
                    if ($message->id > $lastPushedMessageID) {
                        echo "event:messages\n";
                        echo "id:$message->id\n";
                        $data = json_encode(array("text" => $message->text, "created" => $message->created));
                        echo "data:$data\n";
                        echo "\n\n";
                        $lastPushedMessageID = $message->id;
                    }
                }
            } else {
                if (!$messages->id) {
                    echo "event:messages\n";
                    echo "id:000000\n";
                    echo "data:Keine neue Nachrichten\n";
                    echo "\n\n";
                } else {
                    echo "event:messages\n";
                    echo "id:$messages->id\n";
                    echo "data:$messages->text\n";
                    echo "\n\n";
                    $lastPushedMessageID = $messages->id;
                }
            }
            flush();
            sleep(20);
        }
    }

    public function actionAjax() {
        $this->model = new Messages;


        if (isset($_POST['message'])) {

            $this->model->text = $_POST['message'];
            $this->model->board = 1;
            
            if ($this->model->validate()) {
                if ($this->model->save()) {
                    // Validate ok! Saving your data from form okay!
// Send a response back!
                    header('Content-type: application/json');
                    echo json_encode(array('result' => true, 'data' => 'Valid Data, Saving succeeded')); // Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
                    Yii::app()->end(); // Properly end the appÏ
                } else {
                    // Validate ok! Saving your data from form failed!
// Send a response back!
                    header('Content-type: application/json');
                    echo CJSON::encode(array('result' => false, 'data' => 'Valid Data, Saving failed', 'model' => $this->model)); // Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
                    Yii::app()->end(); // Properly end the appÏ
                }
            }
            // Validate not ok! 
// Send a response back!
            header('Content-type: application/json');
            echo json_encode(array('result' => false, 'data' => 'No Valid Data')); // Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
            Yii::app()->end(); // Properly end the appÏ
        }
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
