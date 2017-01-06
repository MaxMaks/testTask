<?php

class ReposController extends Controller
{
	public function actionIndex()
	{
        require_once 'vendor/autoload.php';

        $client = new \Github\Client();
        $login = htmlspecialchars($_GET['login']);
        $name = htmlspecialchars($_GET['name']);
        if(!isset($login) || !isset($name)){
            return;
        }
        $repo = $client->api('repo')->show($login, $name);

		$this->render('index',$repo);
	}

	public function actionLike(){
        if(!isset($_GET['id'])){
            return;
        }
        $id = $_GET['id'];
        $repo = Repos::model()->find('id_repo=:id_repo',array(':id_repo'=>$id));
        if(!$repo){
            require_once 'vendor/autoload.php';
            $client = new \Github\Client();
            $login = htmlspecialchars($_GET['login']);
            $name = htmlspecialchars($_GET['name']);
            if(!isset($login) || !isset($name)){
                return;
            }
            $repo = $client->api('repo')->show($login, $name);
            $r = new Repos();
            $r->name = $repo['name'];
            $r->id_repo = $repo['id'];
            $r->like = 1;
            $r->save();
            echo 'Done';
        }else{
            $repo->like = $repo->like ? 0 : 1;
            $repo->save();
            echo $repo->like;
        }

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