<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tenant".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $e_mail
 * @property string|null $phone
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Tenant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tenant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'e_mail', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'e_mail' => 'E Mail',
            'phone' => 'Phone',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
