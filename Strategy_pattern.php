<?php
abstract class Lesson
{
    private   $duration;
    private   $costStrategy;

    function __construct($duration, CostStrategy $strategy)
    {
        $this->duration = $duration;
        $this->costStrategy = $strategy;
    }

    function cost()
    {
        return $this->costStrategy->cost( $this );      //делегирование метода другому классу
    }

    function chargeType()
    {
        return $this->costStrategy->chargeType();
    }

    function getDuration()
    {
        return $this->duration;
    }

    //какие-то ещё методы класса...
}

class Lecture extends Lesson
{
    //Уточнение специфичной реализации класса Лекция
}

class Seminar extends Lesson
{
    //Уточнение специфичной реализации класса Семинар
}

abstract class CostStrategy    //это делегат класса Lesson
{
    abstract function cost(Lesson $lesson);
    abstract function chargeType();
}

class TimedCostStrategy extends CostStrategy
{
    function cost(Lesson $lesson)
    {
        return ($lesson->getDuration() * 5);
    }
    function chargeType()
    {
        return "почасовая оплата";
    }
}

class FixedCostStrategy extends CostStrategy
{
    function cost( Lesson $lesson )
    {
        return 30;
    }

    function chargeType()
    {
        return "фиксированная оплата";
    }
}

//заполняем массив новыми объектами
$lessons[] = new Seminar( 4, new TimedCostStrategy() ); //в конструктор Seminar отправляем объект TimedCostStrategy
$lessons[] = new Lecture( 4, new FixedCostStrategy() );

foreach ( $lessons as $lesson ) { //выводим содержимое объектов, содержащихся в массиве
    print "Оплата за занятие {$lesson->cost()}. ";
    print "Тип оплаты: {$lesson->chargeType()}\n";
}
/*
Выведет:
Оплата за занятие 20. Тип оплаты: почасовая оплата
Оплата за занятие 30. Тип оплаты: фиксированная оплата
*/
?>
