<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "features".
 *
 * @property integer $id
 * @property integer $hotel
 * @property string $name
 * @property string $class
 *
 * @property Hotels $hotel0
 */
class Features extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'features';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel'], 'required'],
            [['hotel'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['class'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hotel' => Yii::t('app', 'Hotel'),
            'name' => Yii::t('app', 'Name'),
            'class' => Yii::t('app', 'Class'),
        ];
    }
    
    /**
     * extraFields
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::extraFields()
     */
    public function extraFields()
    {
    	return [ 'hotel0' ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel0()
    {
        return $this->hasOne(Hotels::className(), ['id' => 'hotel']);
    }

    /**
     * @inheritdoc
     * @return FeaturesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeaturesQuery(get_called_class());
    }
}
