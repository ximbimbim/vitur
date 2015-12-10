<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tours".
 *
 * @property integer $id
 * @property integer $hotel_fk
 * @property string $go_date
 * @property string $go_hour
 * @property string $back_date
 * @property string $back_hour
 * @property string $airport_go
 * @property string $airport_back
 *
 * @property Hotels $hotelFk
 */
class Tours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_fk', 'go_date', 'go_hour', 'back_date', 'back_hour', 'airport_go', 'airport_back'], 'required'],
            [['hotel_fk'], 'integer'],
            [['go_date', 'go_hour', 'back_date', 'back_hour'], 'safe'],
            [['airport_go', 'airport_back'], 'string', 'max' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hotel_fk' => Yii::t('app', 'Hotel Fk'),
            'go_date' => Yii::t('app', 'Go Date'),
            'go_hour' => Yii::t('app', 'Go Hour'),
            'back_date' => Yii::t('app', 'Back Date'),
            'back_hour' => Yii::t('app', 'Back Hour'),
            'airport_go' => Yii::t('app', 'Airport Go'),
            'airport_back' => Yii::t('app', 'Airport Back'),
        ];
    }
    
    /**
     * extraFields
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::extraFields()
     */
    public function extraFields()
    {
    	return [ 'hotelFk' ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelFk()
    {
        return $this->hasOne(Hotels::className(), ['id' => 'hotel_fk']);
    }

    /**
     * @inheritdoc
     * @return ToursQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ToursQuery(get_called_class());
    }
}
