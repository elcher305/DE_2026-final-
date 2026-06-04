<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $user_id
 * @property int $consultation_id
 * @property string $description
 *
 * @property Consultation $consultation
 * @property User $user
 */
class Review extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'consultation_id', 'description'], 'required'],
            [['user_id', 'consultation_id'], 'integer'],
            [['description'], 'string'],
            [['consultation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Consultation::class, 'targetAttribute' => ['consultation_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'consultation_id' => 'Consultation ID',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Consultation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConsultation()
    {
        return $this->hasOne(Consultation::class, ['id' => 'consultation_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
