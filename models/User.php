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
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authkey;
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

    public static function findIdentity($id) {
        $user = self::find()->where(["id" => $id])->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
    * @inheritdoc
    */
    public static function findIdentityByAccessToken($token, $type = null) {

        /*$user = self::find()->where(["accessToken" => $token])->one();
        if(!count($user)){
            return null;
        }
        return new static($user);*/

        //Part 2 testing
        // foreach (self::$users as $user) {
        //     if ($user['id'] === (string) $token->getClaim('uid')){
        //         return new static($user);
        //     }
        // }
        // return null;

        $user = self::find()->where(["id"=>(string) $token->getClaim('uid')])->one();
        if(!count($user)){
            return null;
        }
        return new static($user);

    }

    /**
    * Finds user by username
    *
    * @param string $username
    * @return static|null
    */
    public static function findByUsername($username) {
        $user = self::find()->where(["username" => $username])->one();
        if(!count($user)){
            return null;
        }
        return new static($user);
    }

    /**
    * @inheritdoc
    */
    public function getId() {
        return $this->id;
    }

    /**
    * @inheritdoc
    */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
    * @inheritdoc
    */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
    * Validates password
    *
    * @param string $password password to validate
    * @return boolean if password provided is valid for current user
    */
    public function validatePassword($password) {
        return $this->password === $password;
    }
}
