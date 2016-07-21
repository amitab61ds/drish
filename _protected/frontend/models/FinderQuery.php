<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Finder]].
 *
 * @see Finder
 */
class FinderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Finder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Finder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}