<?php
/**
* Шаблон Abstract Factory (абстрактная фабрика)
* Развивает принцип шалона Factory Method, добавляя в супер-класс создателя возможность генерировать объекты различных типов
* Таким образом у нас уже не единичный метод с фабрикой одного типа объектов, а целая куча создаваемых типов.
*/

abstract class CommsManager {    //супер-класс создателя. Умеет создавать объекты 3х типов
    abstract function getHeaderText();
    abstract function getApptEncoder();    //метод для генерации объекта-продукта 1
    abstract function getTtdEncoder();     //метод для генерации объекта-продукта 2
    abstract function getContactEncoder(); //метод для генерации объекта-продукта 3
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {    //реализация 1 класса создателя
    function getHeaderText() {
        return "Заголовок Bloggs<br />";
    }

    function getApptEncoder() {    //возвращает созданный объект типа BloggsAppt
        return new BloggsApptEncoder();
    }

    function getTtdEncoder() {    //возвращает созданный объект типа BloggsTtd
        return new BloggsTtdEncoder();
    }

    function getContactEncoder() {    //возвращает созданный объект типа BloggsContact
        return new BloggsContactEncoder();
    }

    function getFooterText() {
        return "Подвал Bloggs<br />";
    }
}

class MegaCommsManager extends CommsManager {    //реализация 2 класса создателя
    function getHeaderText() {
        return "Заголовок MegaCal<br />";
    }

    function getApptEncoder() {    //возвращает созданный объект типа MegaAppt
        return new MegaApptEncoder();
    }

    function getTtdEncoder() {    //возвращает созданный объект типа MegaTtd
        return new MegaTtdEncoder();
    }

    function getContactEncoder() {    //возвращает созданный объект типа MegaContact
        return new MegaContactEncoder();
    }

    function getFooterText() {
        return "Подвал MegaCal<br />";
    }
}

abstract class ApptEncoder {    //супер-класс продукта
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {    //объект-продукта 1 для создателя 1
    function encode() {
        return "Кодируем данные в формат BloggsAppt<br />";
    }
}

class BloggsTtdEncoder extends ApptEncoder {    //объект-продукта 2 для создателя 1
    function encode() {
        return "Кодируем данные в формат BloggsTtd<br />";
    }
}

class BloggsContactEncoder extends ApptEncoder {    //объект-продукта 3 для создателя 1
    function encode() {
        return "Кодируем данные в формат BloggsContact<br />";
    }
}

class MegaApptEncoder extends ApptEncoder {       //объект-продукта 1 для создателя 2
    function encode() {
        return "Кодируем данные в формат MegaAppt<br />";
    }
}
class MegaTtdEncoder extends ApptEncoder {        //объект-продукта 2 для создателя 2
    function encode() {
        return "Кодируем данные в формат MegaTtd<br />";
    }
}
class MegaContactEncoder extends ApptEncoder {    //объект-продукта 3 для создателя 2
    function encode() {
        return "Кодируем данные в формат MegaContact<br />";
    }
}

//Используем инструментарий:
$mgr = new BloggsCommsManager();    //объект реализации 1
print $mgr->getHeaderText();
print $mgr->getApptEncoder()->encode();    //вызвали метод encode() объекта BloggsApptEncoder
print $mgr->getTtdEncoder()->encode();     //вызвали метод encode() объекта BloggsTtdEncoder
print $mgr->getContactEncoder()->encode(); //вызвали метод encode() объекта BloggsContactEncoder
print $mgr->getFooterText();

$mgr1 = new MegaCommsManager();    //объект реализации 2
print $mgr1->getHeaderText();
print $mgr1->getApptEncoder()->encode();    //вызвали метод encode() объекта MegaApptEncoder
print $mgr1->getTtdEncoder()->encode();     //вызвали метод encode() объекта MegaTtdEncoder
print $mgr1->getContactEncoder()->encode(); //вызвали метод encode() объекта MegaContactEncoder
print $mgr1->getFooterText();
/*
Нужно обратить внимание, что название методов
getApptEncoder(), getTtdEncoder(), getContactEncoder() вызова одинаковое для
разных реализаций объектов BloggsCommsManager и MegaCommsManager
*/
?>
