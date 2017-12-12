<?php

/**
 * Контроллер CabinetController
 */
class CabinetController
{
    /**
     * Action для главной страницы
     */

    public function actionIndex()
    {

        //$data = Model::getData();
        $ustroistva = Model::getUstroistva();
        $datchiki = Model::getDatchiki();
        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }


    public function actionLogin()
    {
        // Переменные для формы
        $login = false;
        $password = false;
        
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $login = htmlspecialchars(trim($_POST['login']));
            $password = htmlspecialchars(trim($_POST['password']));
            
            // Флаг ошибок
            $errors = false;
            
            // Валидация полей
            if (!Model::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Проверяем существует ли пользователь
            $userId = Model::checkUserData($login, $password);
            if (!$userId) {$errors[] = 'failt';}

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа в панель управления';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                Model::auth($userId);

                // Перенаправляем пользователя в закрытую часть - кабинет 
                header("Location: /cabinet/index.php");
            }
        }


        // Подключаем вид
        require_once(ROOT . '/views/cabinet/login.php');
        return true;
    }



    public function actionTrig($id)
    {
        Model::trig($id);
        // Подключаем вид
        header("Location: /cabinet/index.php");
        return true;
    }

}
