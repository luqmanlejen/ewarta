<?php


class OstRelatedLegislationController extends CmsController {

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new OstRelatedLegislation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['OstRelatedLegislation']))
		{

            $model->attributes = $_POST['OstRelatedLegislation'];
                    
            if (isset($_POST['date_proclamation']) && $_POST['date_proclamation'] != '') {
                $model->date_proclamation = $_POST['date_proclamation'];
            } else {
                $model->date_proclamation = '0000-00-00';
            }

            if (isset($_POST['date_effective']) && $_POST['date_effective'] != '') {
                $model->date_effective = $_POST['date_effective'];
            } else {
                $model->date_effective = '0000-00-00';
            }

           
            $model->related_type = $_POST['related_type'];
            $model->related_id = $_POST['related_id'];
            
            if ($model->save())
                $this->redirect(array('admin', 'id' => $model->id));
        }
		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['OstRelatedLegislation']))
		{
			$model->attributes=$_POST['OstRelatedLegislation'];
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
		$dataProvider=new CActiveDataProvider('OstRelatedLegislation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new OstRelatedLegislation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OstRelatedLegislation']))
			$model->attributes=$_GET['OstRelatedLegislation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OstRelatedLegislation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OstRelatedLegislation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OstRelatedLegislation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ost-related-legislation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionChangeParent() {
        $ref = $_POST['related_type'];
        if ($ref == 'ost_act') {
            echo CHtml::dropdownlist('related_id', '', OstAct::model()->displayActList(), array('class' => 'col-sm-12'));
        } else if ($ref == 'ost_amending_act') {
            echo CHtml::dropdownlist('related_id', '', OstAmendingAct::model()->displayActList2(), array('class' => 'col-sm-12'));
		} else if ($ref == 'ost_pu') {
            echo CHtml::dropdownlist('related_id', '', OstPu::model()->displayActList(), array('class' => 'col-sm-12'));
        } else if ($ref == 'ost_perundangan') {
            echo CHtml::dropdownlist('related_id', '', OstPerundangan::model()->displayActList(), array('class' => 'col-sm-12'));
        }
    }
}
