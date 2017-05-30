<?php
/**
* Развитие шаблона Composite
* Добавлен метод getComposite() для того чтобы различать среди однотипных объектов Композиты и Листы
*/
abstract class Unit    //супер-класс унифицированной единицы шаблона Composite (для Композитов и Листьев)
{
    public function getComposite()    //метод для определения типа класса (Композит или Лист)
    {
        return null;    //Лист всегда вернёт null, так мы узнаем, что у него нет методов add и remove
    }

    abstract function bombardStrength();    //любой пользовательский метод
}

abstract class CompositeUnit extends Unit    //абстрактный класс для построения Композитов
                                             //не имеет реализации метода bombardStrength
{
    private $units = array();    //массив для хранения объектов, содержащихся в Композите

    public function getComposite()        //Композит всегда вернёт объект, самого себя.
    {
        return $this;
    }

    protected function units()            //метод возвращает массив с содержимым Композита
    {
        return $this->units;
    }
    
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
}

class Army extends CompositeUnit    //класс конкретная реализация 1 Композита
{
    public function bombardStrength()    //считает сумму значений для всех объектов в массиве units
    {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();    //у каждого объекта типа Unit имеется метод bombardStrength()
        }
        return $ret;
    }
}

class Archer extends Unit               //реализация 1 Листа
{   
    public function bombardStrength()
    {
        return 5;
    }
}
class LaserCannonUnit extends Unit      //реализация 2 Листа
{   
    public function bombardStrength()
    {
        return 50;
    }
}

class UnitScript    //класс для операций над Композитами и Листьями (функционал поведения)
                    //для Композита: заключает объект $newUnit внутрь него
                    //для Листа: объединяет внутри нового Композита два объекта $newUnit и $occupyingUnit
{
    static function joinExisting( Unit $newUnit,
                                  Unit $occupyingUnit ) {
        $comp;    //обычная локальная переменная внутри метода
        if ( ! is_null( $comp = $occupyingUnit->getComposite() ) ) {    //если $occupyingUnit - Композит
            $comp->addUnit( $newUnit );
        } else {    //если $occupyingUnit - Лист
            $comp = new Army();
            $comp->addUnit( $occupyingUnit );
            $comp->addUnit( $newUnit );
        }
        return $comp;
    }
}

//Используем инструментарий:
