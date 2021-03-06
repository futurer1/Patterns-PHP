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
    private $parameter = 3;

    public function getParameter()    //название метода Компонента совпадает с названием внутри реализации Декоратора
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

class RealDecorator1 extends Decorator    //конкретная реализация 1 Декоратора
{
    public function getParameter()      //берём результат работы метода Компонента (хранимого в $obj_component объекта) и 
                                        //производим с ним ещё операцию (прибавляем 3)
    {
        return $this->obj_component->getParameter() + 3;
    }
}

class RealDecorator2 extends Decorator    //конкретная реализация 2 Декоратора
{
    public function getParameter()
    {
        return $this->obj_component->getParameter() * 3;
    }
}

class RealDecorator3 extends Decorator    //конкретная реализация 3 Декоратора
{
    public function getParameter()
    {
        return $this->obj_component->getParameter() - 3;
    }
}

//Используем инструментарий:
$obj = new RealComponent();
print $obj->getParameter();         //выведет: 3

$obj = new RealDecorator1( new RealComponent() );
print $obj->getParameter();         //выведет: 6

$obj = new RealDecorator2(
            new RealDecorator1(
                new RealComponent()
            )
       );
print $obj->getParameter();         //выведет: 18

$obj = new RealDecorator3(
            new RealDecorator2(
                new RealDecorator1(
                    new RealComponent()
                )
            )
        );
print $obj->getParameter();         //выведет: 15

$obj = new RealDecorator2(
            new RealDecorator3(
                new RealDecorator2(
                    new RealDecorator1(
                        new RealComponent()
                    )
                )
            )
        );
print $obj->getParameter();         //выведет: 45
