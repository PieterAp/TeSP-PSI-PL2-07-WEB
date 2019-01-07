<?php
namespace frontend\controllers;

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


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $allCategories = Categoria::find()
            ->select('Categoria.*')
            ->distinct()
            ->all();

        $allCategoryChilds = CategoriaChild::find()
            ->select('categoria_child.*')
            ->distinct()
            ->all();

        $categoryRow = (new Query())
            ->select(['categoria_child.idchild','categoria_child.childNome'])
            ->from('categoria_child')
            ->innerJoin('produto', '`categoria_child`.`idchild` = `produto`.`categoria_child_id`')
            ->where(['produto.produtoEstado' => 1])
            ->andWhere(['categoria_child.childEstado' => 1])
            ->groupBy('produto.categoria_child_id')
            ->orderBy('count(produto.categoria_child_id) DESC')
            ->limit(3)
            ->all();

        /*
        $bestSeller = (new Query())
            ->select([
                'idprodutos',
                'produtoNome',
                'produtoPreco',
                'produtoImagem1',
                'campanhaPercentagem',
                'produtoPreco-(produtoPreco*(campanhaPercentagem / 100)) AS "precoDpsDesconto"'
            ])
            ->from('compraproduto')
            ->innerJoin('produto', 'produto_idprodutos = idprodutos')
            ->leftJoin('produtocampanha', 'idprodutos = produtos_idprodutos')
            ->leftJoin('campanha', 'campanha_idCampanha = idCampanha')
            ->where(['produtoEstado' => 1])
            ->andwhere(['>=','campanhaDataFim', date('Y-m-d')])
            ->andWhere(['<=','campanhaDataInicio', date('Y-m-d')])
            ->groupBy('categoria_child_id')
            ->orderBy('count(idprodutos) DESC')
            ->limit(8)
            ->all();

        var_dump($bestSeller);
        die();
        */


        //old one, quite light

        $bestSeller = (new Query())
            ->select(['produto.idprodutos','produto.produtoNome','produto.produtoPreco', 'produto.produtoImagem1'])
            ->from('compraproduto')
            ->innerJoin('produto', '`compraproduto`.`produto_idprodutos` = `produto`.`idprodutos`')
            ->where(['produto.produtoEstado' => 1])
            ->groupBy('produto.categoria_child_id')
            ->orderBy('count(produto.idprodutos) DESC')
            ->limit(8)
            ->all();






        //::todo: query to show recommended products, max 8 products
        //::todo: query to show recommended products, max 8 products

        return $this->render('index', [
            'allCategories' => $allCategories,
            'allCategoryChilds' => $allCategoryChilds,
            'categoryRow' => $categoryRow,
            'bestSeller' => $bestSeller,
            //'featured' => $featured,
            //'sale' => $sale,
            //'sale' => $topRate,
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
