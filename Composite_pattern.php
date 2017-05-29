<?php
/**
* Шаблон Composite
*/

abstract class Unit {
    abstract function addUnit(Unit $unit);    //обязательный метод для добавления объектов
    abstract function removeUnit(Unit $unit); //обязательный метод для удаления объектов
    abstract function bombardStrength();    //любой пользовательский метод
}

class Army extends Unit {
    private $units = array();    //массив для хранения объектов класса Unit
    
    public function addUnit(Unit $unit)
    {
        // TODO: Implement addUnit() method.
    }
    
    public function removeUnit(Unit $unit)
    {
        // TODO: Implement removeUnit() method.
    }
    
    public function bombardStrength()
    {
        // TODO: Implement bombardStrength() method.
    }
}
