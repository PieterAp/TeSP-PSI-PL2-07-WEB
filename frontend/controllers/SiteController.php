<?php
namespace frontend\controllers;

use common\models\Campanha;
use common\models\Categoria;
use common\models\CategoriaChild;
use common\models\Produto;
use common\models\Userdata;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use app\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['POST'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndexdefault()
    {
        return $this->render('index_backup');
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        $connect = \Yii::$app->db;

        /*
        $sale = Campanha::find()
            ->where (['>','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<','campanhaDataInicio', date('Y-m-d')])
            ->orderBy("campanhaDataFim")
            ->limit(3)
            ->all();
        */


        $sale = (new Query())
            ->select(['campanha.*','COUNT(produtocampanha.idprodutocampanha) as "qntProdutos"'])
            ->from('campanha')
            ->leftJoin('produtocampanha', '`campanha`.`idCampanha` = `produtocampanha`.`campanha_idCampanha`')
            ->leftJoin('produto', '`produtocampanha`.`produtos_idprodutos` = `produto`.`idprodutos`')
            ->where(['>=','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<=','campanhaDataInicio', date('Y-m-d')])
            ->groupBy('`campanha`.`idCampanha`')
            ->orderBy("campanhaDataFim")
            ->limit(3)
            ->all();









        $categoryRow = $connect->createCommand('
                SELECT  idchild, childNome, (SELECT produto.produtoImagem1
                                             FROM produto INNER JOIN categoria_child ON produto.categoria_child_id = categoria_child.idchild
                                             WHERE categoria_child.idchild = c.idchild
                                             ORDER BY produtoDataCriacao DESC
                                             LIMIT 1) as imagem1, produto.idprodutos
                FROM categoria_child as c INNER JOIN produto ON c.idchild = produto.categoria_child_id
                WHERE (produtoEstado = 1) AND (childEstado = 1)
                GROUP BY categoria_child_id
                ORDER BY count(categoria_child_id) DESC
                LIMIT 3;
               ')
            ->queryAll();

        $bestSeller = $connect->createCommand('
        SELECT produto.*, produtocampanha.campanhaPercentagem, produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) AS "precoDpsDesconto", count(compraproduto.produto_idprodutos) as "qntCompras"
        FROM compraproduto INNER JOIN produto ON compraproduto.produto_idprodutos=produto.idprodutos
                           LEFT JOIN (SELECT produtocampanha.*
                                      FROM produtocampanha INNER JOIN campanha ON produtocampanha.campanha_idCampanha=campanha.idCampanha
                                      WHERE (campanha.campanhaDataInicio <= CURRENT_DATE()) AND (campanha.campanhaDataFim >= CURRENT_DATE())
                                     ) as produtocampanha ON produto.idprodutos=produtocampanha.produtos_idprodutos
                           LEFT JOIN (SELECT campanha.*
                                      FROM campanha
                                      WHERE (campanha.campanhaDataInicio <= CURRENT_DATE()) AND (campanha.campanhaDataFim >= CURRENT_DATE())
                                     ) AS campanha ON produtocampanha.campanha_idCampanha=campanha.idCampanha
        WHERE (produto.produtoEstado = 1)
        GROUP BY compraproduto.produto_idprodutos
        ORDER BY (count(compraproduto.produto_idprodutos)) DESC, produtocampanha.campanhaPercentagem DESC
        LIMIT 8;
       ')
        ->queryAll();


        //::todo: query to show recommended products, max 8 products
        //::todo: query to show recommended products, max 8 products

        return $this->render('index', [
            'sale' => $sale,
            'categoryRow' => $categoryRow,
            'bestSeller' => $bestSeller,
            //'new' => $new,
            //'sale' => $sale,
            //'RecentPro' => $RecentPro,
        ]);
    }


    public function actionFilter()
    {
        $array = Yii::$app->request->get('array');
        foreach ($array as $name){
            echo $name."<br />";
        }


        return $this->render('index', [
            'allProducts' => $allProducts,
        ]);
    }


    public function actionSearch()
    {

    }



    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
