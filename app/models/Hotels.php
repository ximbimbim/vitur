<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotels".
 *
 * @property integer $id
 * @property string $name
 * @property string $to
 * @property double $price
 * @property double $parcel
 *
 * @property Features[] $features
 */
class Hotels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'parcel'], 'number'],
            [['name', 'to'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'to' => Yii::t('app', 'To'),
            'price' => Yii::t('app', 'Price'),
            'parcel' => Yii::t('app', 'Parcel'),
        ];
    }
    
    /**
     * extraFields
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::extraFields()
     */
    public function extraFields()
    {
    	return [ 'features' ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeatures()
    {
        return $this->hasMany(Features::className(), ['hotel' => 'id']);
    }

    /**
     * @inheritdoc
     * @return HotelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HotelsQuery(get_called_class());
    }
}
