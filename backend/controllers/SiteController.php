<?php
namespace backend\controllers;

use common\models\Userdata;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends LayoutController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'frontend'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = (new Query())
            ->select([
                'count(DISTINCT user.id) as "qntUsers"',

                '(SELECT count(*) as "qntAdmin"
                 FROM auth_assignment
                 WHERE item_name = "admin") as "qntAdmin"',

                '(SELECT count(*) as "qntClient"
                 FROM auth_assignment
                 WHERE item_name = "cliente") as "qntClient"',

                '(SELECT count(*) as "qntMod"
                 FROM auth_assignment
                 WHERE item_name = "funcionario") as "qntMod"',

                '(SELECT count(*) as "qntNew"
                  FROM user
                  WHERE DATEDIFF(NOW(),from_unixtime(created_at)) < 5
                  ORDER BY created_at DESC) as "qntNew"',
            ])
            ->from('user')
            ->one();

        $categories = (new Query())
            ->select([
                'count(DISTINCT categoria.idcategorias) as "qntCategories"',

                '(SELECT count(produto.idprodutos) as "qntNew"
                       FROM produto
                       WHERE (produto.produtoEstado = 1) AND (DATEDIFF(NOW(),produtoDataCriacao) < 5)
                       ORDER BY produtoDataCriacao DESC) as "qntNew"',

                '(SELECT count(produto.idprodutos) as "qntDiscount"
                       FROM produto RIGHT JOIN produtocampanha ON produto.idprodutos = produtocampanha.produtos_idprodutos
                       WHERE (produto.produtoEstado = 1)) as "qntDiscount"',

                '(SELECT count(*) as "qntVisible"
                        FROM produto
                        WHERE produto.produtoEstado = 1) as "qntVisible"',

                '(SELECT count(*) as "qntVisible"
                        FROM produto
                        WHERE produto.produtoEstado = 0) as "qntInvisible"',
            ])
            ->from('categoria')
            ->one();

        $subCategories = (new Query())
            ->select([
                'count(DISTINCT produto.idprodutos) as "qntProducts"',

                '(SELECT count(produto.idprodutos) as "qntNew"
                       FROM produto
                       WHERE (produto.produtoEstado = 1) AND (DATEDIFF(NOW(),produtoDataCriacao) < 5)
                       ORDER BY produtoDataCriacao DESC) as "qntNew"',

                '(SELECT count(produto.idprodutos) as "qntDiscount"
                       FROM produto RIGHT JOIN produtocampanha ON produto.idprodutos = produtocampanha.produtos_idprodutos
                       WHERE (produto.produtoEstado = 1)) as "qntDiscount"',

                '(SELECT count(*) as "qntVisible"
                        FROM produto
                        WHERE produto.produtoEstado = 1) as "qntVisible"',

                '(SELECT count(*) as "qntVisible"
                        FROM produto
                        WHERE produto.produtoEstado = 0) as "qntInvisible"',
            ])
            ->from('produto')
            ->one();


        $products = (new Query())
            ->select([
                      'count(DISTINCT produto.idprodutos) as "qntProducts"',

                     '(SELECT count(produto.idprodutos) as "qntNew"
                       FROM produto
                       WHERE (produto.produtoEstado = 1) AND (DATEDIFF(NOW(),produtoDataCriacao) < 5)
                       ORDER BY produtoDataCriacao DESC) as "qntNew"',

                     '(SELECT count(produto.idprodutos) as "qntDiscount"
                       FROM produto RIGHT JOIN produtocampanha ON produto.idprodutos = produtocampanha.produtos_idprodutos
                       WHERE (produto.produtoEstado = 1)) as "qntDiscount"',

                      '(SELECT count(*) as "qntVisible"
                        FROM produto
                        WHERE produto.produtoEstado = 1) as "qntVisible"',

                      '(SELECT count(*) as "qntVisible"
                        FROM produto
                        WHERE produto.produtoEstado = 0) as "qntInvisible"',
                      ])
            ->from('produto')
            ->where(['produtoEstado'=>'1'])
            ->one();

        return $this->render('index', [
            'users' => $users,
            'categories' => $categories,
            'subCategories' => $subCategories,
            'products' => $products,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }


        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $auth = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
            $userdata = new Userdata;
            $role= '';
            if (array_key_exists ('admin' , $auth)){
                $role = 'admin';
            }
            if (array_key_exists ('cliente' , $auth)){
                $role = 'cliente';
            }
            if (array_key_exists ('funcionario' , $auth)){
               $role = 'funcionario';
            }

            if (($role != 'admin') && ($role != 'funcionario')){
                Yii::$app->user->logout();
                return $this->render('notallowed');
            }
            $identity = User::findOne(['username' => $model->username]);
            $user = Userdata::findOne(['user_id' => $identity->id]);
            if ($user->userVisibilidade == '0'){
                Yii::$app->user->logout();

                return $this->render('disabled_error');
            }

            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionFrontend()
    {
        return $this->redirect(Yii::$app->urlManagerFrontend->createUrl(['site/index']));
    }
}
