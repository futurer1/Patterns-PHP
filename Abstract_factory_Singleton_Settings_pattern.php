<?php
/**
* Шаблон использования 2х паттернов: Abstract Factory и Singleton совместно с классом-конфигурацией (Settings)
*/

class Settings {
    static $COMMSTYPE = 'Mega'; //можно задать значение 'Bloggs', тогда фабрикой будут создаваться объекты другого типа
}

class AppConfig {    //класс типа Singleton, для работы с одной реализацией его объекта, находящейся внутри него самого
    private static $instance;    //переменная для хранения объекта класса AppConfig (самого себя)
    private $commsManager;    //переменная для хранения одного (из двух возможных) объекта-реализации класса Создателя

    private function __construct() {    //может быть вызван только изнутри класса
        $this->init();    //срабатывает только один раз по шаблону Singleton
    }
    
    private function init() {    //инициализация, создание объекта-Создателя и сохранение его в переменную $commsManager
        switch ( Settings::$COMMSTYPE ) {    //исходя из настроек конфигурации (из класса Settings)
            case 'Mega':
                $this->commsManager = new MegaCommsManager();    //заносит в переменную объект Создателя
                break;
            default:
                $this->commsManager = new BloggsCommsManager();
        }
    }
    
    public static function getInstance() {    //метод по шаблону Singleton для получения из вне объекта класса Singleton
                                              //через статический метод получаем доступ к объекту, хранящемуся в private переменной класса
        if ( empty( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getCommsManager() {    //публичный метод для получения private объекта Создателя
        return $this->commsManager;
    }
}

abstract class CommsManager { }    //супер-класс Создателя, на основе которого строятся Создатели конкретных реализаций

class MegaCommsManager extends CommsManager { }    //Создатель реализации 1
class BloggsCommsManager extends CommsManager { }    //Создатель реализации 2
