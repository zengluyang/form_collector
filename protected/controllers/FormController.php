<?php

class FormController extends Controller
{
	private $nameId=array(
		"黄橙"=>"201421010501",
		"高率雄"=>"201421010502",
		"曾路洋"=>"201421010503",
		"陈功"=>"201421010504",
		"敖松林"=>"201421010505",
		"赵毅哲"=>"201421010506",
		"胡周姹"=>"201421010507",
		"赵凯"=>"201421010508",
		"陈倩"=>"201421010509",
		"胡珑怀"=>"201421010510",
		"胡磊"=>"201421010511",
		"祁思博"=>"201421010512",
		"刘习儒"=>"201421010513",
		"姚碧超"=>"201421010514",
		"苗梦浩"=>"201421010515",
		"游通"=>"201421010516",
		"韩帅"=>"201421010517",
		"孟凡超"=>"201421010518",
		"汪泽成"=>"201421010519",
		"张兰心"=>"201421010520",
		"王晓东"=>"201421010521",
		"洪明龙"=>"201421010522",
		"胥可"=>"201421010523",
		"时洁"=>"201421010524",
		"李焱"=>"201421010525",
		"文豪"=>"201421010526",
		"杨东"=>"201421010527",
		"陈鹏炜"=>"201421010528",
		"冯坤"=>"201421010529",
		"蒋毅"=>"201421010530",
		"许云华"=>"201422010531",
		"李玲"=>"201422010532",
		"刘锐群"=>"201422010533",
		"蒋杨根"=>"201422010534",
		"苏丽荣"=>"201422010535",
		"夏雪"=>"201422010536",
		"唐红羚"=>"201422010537",
		"伍班强"=>"201422010538",
		"闫湘灵"=>"201422010539");
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','count','notSubmit'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','outCsv'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionNotSubmit() {
		header('Content-Type: text/html; charset=utf-8');
		if(isset($_GET['event'])){
			foreach ($this->nameId as $name => $id) {
				$form=Form::model()->findByAttributes(array('event'=>$_GET['event'],'student_id'=>$id));
				if($form==null) {
					echo "<li>$name</li>";
				}
			}

		}
	}

	public function actionOutCsv() {
		header('Content-Type: text/plain; charset=utf-8');
		if(isset($_GET['event'])){
			$criteria = new CDbCriteria(array('order'=>'student_id ASC'));
			$forms=Form::model()->findAllByAttributes(array('event'=>$_GET['event']),$criteria);
			//var_dump($forms);
			foreach ($forms as $f) {
				$f_json=json_decode($f->value);
				//var_dump($f_json);
				unset($f_json->event);
				$values=get_object_vars($f_json);
				echo implode(',', $values);
				echo "\n";
			}
			echo "\n";
			foreach ($this->nameId as $name => $id) {
				$f=Form::model()->findByAttributes(array('student_id'=>$id,'event'=>$_GET['event']));
				if($f!=null) {	
					$f_json=json_decode($f->value);
					unset($f_json->event);
					$values=get_object_vars($f_json);
					echo implode(',', $values);
					echo "\n";
				} else {
					echo "$id,$name,否,无,,,,,\n";
				}
			}
		}
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionCount() {
		header('Content-Type: text/html; charset=utf-8');
		if(isset($_GET['event'])){
			echo Form::model()->countByAttributes(array('event'=>$_GET['event']));
		}
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		header('Content-Type: text/html; charset=utf-8');
		$arr=json_decode($_POST['Form'], true);
		$student_id=$arr['学号'];
		$event=$arr['event'];
		$name=$arr['姓名'];
		if(!isset($this->nameId[$name]) || $this->nameId[$name]!=$student_id) {
			echo '提交失败！学号与姓名不匹配！';
			return ;
		}
		$model=Form::model()->findByAttributes(array('student_id'=>$student_id,'event'=>$event));
		if(  $model == null) {
			$model=new Form;
		}
		$model->student_id=$student_id;
		$model->value=$_POST['Form'];
		$model->event=$event;
		if(!$model->save()){
			//var_dump($model->getErrors()) ;
			echo "提交失败！";
		}
		echo "提交成功！";

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Form']))
		{
			$model->attributes=$_POST['Form'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Form');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Form('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Form']))
			$model->attributes=$_GET['Form'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Form the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Form::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Form $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
