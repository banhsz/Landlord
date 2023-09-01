<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rental".
 *
 * @property int $id
 * @property int|null $apartment_id
 * @property int|null $tenant_id
 * @property int|null $rent_start
 * @property int|null $rent_end
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Rental extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rental';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apartment_id', 'tenant_id', 'rent_start', 'rent_end', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apartment_id' => 'Apartment ID',
            'tenant_id' => 'Tenant ID',
            'rent_start' => 'Rent Start',
            'rent_end' => 'Rent End',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
