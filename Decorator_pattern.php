<?php
/**
 * Шаблон Decorator
 * Позволяет создать конвейер из операций, путём вложенности слоёв с операциями друг в друга.
 * Можно строить гибкие структуры во время выполнения программы.
 * Можно использовать для построения фильтров.
 * Состоит из: Объект в переменной, Слой (в нём набор собственного функционала; метод для вызова операций объекта, хранящегося на слое)
 * Структурная единица Декоратора выполняет (прядок произвольный):
 *  1. Действия в Слое.
 *  2. Вызывает метод объекта, хранящегося внутри Слоя.
 */

abstract class Component                //абстрактный класс Компонента системы
{
    abstract function getParameter();
}

class RealComponent extends Component    //конкретная реализация Компонента системы
{
    private $parameter = 2;

    public function getParameter()
    {
        return $this->parameter;
    }
}

abstract class Decorator extends Component      //абстрактный класс Декоратора
{
    protected $obj_component;                   //для хранения одного объекта типа Component

    function __construct(Component $obj)        //записывает объект в переменную $obj_component
    {
        $this->obj_component = $obj;
    }
}

class RealDecorator extends Decorator    //конкретная реализация Декоратора
{
    public function getParameter()      //берём результат работы метода хранимого объекта и 
                                        //производим с ним ещё операцию (прибавляем 3)
    {
        return $this->obj_component->getParameter() + 3;
    }
}
