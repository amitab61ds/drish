<?php
namespace frontend\models;

use yii\base\Model;
use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $phone;
    public $address;
    public $city;
    public $email;
    public $subject;
    public $body;

    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['name', 'email','phone','city','address', 'subject', 'body'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Returns the attribute labels.
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name'=> Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'subject' => Yii::t('app', 'Subject'),
            'body' => Yii::t('app', 'Text'),
            'verifyCode' => Yii::t('app', 'Verification Code'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information
     * collected by this model.
     *
     * @param  string $email The target email address.
     * @return bool          Whether the email was sent.
     */
    public function contact($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
