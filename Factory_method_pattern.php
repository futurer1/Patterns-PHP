<?php
/**
* Шаблон Factory Method (метод-фабрика)
* Создатель - класс фабрики, в котором определен метод для генерации объекта-продукта.
* В каждом подклассе создателя создается экземпляр параллельного дочернего класса продукта.
*/

abstract class ApptEncoder {    //супер-класс продукта
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {    //конкретная реализация 1 объекта-продукта
    function encode() {
        return "Кодируем данные в формат Bloggs<br />";
    }
}

class MegaApptEncoder extends ApptEncoder {    //конкретная реализация 2 объекта-продукта
    function encode() {
        return "Кодируем данные в формат Mega<br />";
    }
}

abstract class CommsManager {    //супер-класс создателя, создает только один тип объектов один методом
                                 //для каждой реализации создателя этого класса можно задать свой тип объектов, но только один
    abstract function getHeaderText();
    abstract function getApptEncoder();    //метод для генерации объекта-продукта
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {    //реализация 1 класса создателя
    function getHeaderText() {
        return "Заголовок Bloggs<br />";
    }

    function getApptEncoder() {
        return new BloggsApptEncoder();    //возвращает созданный объект типа Bloggs
    }

    function getFooterText() {
        return "Подвал Bloggs<br />";
    }
}

class MegaCommsManager extends CommsManager {    //реализация 2 класса создателя
    function getHeaderText() {
        return "Заголовок Mega<br />";
    }

    function getApptEncoder() {
        return new MegaApptEncoder();    //возвращает созданный объект типа Mega
    }

    function getFooterText() {
        return "Подвал Mega<br />";
    }
}

//Используем инструментарий:
$mgr = new BloggsCommsManager();
print $mgr->getHeaderText();
print $mgr->getApptEncoder()->encode();    //вызов метода encode() объекта BloggsApptEncoder, созданного методом-фабрикой getApptEncoder()
print $mgr->getFooterText();

$mgr1 = new MegaCommsManager();
print $mgr1->getHeaderText();
print $mgr1->getApptEncoder()->encode();    //вызов метода encode() объекта MegaApptEncoder, созданного методом-фабрикой getApptEncoder()
print $mgr1->getFooterText();
?>
