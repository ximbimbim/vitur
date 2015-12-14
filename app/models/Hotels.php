<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotels".
 *
 * @property integer $id
 * @property string $name
 * @property string $city_fk
 * @property double $price
 *
 * @property HotelFeatures[] $hotelFeatures
 * @property Features[] $featuresFks
 * @property City $cityFk
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
            [['price'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['city_fk'], 'string', 'max' => 5]
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
            'city_fk' => Yii::t('app', 'City Fk'),
            'price' => Yii::t('app', 'Price'),
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
    public function getCityFk()
    {
        return $this->hasOne(City::className(), ['airport' => 'city_fk']);
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
