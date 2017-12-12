<?php

class Model
{
    // Добавление датчика
    public static function createDatchik($name, $value, $izm, $ustr) {

        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO datchik (name, value, izm, ustr_id) '
        . 'VALUES (:name, :value, :izm, :ustr_id)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':value', $value, PDO::PARAM_INT);
        $result->bindParam(':izm', $izm, PDO::PARAM_STR);
        $result->bindParam(':ustr_id', $ustr_id, PDO::PARAM_STR);
        if($result->execute()) {echo "OK";} else {echo "FAILT";};
        return true;
    }


    public static function getUstroistva()
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Запрос к БД
        $result = $db->query('SELECT * FROM ustroistva');
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




     public static function getUstroistvoTrig($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Запрос к БД
        $sql = 'SELECT * FROM ustroistva  WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        // Обращаемся к записи
        $ustroistvo = $result->fetch();
        if ($ustroistvo) {
            // Если запись существует, возвращаем id пользователя
            return $ustroistvo['trig'];
        }
    }



    public static function getDatchiki()
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Запрос к БД
        $result = $db->query('SELECT * FROM datchik');
        // Получение и возврат результатов
        $i = 0;
        $list = array();
        while ($row = $result->fetch()) {
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['value'] = $row['value'];
            $list[$i]['izm'] = $row['izm'];
            $i++;
        }
        return $list;
    }

    public static function deleteDatchik($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM datchik WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }






    //пароль должен быть не меньше 6 символов
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }



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


    //авторизация 
    public static function auth($userId)
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }


    public static function getData()
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Запрос к БД
        $result = $db->query('SELECT ustroistva.id, ustroistva.name, ustroistva.trig, datchik.name as datchik_name, datchik.value,datchik.izm 
            FROM ustroistva
            INNER JOIN datchik
            ON ustroistva.id = datchik.ustroistvo_id');
        // Получение и возврат результатов
        $i = 0;
        $list = array();
        while ($row = $result->fetch()) {
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['trig'] = $row['trig'];
            $list[$i]['datchik_name'] = $row['datchik_name'];
            $list[$i]['value'] = $row['value'];
            $list[$i]['izm'] = $row['izm'];
            $i++;
        }
        return $list;
    }




    public static function tumbler($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $trig = Model::getUstroistvoTrig($id);
        if($trig == 1) {$trig = 0;}
        else {$trig = 1;}
        
        // Текст запроса к БД
        $sql = "UPDATE ustroistva 
            SET trig = :trig
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':trig', $trig, PDO::PARAM_INT);
        return $result->execute();
    }



       public static function off($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        $trig = 0;

        // Текст запроса к БД
        $sql = "UPDATE ustroistva 
            SET trig = :trig
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':trig', $trig, PDO::PARAM_INT);
        return $result->execute();
    }





}

