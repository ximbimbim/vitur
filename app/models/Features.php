<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "features".
 *
 * @property integer $id
 * @property string $name
 * @property string $class
 *
 * @property HotelFeatures[] $hotelFeatures
 * @property Hotels[] $hotelFks
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
            'name' => Yii::t('app', 'Name'),
            'class' => Yii::t('app', 'Class'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelFeatures()
    {
        return $this->hasMany(HotelFeatures::className(), ['features_fk' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelFks()
    {
        return $this->hasMany(Hotels::className(), ['id' => 'hotel_fk'])->viaTable('hotel_features', ['features_fk' => 'id']);
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
