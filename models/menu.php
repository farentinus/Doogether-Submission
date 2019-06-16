<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbmenu".
 *
 * @property int $id
 * @property string $namamenu
 * @property double $harga
 * @property string $keterangan
 */
class menu extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authkey;
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'tbmenu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['namamenu', 'harga', 'keterangan'], 'required'],
            [['harga'], 'number'],
            [['keterangan'], 'string'],
            [['namamenu'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namamenu' => 'Namamenu',
            'harga' => 'Harga',
            'keterangan' => 'Keterangan',
        ];
    }

    public static function findIdentity($id) {
        $user = User::findIdentity($id);
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        $user = User::findIdentityByAccessToken($token,$type);
        if(!count($user)){
            return null;
        }
        return new static($user);

    }

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

    public static function findCatalog()
    {
        // $menu = menu::find()->all();
        // if (!count($menu)) {
        //     return null;
        // }
        // return new static($menu);
        $post = menu::find()->limit(10)->all();
        $data = ArrayHelper::toArray($post, [
            'app\models\menu' => [
                'id',
                'namamenu',
                'harga',
                'keterangan',
            ],
        ]);
        return $data;
    }
}
