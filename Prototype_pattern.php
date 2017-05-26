<?php
/**
* Шаблон Prototype
* Особенность заключается в том, что происходит клонирование уже созданных объектов с сохранением их первоначального состояния,
* которое было с момента инициализации
* Если требуется управлять начальным состоянием объектов при клонировании, то необходимо использовать метод __clone()
*/
abstract class Sea    //супер-класс 1
{
    private $navigability = 0;    //переменная int
    function __construct( $navigability ) {
        $this->navigability = $navigability;
    }
}
class EarthSea extends Sea {}    //реализация 1
class MarsSea extends Sea {}    //реализация 2

abstract class Plains {}    //супер-класс 2
class EarthPlains extends Plains {}
class MarsPlains extends Plains {}

abstract class Forest {}    //супер-класс 3
class EarthForest extends Forest {}
class MarsForest extends Forest {}

class TerrainFactory {
    private $sea;       //переменная private для хранения объекта-образца одной из реализаций типа Sea
    private $plains;    //переменная private для хранения объекта-образца одной из реализаций типа Plains
    private $forest;    //переменная private для хранения объекта-образца одной из реализаций типа Forest

    function __construct( Sea $sea, Plains $plains, Forest $forest )    //конструктор заносит объекты в переменные класса
                                                                        //ожидаем конкретные типы объектов
    {
        $this->sea = $sea;
        $this->plains = $plains;
        $this->forest = $forest;
    }
    
    function __clone(){}    //можем менять состояние клонируемого объекта

    function getSea() {
        return clone $this->sea;    //возвращаем клонированный объект из уже созданного, т.е. из прототипа
    }

    function getPlains() {
        return clone $this->plains;
    }

    function getForest() {
        return clone $this->forest;
    }
}

//Используем инструментарий:
$obj_factory = new TerrainFactory(new EarthSea(-1),
                                  new EarthPlains(),
                                  new EarthForest() );  //создали объект-фабрику с объектами-прототипами внутри
print_r( $obj_factory->getSea() );    //выводим клонированные объекты
print_r( $obj_factory->getPlains() );
print_r( $obj_factory->getForest() );

/*
Выведет:
EarthSea Object ( [navigability:Sea:private] => -1 )
EarthPlains Object ( )
EarthForest Object ( ) 
*/
