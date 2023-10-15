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
 * @property Tenant $tenant
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
            [['apartment_id', 'tenant_id'], 'integer'],
            [['rent_start', 'rent_end', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'safe'],
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

    public function getTenant() {
        return $this->hasOne(Tenant::class, ['id' => 'tenant_id']);
    }

    public function getRental() {
        return $this->hasOne(Rental::class, ['id' => 'rental_id']);
    }

    public function getApartment() {
        return $this->hasOne(Apartment::class, ['id' => 'apartment_id']);
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->rent_start) $this->rent_start = strtotime($this->rent_start);
            if ($this->rent_end) $this->rent_end = strtotime($this->rent_end);
            $this->updated_at = time();
            $this->updated_by = Yii::$app->user->identity->getId();
            if ($this->isNewRecord) {
                $this->created_at = time();
                $this->created_by = Yii::$app->user->identity->getId();
            }
            return true;
        }
        return false;
    }
}
