<?php
/**
* Шаблон Prototype
* Особенность заключается в том, что происходит клонирование уже созданных объектов с сохранением их первоначального статуса
*/
abstract class Sea {}    //супер-класс 1
public class EarthSea extends Sea {}    //реализация 1
public class MarsSea extends Sea {}    //реализация 2

abstract class Plains {}    //супер-класс 2
public class EarthPlains extends Plains {}
public class MarsPlains extends Plains {}

abstract class Forest {}    //супер-класс 3
public class EarthForest extends Forest {}
public class MarsForest extends Forest {}

class TerrainFactory {
    private $sea;    //переменная private для хранения объекта-образца одной из реализаций типа Sea
    private $plains;    //переменная private для хранения объекта-образца одной из реализаций типа Plains
    private $forest;    //переменная private для хранения объекта-образца одной из реализаций типа Forest

    function __construct( Sea $sea, Plains $plains, Forest $forest ) {    //конструктор заносит объекты в переменные класса
        $this->sea = $sea;
        $this->plains = $plains;
        $this->forest = $forest;
    }

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
