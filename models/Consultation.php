<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "consultation".
 *
 * @property int $id
 * @property int $user_id
 * @property string $consultation_name
 * @property string $start_date
 * @property string $start_time
 * @property string $payment_method
 * @property string $status
 *
 * @property Review[] $reviews
 * @property User $user
 */
class Consultation extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const CONSULTATION_NAME_CIVIL = 'civil';
    const CONSULTATION_NAME_CRIMINAL = 'criminal';
    const CONSULTATION_NAME_ADMINISTRATIVE = 'administrative';
    const CONSULTATION_NAME_LEGAL = 'legal';
    const PAYMENT_METHOD_QR_CODE = 'QR code';
    const PAYMENT_METHOD_CASH = 'cash';
    const PAYMENT_METHOD_TRANSACTION = 'transaction';
    const STATUS_NEW = 'new';
    const STATUS_DENIED = 'denied';
    const STATUS_APPROVED = 'approved';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'consultation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 'new'],
            [['user_id', 'consultation_name', 'start_date', 'start_time', 'payment_method'], 'required'],
            [['user_id'], 'integer'],
            [['consultation_name', 'payment_method', 'status'], 'string'],
            [['start_date', 'start_time'], 'safe'],
            ['consultation_name', 'in', 'range' => array_keys(self::optsConsultationName())],
            ['payment_method', 'in', 'range' => array_keys(self::optsPaymentMethod())],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
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
            'consultation_name' => 'Consultation Name',
            'start_date' => 'Start Date',
            'start_time' => 'Start Time',
            'payment_method' => 'Payment Method',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['consultation_id' => 'id']);
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


    /**
     * column consultation_name ENUM value labels
     * @return string[]
     */
    public static function optsConsultationName()
    {
        return [
            self::CONSULTATION_NAME_CIVIL => 'civil',
            self::CONSULTATION_NAME_CRIMINAL => 'criminal',
            self::CONSULTATION_NAME_ADMINISTRATIVE => 'administrative',
            self::CONSULTATION_NAME_LEGAL => 'legal',
        ];
    }

    /**
     * column payment_method ENUM value labels
     * @return string[]
     */
    public static function optsPaymentMethod()
    {
        return [
            self::PAYMENT_METHOD_QR_CODE => 'QR code',
            self::PAYMENT_METHOD_CASH => 'cash',
            self::PAYMENT_METHOD_TRANSACTION => 'transaction',
        ];
    }

    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_NEW => 'new',
            self::STATUS_DENIED => 'denied',
            self::STATUS_APPROVED => 'approved',
        ];
    }

    /**
     * @return string
     */
    public function displayConsultationName()
    {
        return self::optsConsultationName()[$this->consultation_name];
    }

    /**
     * @return bool
     */
    public function isConsultationNameCivil()
    {
        return $this->consultation_name === self::CONSULTATION_NAME_CIVIL;
    }

    public function setConsultationNameToCivil()
    {
        $this->consultation_name = self::CONSULTATION_NAME_CIVIL;
    }

    /**
     * @return bool
     */
    public function isConsultationNameCriminal()
    {
        return $this->consultation_name === self::CONSULTATION_NAME_CRIMINAL;
    }

    public function setConsultationNameToCriminal()
    {
        $this->consultation_name = self::CONSULTATION_NAME_CRIMINAL;
    }

    /**
     * @return bool
     */
    public function isConsultationNameAdministrative()
    {
        return $this->consultation_name === self::CONSULTATION_NAME_ADMINISTRATIVE;
    }

    public function setConsultationNameToAdministrative()
    {
        $this->consultation_name = self::CONSULTATION_NAME_ADMINISTRATIVE;
    }

    /**
     * @return bool
     */
    public function isConsultationNameLegal()
    {
        return $this->consultation_name === self::CONSULTATION_NAME_LEGAL;
    }

    public function setConsultationNameToLegal()
    {
        $this->consultation_name = self::CONSULTATION_NAME_LEGAL;
    }

    /**
     * @return string
     */
    public function displayPaymentMethod()
    {
        return self::optsPaymentMethod()[$this->payment_method];
    }

    /**
     * @return bool
     */
    public function isPaymentMethodQrCode()
    {
        return $this->payment_method === self::PAYMENT_METHOD_QR_CODE;
    }

    public function setPaymentMethodToQrCode()
    {
        $this->payment_method = self::PAYMENT_METHOD_QR_CODE;
    }

    /**
     * @return bool
     */
    public function isPaymentMethodCash()
    {
        return $this->payment_method === self::PAYMENT_METHOD_CASH;
    }

    public function setPaymentMethodToCash()
    {
        $this->payment_method = self::PAYMENT_METHOD_CASH;
    }

    /**
     * @return bool
     */
    public function isPaymentMethodTransaction()
    {
        return $this->payment_method === self::PAYMENT_METHOD_TRANSACTION;
    }

    public function setPaymentMethodToTransaction()
    {
        $this->payment_method = self::PAYMENT_METHOD_TRANSACTION;
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusNew()
    {
        return $this->status === self::STATUS_NEW;
    }

    public function setStatusToNew()
    {
        $this->status = self::STATUS_NEW;
    }

    /**
     * @return bool
     */
    public function isStatusDenied()
    {
        return $this->status === self::STATUS_DENIED;
    }

    public function setStatusToDenied()
    {
        $this->status = self::STATUS_DENIED;
    }

    /**
     * @return bool
     */
    public function isStatusApproved()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function setStatusToApproved()
    {
        $this->status = self::STATUS_APPROVED;
    }
}
