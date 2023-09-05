<?php

class ManagerialController extends Controller
{
    private function _publicActionsList()
    {
        return array(
            'error'
        );
    }

    public function filters()
    {
        return array_merge(
            array(
                'accessControl',
                array('CrugeUiAccessControlFilter', 'publicActions' => self::_publicActionsList()),
            )
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => self::_publicActionsList(),
                'users' => array('@'),
            ),
            array(
                'allow',
                'users' => array('@'),
            ),
            array(
                'deny', // deny all users
                'users' => array('@'),
            ),
        );
    }
	public function actionCommercial()
	{
		$this->render('commercial');
	}
	public function actionFinance()
	{
		$this->render('finance');
	}
	public function actionTechnical()
	{
		$this->render('technical');
	}
	public function actionIndicator()
	{
		$this->render('indicator');
	}
	/**
	GRAFICOS COMERCIALES
	*/
	public function actionCommercialUno()
	{
		$this->layout='//layouts/graphcolumn2';
		$this->render('graphCommercial/commercialUno');
	}
	public function actionCommercialDos()
	{
		$this->layout='//layouts/graphcolumn2';
		$this->render('graphCommercial/commercialDos');
	}	
	/**
	GRAFICOS FINANCIEROS
	*/

	/**
	GRAFICOS TECNICOS
	*/

	/**
	GRAFICOS INDICADORES
	*/

}