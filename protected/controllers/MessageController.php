<?php

class MessageController extends Controller {

    private $model;

    public function actionDelete() {
        $this->render('delete');
    }

    public function actionIndex() {
        $board = Yii::app()->request->getQuery('board', '1');
        $this->render('index', array("board" => $board));
    }

    public function actionNew() {
        $this->render('new');
    }

    public function actionShow() {
        $this->render('show');
    }

    public function actionSse() {
        $board = Yii::app()->request->getQuery('board', '1'); //Default: 1 == Nachrichten, die ueberall angezeigt werden
        header("Content-Type: text/event-stream\n\n");
        header('Cache-Control: no-cache');

        $lastPushedMessageID = 0;

        while (1) {
            //Schicke alle 10 Sekunden neue Nachrichten
            //Lade Nachrichten der letzten 24 Stunden (max 10 Nachrichten)
            $criteria = new CDbCriteria;
            $criteria->select = 'id, text, created, infotype';
            $criteria->addCondition('board = "'.$board.'"');
            $board != 1?$criteria->addCondition('board = "1"', 'OR'):'';
            $criteria->addCondition('deleted IS NULL');



            if ($lastPushedMessageID == 0) {
                $aDay = 60 * 60 * 24;
                $now = new CDbExpression("(NOW()-$aDay)");
                $criteria->addCondition('created > "' . $now . '"');
                $criteria->order = "id DESC"; //id DESC
            } else {
                $criteria->addCondition('published = "0"');
                $criteria->addCondition('id > "' . $lastPushedMessageID . '"');
            }

            $criteria->limit = 10;

            $messages = Messages::model()->findAll($criteria);

            if (is_array($messages)) {
                if ($lastPushedMessageID == 0) {
                    $messages = array_reverse($messages);
                }
                foreach ($messages as $message) {
                        echo "event:messages\n";
                        echo "id:$message->id\n";
                        $data = json_encode(array("text" => $message->text, "created" => $message->created, "infotype" => $message->infotype));
                        echo "data:$data\n";
                        echo "\n\n";
                        $lastPushedMessageID = $message->id;
                    
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
            $this->model->board = $_POST['board'];
            $this->model->infotype = $_POST['infotype'];

            if ($this->model->validate()) {
                if ($this->model->save()) {
                    // Validate ok! Saving your data from form okay!
// Send a response back!
                    header('Content-type: application/json');
                    echo json_encode(array('result' => true, 'data' => 'Nachricht wurde gespeichert')); // Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
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
            echo json_encode(array('result' => false, 'data' => 'Validation Failed, No Valid Data', 'postdata' => $_POST)); // Use CJSON::encode() instead of json_encode() if you are encoding a Yii model
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
