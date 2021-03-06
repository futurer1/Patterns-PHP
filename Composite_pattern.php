<?php
/**
* Шаблон Composite
* Композит - класс или объект, хранящий в себе объекты такого же типа, а так же имеющий методы добавления и удаления хранимых объектов.
* Лист - элемент, реализующий функциональность объектов. Он не может хранить другие объекты и не может удалять добавлять объекты.
* Основной принцип шаблона - у Листьев всегда такой же интерфейс (перечень методов) как и у Композитов.
* Не слишком пригоден для сохранения в реляционной БД
* Отлично подходит для сохранения в XML (вид дерева вложенных элементов)
* Легко поддерживает добавление новых типов компонентов (Листов)
*/
class UnitException extends Exception {}    //наследуем базовый класс Exception

abstract class Unit {    //супер-класс Композита
    public function addUnit(Unit $unit)    //метод для добавления объектов (будет отсутствовать в классах Листьях)
    {
        //генерируем исключение по-умолчанию для тех объектов (Листьев), у которых не будет реализован метод addUnit
        throw new UnitException(get_class($this) . " относится к листьям и не имеет метода addUnit()");
    }
    public function removeUnit(Unit $unit)    //метод для удаления объектов (будет отсутствовать в классах Листьях)
    {
        //генерируем исключение по-умолчанию для тех объектов (Листьев), у которых не будет реализован метод removeUnit
        throw new UnitException(get_class($this) . " относится к листьям и не имеет метода removeUnit()");
    }
    abstract function bombardStrength();    //любой пользовательский метод
}

class Army extends Unit {    //реализация класса Композита (хранит внутри себя объекты, может создавать и удалять объекты)
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

class Archer extends Unit    //реализация 1 класса Листа (поддерживает операции с объектами класса Unit)
{   
    public function bombardStrength()
    {
        return 5;
    }
        
}

class LaserCannonUnit extends Unit    //реализация 2 класса Листа (поддерживает операции с объектами класса Unit)
{   
    public function bombardStrength()
    {
        return 50;
    }
}

//Используем инструментарий:
$one_army = new Army();    //создали объект Композит "Армия 1"
$one_army->addUnit(new Archer());           //добавили единицу Лист
$one_army->addUnit(new LaserCannonUnit());  //добавили единицу Лист

$two_army = new Army();    //создали объект Композит "Армия 2"
$two_army->addUnit(new Archer());  //добавили единицу Лист
$two_army->addUnit(new Archer());  //добавили единицу Лист
$two_army->addUnit(new Archer());  //добавили единицу Лист

$one_army->addUnit($two_army);    //добавили одну армию внутрь другой (Композит внутрь другого Композита)
print "Суммарная мощность: {$one_army->bombardStrength()}\n";
print_r ($one_army);

/*
Выведет:
Суммарная мощность: 70
Army Object ( 
                [units:Army:private] => Array (
                    [0] => Archer Object ( ) 
                    [1] => LaserCannonUnit Object ( ) 
                    [2] => Army Object ( 
                        [units:Army:private] => Array ( 
                            [0] => Archer Object ( ) 
                            [1] => Archer Object ( ) 
                            [2] => Archer Object ( ) 
                        ) 
                    )
                )
             ) 
*/
