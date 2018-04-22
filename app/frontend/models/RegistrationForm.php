<?php

namespace frontend\models;

use yii\base\Model;

class RegistrationForm extends Model
{
    public $login;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $password_repeat;
    public $message = "";

    public function attributeLabels()
    {
        return [
            'login' => \Yii::t("app", "Enter your login:"),
            'name' => \Yii::t("app", "Enter your name:"),
            'surname' => \Yii::t("app", "Enter your surname:"),
            'email' => \Yii::t("app", 'Enter your email:'),
            'password' => \Yii::t("app", 'Enter your password:'),
            'password_repeat' => \Yii::t("app", 'Repeat your password:'),
        ];
    }

    public function rules()
    {
        return [
            [['login', 'name', 'surname',  'email', 'password', 'password_repeat'], 'required'],
            ['email', 'email'],
            ['login', 'string', 'min' => 3, 'max' => 50],
            ['name', 'string', 'min' => 3, 'max' => 50],
            ['surname', 'string', 'min' => 3, 'max' => 50],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['password_repeat', 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function signUp() {
        $result = false;

        $userData = [
            'username' => $this->login,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
//            'password' => CPasswordHelper::hashPassword($password),
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'access_token' => \Yii::$app->security->generateRandomString(),
            'created_at' => date("Y-m-d")
        ];

        $user = new User;
        $user->attributes = $userData;

        if ($user->validate()) {

            $user->save();
            $result = true;

        } else {
            $errors = $user->getErrors();

            foreach ($errors as $field => $errors) {
                $this->message = $this->message."$field errors:<br>";

                foreach ($errors as $err) {
                    $this->message = $this->message.$err.'<br>';
                }
            }
        };

        return $result;
    }
}