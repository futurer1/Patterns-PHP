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
        if (in_array($unit, $this->units,true)) {    //если объект уже присутствует в массиве объектов
                                                     //Сравнение происходит в том числе с учетом типа переменной
            return;
        }
        $this->units[] = $unit;    //добавляем объект в массив
    }
    
    public function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units, array($unit),  //вернет массив со значениями, для которых Ф.О.В. вернула 1
                            function($a, $b) {                  //функция обратного вызова (Ф.О.В.) для сравнения элементов
                                return ($a === $b) ? 0 : 1;     //если объект совпал, то возвращаем 0
                            }
                        );
    }
    
    public function bombardStrength()    //считает сумму значений для всех объектов Unit в массиве
    {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();    //у каждого объекта типа Unit имеется метод bombardStrength()
        }
        return $ret;
    }
}
