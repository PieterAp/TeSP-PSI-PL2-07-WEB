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
                'count(DISTINCT idcategorias) as "Total"',

                '(select count(DISTINCT idcategorias) from categoria where categoriaEstado = 1) As "Show"',

                '(select count(DISTINCT idcategorias) from categoria where categoriaEstado = 0) As "Hide"',

            ])
            ->from('categoria')
            ->one();

        $subCategories = (new Query())
            ->select([
                'count(DISTINCT idchild) as "Total"',

                '(select count(DISTINCT idchild) from categoria_child where childEstado = 1) As "Show"',

                '(select count(DISTINCT idchild) from categoria_child where childEstado = 0) As "Hide"',
            ])
            ->from('categoria_child')
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

        $sales = (new Query())
            ->select([
                'count(DISTINCT idCampanha) as "Total"',

                '(SELECT count(idCampanha) as "old"
                       FROM campanha
                       WHERE (campanhaDataFim) < NOW()) as Old',

                '(SELECT Count(idCampanha) as "current" 
                        FROM campanha 
                        WHERE NOW() > campanhaDataInicio AND NOW() < campanhaDataFim) as Current',

                '(SELECT Count(idCampanha) as ComingUp 
                        FROM campanha 
                        WHERE campanhaDataInicio > NOW() AND campanhaDataInicio > NOW()) as Coming_Up',

            ])
            ->from('campanha')
            ->one();

        $productSales = (new Query())
            ->select ('count(idprodutos) as products')
            ->from ('campanha')
            ->innerJoin('produtocampanha', 'idCampanha = campanha_idCampanha')
            ->innerJoin('produto', 'produtos_idprodutos = idprodutos')
            ->where(['>=','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<=','campanhaDataInicio', date('Y-m-d')])
            ->one();

        $price = (new Query())
                ->select(['sum(compraValor) as "total"'])
                ->from('compra')
            ->where (['compraEstado' => 0])
            ->one();



        return $this->render('index', [
            'users' => $users,
            'categories' => $categories,
            'subCategories' => $subCategories,
            'products' => $products,
            'sales' => $sales,
            'productSales' => $productSales,
            'price' => $price,
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
