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

