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
{
    private $units = array();

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

