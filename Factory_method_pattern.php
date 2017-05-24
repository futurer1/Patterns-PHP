<?php
/**
* Шаблон Factory Method
*/

abstract class ApptEncoder {
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {
    function encode() {
        return "Кодируем данные в формат Bloggs<br />";
    }
}

abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {
    function getHeaderText() {
        return "Заголовок Bloggs\n";
    }

    function getApptEncoder() {
        return new BloggsApptEncoder();    //возвращает созданный закодированный объект типа Bloggs
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
