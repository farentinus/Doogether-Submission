<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbuser".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authkey
 * @property string $accessToken
 */
class pengguna extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbuser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authkey', 'accessToken'], 'required'],
            [['username', 'password'], 'string', 'max' => 50],
            [['authkey', 'accessToken'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authkey' => 'Authkey',
            'accessToken' => 'Access Token',
        ];
    }
}
