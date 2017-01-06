<?php

class UserController extends Controller
{
	public function actionIndex()
	{
        require_once 'vendor/autoload.php';

        $client = new \Github\Client();
        $name = htmlspecialchars($_GET['name']);
        $user = $client->api('user')->show($name);
        $repo = User::model()->find('id_user=:id_user',array(':id_user'=>$user['id']));
        $user['like'] = $repo ? $repo->like : 0;
		$this->render('index',$user);
	}


    public function actionLike(){
        if(!isset($_GET['id'])){
            return;
        }
        $id = $_GET['id'];
        $repo = User::model()->find('id_user=:id_user',array(':id_user'=>$id));
        if(!$repo){
            require_once 'vendor/autoload.php';
            $client = new \Github\Client();
            $login = htmlspecialchars($_GET['login']);
            if(!isset($login)){
                return;
            }
            $repo = $client->api('user')->show($login);
            $r = new User();
            $r->name = $repo['login'];
            $r->id_user = $repo['id'];
            $r->like = 1;
            $r->save();
            echo 1;
        }else{
            $repo->like = $repo->like ? 0 : 1;
            $repo->save();
            echo $repo->like;
        }

    }

    public function actionCheck(){
        if(!isset($_GET['id'])){
            return;
        }
        $id = $_GET['id'];
        $repo = User::model()->find('id_user=:id_user',array(':id_user'=>$id));
        $result = $repo ? $repo->like : 0;
        echo $result;
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}