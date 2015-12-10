<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_features".
 *
 * @property integer $hotel_fk
 * @property integer $features_fk
 *
 * @property Hotels $hotelFk
 * @property Features $featuresFk
 */
class HotelFeatures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_features';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_fk', 'features_fk'], 'required'],
            [['hotel_fk', 'features_fk'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotel_fk' => Yii::t('app', 'Hotel Fk'),
            'features_fk' => Yii::t('app', 'Features Fk'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelFk()
    {
        return $this->hasOne(Hotels::className(), ['id' => 'hotel_fk']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeaturesFk()
    {
        return $this->hasOne(Features::className(), ['id' => 'features_fk']);
    }

    /**
     * @inheritdoc
     * @return HotelFeaturesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HotelFeaturesQuery(get_called_class());
    }
}
