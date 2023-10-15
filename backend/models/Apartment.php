<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "apartment".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property int|null $rent
 * @property int|null $rooms
 * @property int|null $is_smoking
 * @property int|null $is_animal_allowed
 * @property int|null $is_parking_spot
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $image_path
 * @property $imageFile
 */
class Apartment extends \yii\db\ActiveRecord
{

    public $imageFile;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apartment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rent', 'rooms', 'is_smoking', 'is_animal_allowed', 'is_parking_spot', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'address', 'image_path'], 'string', 'max' => 255],
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
            'address' => 'Address',
            'rent' => 'Rent',
            'rooms' => 'Rooms',
            'is_smoking' => 'Smoking',
            'is_animal_allowed' => 'Pets Allowed',
            'is_parking_spot' => 'Personal Parking Spot',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'image_path' => 'Image',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->imageFile->saveAs("@backend/web/uploads/img/" . $this->image_path)) {
                return true;
            } else {
                // Debugging: Print error details
                var_dump($this->imageFile->error);
            }
        }
        return false;
    }

    public function getRental() {
        return $this->hasMany(Rental::class, ['id' => 'rental_id']);
    }

    public function getImageFile()
    {
        return null;
    }
}
