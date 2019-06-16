<?php

namespace app\controllers;

use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\rest\Controller;

class RestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
            ],
        ];

        return $behaviors;
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogin()
    {
        // here you can put some credentials validation logic
         // Tangkap data login dari client (username & password)
        $username = !empty($_GET['username'])?$_GET['username']:'';
        $password = !empty($_GET['password'])?$_GET['password']:'';
        $response = [];
        // validasi jika kosong
            if(empty($username) || empty($password)){
                $response = [
                    'status' => 'error',
                    'message' => 'username & password tidak boleh kosong!',
                    'data' => '',
              ];
            }else{
                // cari di database, ada nggak username dimaksud
                $user = \app\models\User::findByUsername($username);
                // jika username ada maka
                if(!empty($user)){
                  // check, valid nggak passwordnya, jika valid maka bikin response success
                  if($user->validatePassword($password)){
                    // so if it success we return token
                    $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
                    /** @var Jwt $jwt */
                    $jwt = Yii::$app->jwt;
                    $token = $jwt->getBuilder()
                        ->setIssuer('http://example.com')// Configures the issuer (iss claim)
                        ->setAudience('http://example.org')// Configures the audience (aud claim)
                        ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
                        ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
                        ->setExpiration(time() + 3600)// Configures the expiration time of the token (exp claim)
                        ->set('uid', $user->id)// Configures a new claim, called "uid"
                        ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
                        ->getToken(); // Retrieves the generated token
                        $response = [
                      'status' => 'success',
                      'message' => 'login berhasil!',
                      'data' => [
                          'id' => $user->id,
                          'username' => $user->username,
                          // token diambil dari field auth_key
                          'token' => (string)$token,
                      ]
                    ];
                    return $response;
                }
            }
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function actionData()
    {
        return $this->asJson([
            'success' => true,
        ]);
    }


    public function actionCatalog()
    {
        $menu = \app\models\menu::findCatalog();

        // $menu = [
        //     'Menu' => [
        //         'id' => $menu->id,
        //         'namamenu' => $menu->namamenu,
        //         'harga' => $menu->harga,
        //         'keterangan' => $menu->keterangan,
        //     ]
        // ];
        return $menu;
    }
}