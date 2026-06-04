<?php

namespace app\models;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{


    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['role'], 'default', 'value' => 'user'],
            [['username', 'password', 'full_name', 'date_birth', 'phone', 'email'], 'required'],
            [['date_birth'], 'safe'],
            [['username', 'password', 'full_name', 'email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255, 'min' => 8],
            ['username',  'string',  'min' => 6, 'max' => 100],
            [['phone'], 'string', 'max' => 50],
            [['username'], 'unique'],
            ['email', 'email'],
            ['username', 'match', 'pattern' => '/^[A-z0-9]\w*$/i'],
            ['full_name', 'match', 'pattern' => '/^[А-яЁё -]*$/u'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'full_name' => 'ФИО',
            'date_birth' => 'Дата рождения',
            'phone' => 'Телефон',
            'email' => 'Адрес электроной почты',

        ];
    }


    public function getConsultations()
    {
        return $this->hasMany(Consultation::class, ['user_id' => 'id']);
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class, ['user_id' => 'id']);
    }

    public static function optsRole()
    {
        return [
            self::ROLE_ADMIN => 'admin',
            self::ROLE_USER => 'user',
        ];
    }

    public function displayRole()
    {
        return self::optsRole()[$this->role];
    }

    public function isRoleAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setRoleToAdmin()
    {
        $this->role = self::ROLE_ADMIN;
    }


    public function isRoleUser()
    {
        return $this->role === self::ROLE_USER;
    }

    public function setRoleToUser()
    {
        $this->role = self::ROLE_USER;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }


    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }


    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }
}
