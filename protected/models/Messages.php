<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property integer $id
 * @property string $text
 * @property string $created
 * @property string $modified
 * @property string $deleted
 */
class Messages extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'messages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('text', 'required'),
            array('modified', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'update'),
            array('created,modified', 'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false, 'on' => 'insert')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'text' => 'Text',
            'created' => 'Created',
            'modified' => 'Modified',
            'deleted' => 'Deleted',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Messages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
