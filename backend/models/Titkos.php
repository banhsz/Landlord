<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "titkos".
 *
 * @property int $id
 * @property int|null $a1
 * @property int|null $a2
 * @property int|null $a3
 * @property int|null $a4
 * @property int|null $a5
 * @property int|null $b1
 * @property int|null $b2
 * @property int|null $sorsolas
 * @property string|null $talalat
 * @property int|null $nyeremeny
 */
class Titkos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'titkos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['a1', 'a2', 'a3', 'a4', 'a5', 'b1', 'b2', 'sorsolas', 'nyeremeny'], 'integer'],
            [['talalat'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'a1' => 'A1',
            'a2' => 'A2',
            'a3' => 'A3',
            'a4' => 'A4',
            'a5' => 'A5',
            'b1' => 'B1',
            'b2' => 'B2',
            'sorsolas' => 'Sorsolas',
            'talalat' => 'Talalat',
            'nyeremeny' => 'Nyeremeny',
        ];
    }
}
