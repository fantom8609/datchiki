<?php

/**
 * Контроллер SiteController
 */
class SiteController
{

    /**
     * Action для главной страницы
     */
    public function actionIndex()
    {
        $params = Model::getParams();
        $temperature = $params['temperature'];
        $speed = $params['speed'];
        $trig = $params['trig'];

        $params_piston = Model::getPistonParams();
        $pressure = $params_piston['pressure'];
        $trig_piston = $params_piston['trig'];


        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action для установки скорости и температуры
     */
    public function actionUpdateTs()
    {

        if(!empty($_POST['temperature'])) {
            $temperature = htmlspecialchars(trim(($_POST['temperature'])));
        }
        else {
            $params_vent = Model::getParams();
            $pressure = $params_vent['temperature'];
        }

        if(!empty($_POST['speed'])) {
            $speed = htmlspecialchars(trim(($_POST['speed'])));
        }
        else {
            $params_vent = Model::getParams();
            $pressure = $params_vent['speed'];
        }

        Model::setTs($temperature,$speed);
        $callback = array();
        $callback['temperature'] = $temperature;
        $callback['speed'] = $speed;
        $callback = json_encode($callback);
        print_r($callback);
        // Подключаем вид
        //require_once(ROOT . '/views/site/index.php');
        return true;
    }


    /**
     * Action для установки давления
     */
    public function actionUpdatePressure()
    {
       if(!empty($_POST['pressure'])) {
            $pressure = htmlspecialchars(trim(($_POST['pressure'])));
        } 
        else {
            $params_piston = Model::getPistonParams();
            $pressure = $params_piston['pressure'];
        }
        Model::setPresure($pressure);
        echo $pressure;
        return true;
    }

    

}
