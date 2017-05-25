<?php
/**
* Шаблон Factory Method
* Создатель - класс фабрики, в котором определем метод для генерации объекта-продукта.
* В каждом подклассе создателя создается экземпляр параллельного дочернего класса продукта.
*/

abstract class ApptEncoder {    //супер-класс продукта
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {    //конкретная реализация объекта-продукта
    function encode() {
        return "Кодируем данные в формат Bloggs<br />";
    }
}

abstract class CommsManager {    //супер-класс создателя
    abstract function getHeaderText();
    abstract function getApptEncoder();    //метод для генерации объекта-продукта
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {    //реализация класса создателя
    function getHeaderText() {
        return "Заголовок Bloggs\n";
    }

    function getApptEncoder() {
        return new BloggsApptEncoder();    //возвращает созданный объект типа Bloggs
    }

    function getFooterText() {
        return "Подвал Bloggs\n";
    }
}

//Используем инструментарий:
$mgr = new BloggsCommsManager();
print $mgr->getHeaderText();
print $mgr->getApptEncoder()->encode();    //вызов метода encode() объекта BloggsApptEncoder, созданного методом-фабрикой getApptEncoder()
print $mgr->getFooterText();
?>
