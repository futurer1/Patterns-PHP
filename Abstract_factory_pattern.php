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
?>
