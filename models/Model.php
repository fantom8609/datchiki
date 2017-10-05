<?php

class Model
{
    // Установка параметров для вентилятора
    public static function setTs($temperature,$speed) {

        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO vent (temperature, speed) '
        . 'VALUES (:temperature, :speed)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':temperature', $temperature, PDO::PARAM_STR);
        $result->bindParam(':speed', $speed, PDO::PARAM_STR);
        $result->execute();
        return true;
    }


//Получение всех параметрво для вентилятора
    public static function getParams() {
         // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $sql = 'SELECT temperature, speed, trig FROM vent WHERE id = (SELECT MAX(id) FROM vent)';
        
        // Используется подготовленный запрос
        $result = $db->query($sql);

        // Получение и возврат результатов
        $params = $result->fetch();

        //print_r($params);

        return $params;
    }
    

       // Установка параметров для поршня
    public static function setPresure($pressure) {

        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO piston (pressure) '
        . 'VALUES (:pressure)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':pressure', $pressure, PDO::PARAM_STR);
        $result->execute();
        return true;
    }


    //Получение параметров для поршня

    public static function getPistonParams() {
         // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $sql = 'SELECT pressure, trig FROM piston WHERE id = (SELECT MAX(id) FROM piston)';
        
        // Используется подготовленный запрос
        $result = $db->query($sql);

        // Получение и возврат результатов
        $params_piston = $result->fetch();

        //print_r($params_piston);

        return $params_piston;
    }







}