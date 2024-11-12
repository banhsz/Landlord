<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string|null $message
 * @property string|null $source_class
 * @property int|null $source_entity
 * @property int|null $read
 * @property string|null $type
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
            [['message', 'source_class', 'type'], 'string'],
            [['source_entity', 'source_entity'], 'integer'],
            [['read'], 'safe'],
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
            'type' => 'Type',
        ];
    }

    public static function createNotification($message, $class = null, $entity = null, $type = "info") {
        $notification = new Notification();
        $notification->message = $message;
        $notification->source_class = $class;
        $notification->source_entity = $entity;
        $notification->type = $type;
        $notification->save();
    }

    public function linkToEntity() {
        if ($this->source_class && $this->source_entity) {
            $model = "backend\models\\$this->source_class";
            if (class_exists($model)) {
                if (method_exists($model, 'findOne')) {
                    $entity = $model::findOne(['id' => $this->source_entity]);
                    if ($entity) {
                        return "/" . $model::tableName() ."/view?id=" . $this->source_entity;
                    } else {
                        return null;
                    }
                }
            }
        }
        return null;
    }

    public static function getLatestNotifications($count = 4) {
        return Notification::find()->orderBy(['id' => SORT_DESC])->limit($count)->all();
    }

    public static function getUnreadNotificationCount() {
        return Notification::find()->where(['read' => 0])->count();
    }
}
