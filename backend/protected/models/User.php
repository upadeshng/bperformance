<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $createdAt
 * @property string $updatedAt
 */
class User extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['name, email, mobile', 'required'],
            ['name, email, mobile', 'length', 'max' => 255],
            ['password, deletedAt, createdAt, updatedAt', 'safe'],
            [
                'id, name, email, mobile',
                'safe',
                'on' => 'search'
            ],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return [
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {

        $this->name = ucwords($this->name);

        if ($this->isNewRecord) {
            $this->createdAt = date('Y-m-d H:i');

        } else {
            $this->updatedAt = date('Y-m-d H:i');
        }

        return parent::beforeSave();
    }

    public static function attributes_comma_string()
    {
        $model = new self();
        $attr_array = $model->getAttributes();
        $key_array = array_keys($attr_array);
        return 't.' . implode(',t.', $key_array);
    }

    public function getCreatedAt()
    {
        return date('d M Y H:i a', strtotime($this->createdAt));
    }

    public static function findById($id)
    {
        $model = self::model()->findByPk($id);
        if (!$model) {
            $return_data = ['result' => 'ERROR', 'message' => 'No data found'];
            /* response */
            Common::send_api_response(200, CJSON::encode($return_data));
            Yii::app()->end();
        }

        return $model;
    }
}
