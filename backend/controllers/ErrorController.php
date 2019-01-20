<?php
/**
 * Created by PhpStorm.
 * User: Pieter
 * Date: 20/01/2019
 * Time: 03:35
 */

namespace backend\controllers;
use Yii;


/**
 * ErrorController deals all the errors on backend of the website
 */
class ErrorController extends LayoutController
{

    /**
     * Guides errors to each
     * @return mixed
     */
    public function actionGuideline()
    {
        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null)
        {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();

            if (Yii::$app->user->isGuest)
            {
                $this->layout = 'loginLayout';

                return $this->render('//site/error', [
                    'exception' => $exception,
                    'statusCode' => $statusCode,
                    'name' => $name,
                    'message' => $message
                ]);
            }
            else
            {
                $this->layout = 'main';

                return $this->render('//site/errorMain', [
                    'exception' => $exception,
                    'statusCode' => $statusCode,
                    'name' => $name,
                    'message' => $message
                ]);
            }
        }
    }
}