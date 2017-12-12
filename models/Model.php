<?php

class Model
{
    // Добавление датчика
    public static function createDatchik($name, $value, $izm, $ustroistvo_id) {

        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO datchik (name, value, izm, ustroistvo_id) '
        . 'VALUES (:name, :value, :izm, :ustroistvo_id)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':value', $value, PDO::PARAM_INT);
        $result->bindParam(':izm', $izm, PDO::PARAM_STR);
        $result->bindParam(':ustroistvo_id', $ustroistvo_id, PDO::PARAM_STR);
        if($result->execute()) {echo "OK";} else {echo "FAILT";};
        return true;
    }

    public static function createUstroistvo($name_ustr, $value_ustr) {

        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO ustroistva (name, trig) '
        . 'VALUES (:name_ustr, :value_ustr)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name_ustr', $name_ustr, PDO::PARAM_STR);
        $result->bindParam(':value_ustr', $value_ustr, PDO::PARAM_INT);
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




    public static function setValue($id, $new_value)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE datchik
            SET 
                value = :new_value 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':new_value', $new_value, PDO::PARAM_STR);
        
        $result->execute();
        return true;
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
            $list[$i]['ustroistvo_id'] = $row['ustroistvo_id'];

            $i++;
        }
        return $list;
    }

    public static function getDatchik($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM datchik WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
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

    public static function deleteUstroistvo($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM ustroistva WHERE id = :id';

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




    public static function trig($id)
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

