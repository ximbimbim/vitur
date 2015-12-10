<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tours]].
 *
 * @see Tours
 */
class ToursQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Tours[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tours|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}