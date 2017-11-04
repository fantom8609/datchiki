<?php

/**
 * Контроллер SiteController
 */
class SiteController {

    /**
     * Action для главной страницы
     */
    public function actionIndex() {
        $name = false;
        $value = false;
        $izm = false;
        if (isset($_POST['submit'])) {
            $name = htmlspecialchars(trim($_POST['name']));
            $value = htmlspecialchars(trim($_POST['value']));
            $izm = htmlspecialchars(trim($_POST['izm']));
            if (gettype($value) !== "double") {
                $errors[] = "Значение должно быть числового типа";
            }
            Model::createDatchik($name, $value, $izm);
            header("Location: index.php");
        }
        $datchiki = Model::getDatchiki();




/*//установка в ручную        
        if (isset($_POST['set'])) {
            $new_value = array();
            foreach($datchiki as $datchik) {
                $name = $datchik['name'];
                $new_value[$name] = htmlspecialchars(trim($_POST['$name']));
                if (gettype($new_value[$name]) !== "double") {
                    $errors[] = "Значение должно быть числового типа";
                }
                Model::setValue($new_value);
                header("Location: index.php");
                echo "string";
            }
        }*/




        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionDeleteDatchik($id)
    {
        // Добавляем товар в корзину и печатаем результат: количество товаров в корзине
        Model::deleteDatchik($id);
        header("Location: /");
    }
}