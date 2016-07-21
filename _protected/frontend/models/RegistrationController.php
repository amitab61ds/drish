<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace frontend\controllers\user;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\models\LoginForm;
use frontend\models\RegistrationForm;
use frontend\models\User;
use frontend\models\Profile;
use yii\web\Response;
use dektrium\user\traits\AjaxValidationTrait;
use dektrium\user\traits\EventTrait;
use common\traits\MessageSendTrait;
use dektrium\user\controllers\RegistrationController as BaseRegistrationController;

class RegistrationController extends BaseRegistrationController
{
    use AjaxValidationTrait;
    use EventTrait;
	use MessageSendTrait;
    /**
     * Event is triggered after creating RegistrationForm class.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_BEFORE_REGISTER = 'beforeRegister';

    /**
     * Event is triggered after successful registration.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_AFTER_REGISTER = 'afterRegister';

    /**
     * Event is triggered before connecting user to social account.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_BEFORE_CONNECT = 'beforeConnect';

    /**
     * Event is triggered after connecting user to social account.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_AFTER_CONNECT = 'afterConnect';

    /**
     * Event is triggered before confirming user.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_BEFORE_CONFIRM = 'beforeConfirm';

    /**
     * Event is triggered before confirming user.
     * Triggered with \dektrium\user\events\UserEvent.
     */
    const EVENT_AFTER_CONFIRM = 'afterConfirm';

    /**
     * Event is triggered after creating ResendForm class.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_BEFORE_RESEND = 'beforeResend';

    /**
     * Event is triggered after successful resending of confirmation email.
     * Triggered with \dektrium\user\events\FormEvent.
     */
    const EVENT_AFTER_RESEND = 'afterResend';   
	public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = ['allow' => true, 'actions' => ['register'], 'roles' => ['?']];

        return $behaviors;
    } 
    public function actionRegister()
    {
		
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        /** @var RegistrationForm $model */
        $model = Yii::createObject(RegistrationForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);



		if ($model->load(Yii::$app->request->post()) && $model->register()) {
			$info = array();
			$phone = $model->phone;
			$job_name = "Registration Form";
			$msg = Yii::$app->params['settings']['registeration_confirm'];
			if($this->SendMessage($phone,$msg,$job_name) == true){
			$this->trigger(self::EVENT_AFTER_REGISTER, $event);
			
			$result['type'] = 'success';
			$result['message'] = 'Your account has been created and a confirmation email has been sent to your email.';
			Yii::$app->response->format = trim(Response::FORMAT_JSON);
			return $result;	
			}

		}else{	
			$error = \yii\widgets\ActiveForm::validate($model);
				Yii::$app->response->format = trim(Response::FORMAT_JSON);
				return $error; 
		}		

    }  

}
