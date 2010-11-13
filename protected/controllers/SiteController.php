<?php

class SiteController extends Controller
{
    public function init()
    {
		$session=new CHttpSession();
		$session->open();

		$theme = Theme::model()->findByPk( $session['themeID'] );

		if( isset( $_POST['Theme'] ) || isset( $_GET['themeid'] ) )
		{
			// we have something, let's try to load id
			if( isset( $_POST['Theme'] ) )
			{
				$theme = Theme::model()->findByPk( $_POST['Theme']['id'] );
			}
			else
			{
				$theme = Theme::model()->findByPk( $_GET['themeid'] );
			}

			if( $theme )
			{
				// we're gonna search for a directory,
				// but first we need to get the clean name
				// of the Theme
	    		$dirname = $this->makeStringPretty( $theme->name );

				// so it's very cool so far, let's see if we 
				// actually have this theme here
				if( is_dir( YiiBase::getPathOfAlias( 'webroot' ) . '/themes/' . $dirname ) )
				{
					// we won, we have the theme, let's load it
					$session['themeID'] = $theme->id;
				}
				else
				{
					$session['themeID'] = null;
				}

				$session->close();
			}
		}

		if( isset( $theme ) )
		{
			Yii::app()->theme = $this->makeStringPretty( $theme->name );
        	$this->renderPartial( 'themeselector', array( 'theme' => $theme) );
		}
		else
		{
        	$this->renderPartial( 'themeselector' );
		}

        return parent::init();
    }

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
		$this->render('index');
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function makeStringPretty( $str )
	{
		$tmp = preg_replace('/\s+/', '_', $str ); // compress internal whitespace and replace with _
		$tmp = preg_replace('/\W+/', '', $tmp ); // remove all non-alphanumeric chars 
	    return strtolower(preg_replace('/\W-/', '', $tmp) );
	}
}
