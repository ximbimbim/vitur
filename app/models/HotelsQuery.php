<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Hotels]].
 *
 * @see Hotels
 */
class HotelsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Hotels[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Hotels|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}