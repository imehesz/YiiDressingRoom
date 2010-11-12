<?php

/**
 * This is the model class for table "themes".
 *
 * The followings are the available columns in table 'themes':
 * @property integer $id
 * @property integer $userID
 * @property string $name
 * @property string $short_desc
 * @property string $long_desc
 * @property string $preview1
 * @property string $preview2
 * @property string $file
 * @property integer $score
 * @property integer $viewed
 * @property integer $downloaded
 * @property integer $created
 * @property integer $updated
 * @property integer $deleted
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Theme extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Theme the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'themes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, short_desc, long_desc, preview1, preview2, file, viewed, downloaded, created, updated', 'required'),
			array('userID, score, viewed, downloaded, created, updated, deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('preview1, preview2, file', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, name, short_desc, long_desc, preview1, preview2, file, score, viewed, downloaded, created, updated, deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'Users', 'userID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'userID' => 'User',
			'name' => 'Name',
			'short_desc' => 'Short Desc',
			'long_desc' => 'Long Desc',
			'preview1' => 'Preview1',
			'preview2' => 'Preview2',
			'file' => 'File',
			'score' => 'Score',
			'viewed' => 'Viewed',
			'downloaded' => 'Downloaded',
			'created' => 'Created',
			'updated' => 'Updated',
			'deleted' => 'Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('short_desc',$this->short_desc,true);
		$criteria->compare('long_desc',$this->long_desc,true);
		$criteria->compare('preview1',$this->preview1,true);
		$criteria->compare('preview2',$this->preview2,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('viewed',$this->viewed);
		$criteria->compare('downloaded',$this->downloaded);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}