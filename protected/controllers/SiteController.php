<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */


	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        //$cont = $this->get_web_page('http://ruseller.com/jquery.php?id=11');
        //
        require_once 'vendor/autoload.php';

        $client = new \Github\Client();

        $repo = $client->api('repo')->show('yiisoft', 'yii');

        $this->render('index',$repo);

	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	public function actionNext(){
        require_once 'vendor/autoload.php';

        $client = new \Github\Client();
        if(!isset($_GET['query'])){
            $this->render('index',array('errorMessage'=>'Wrong query!'));
            return;
        }
        $number = htmlspecialchars($_GET['number']);
        $query = htmlspecialchars($_GET['query']);
        $repoApi = $client->api('search');
        $parameters = array($query);

        $paginator  = new Github\ResultPager($client);

        $result     = $paginator->fetch($repoApi, 'repositories', $parameters);
        for($i = 1; $i < $number; $i++){
            $result = $paginator->fetchNext();
        }
        $repos = Repos::model()->findAll("name LIKE '%".$query."%'");
        foreach($result['items'] as &$item){
            $item['like'] = 0;
            foreach($repos as $r){
                if($r->id_repo == $item['id']){
                    $item['like'] = $r->like;
                }
            }
        }
        unset($item);
        $this->render('search',array('repos'=>$result['items'],'paginator'=>$paginator));
    }


}