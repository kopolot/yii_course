<?php 

namespace app\models;
use yii\base\Model;
use app\models\User;
use Yii;
use yii\helpers\VarDumper;

class SingUpForm extends Model{
    public $username;
    public $password;
    public $password_repeat;
    public $message=null;
    public function rules(){
        return [
            [['username', 'password', 'password_repeat'],'required'],
            [['username'],'match', 'pattern' => '/^[0-9A-Za-z]{5,16}$/', 'message' => 'Must have 5-16 words'],
            [['password' , 'password_repeat'],'match','pattern' => '/^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{7,17}$/', 'message' =>'Must contain one upercase, one letter and have 7-20 words'],
            ['username', 'userExists'],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password']
        ];
    }
    public function userExists($attribute){
        if(!$this->hasErrors()){
             if(User::findOne(['username'=>$this->username])!==false){
                $this->addError($attribute,'User already exists');
             }
        }
    }
    public function insertValues(){ 
        if($this->validate()){
            $model = new User();
            $model->username = $this->username;
            $model->password = Yii::$app->security->generatePasswordHash($this->password);
            $model->auth_key = Yii::$app->security->generateRandomKey();
            $model->access_token = Yii::$app->security->generateRandomString();
            if ($model->save()){
                return true;
            }else{
                return false;
            }
        }
    }

}