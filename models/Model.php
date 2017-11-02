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


    /*=======================================================
                      Работа с пользователем
    ==========================================================*/

    // проверяем существует ли пользователь админпанели
    public static function checkUserData($login, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE login = :login AND password = :password';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        
        $result->execute();

        // Обращаемся к записи
        $user = $result->fetch();
        

        if ($user) {
            // Если запись существует, возвращаем id пользователя
            return $user['id'];
        }
        return false;
    }



    //проверяем авторизован ли пользователь
    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }


   //пароль должен быть не меньше 6 символов
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }


    //авторизация 
    public static function auth($userId)
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }

/*==========================================================
                Работа в панели управления
============================================================*/

    public static function getUstroistva()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name, trig FROM ustroistvo');

        // Получение и возврат результатов
        $i = 0;
        $list = array();
        while ($row = $result->fetch()) {
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['trig'] = $row['trig'];
            $i++;
        }
        return $list;
    }











}