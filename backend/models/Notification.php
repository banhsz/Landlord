<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int|null $message
 * @property int|null $source_class
 * @property int|null $source_entity
 * @property int|null $read
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'source_class', 'source_entity', 'read'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'source_class' => 'Source Class',
            'source_entity' => 'Source Entity',
            'read' => 'Read',
        ];
    }
}
