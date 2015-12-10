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
 * @property HotelFeatures[] $hotelFeatures
 * @property Features[] $featuresFks
 * @property Tours[] $tours
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
     * @return \yii\db\ActiveQuery
     */
    public function getHotelFeatures()
    {
        return $this->hasMany(HotelFeatures::className(), ['hotel_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeaturesFks()
    {
        return $this->hasMany(Features::className(), ['id' => 'features_fk'])->viaTable('hotel_features', ['hotel_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tours::className(), ['hotel_fk' => 'id']);
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
