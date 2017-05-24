<?php
/**
* Генерация объектов, разделение логики
*/

abstract class Employee    //абстрактный супер-класс для всех сотрудников
{
    protected $name;
    
    function __construct( $name ) {
        $this->name = $name;
    }
    
    abstract function fire();
}

class Minion extends Employee    //наследник исполняющий функционал 1 (младшие сотрудники)
{
    function fire() {
        print "{$this->name}: я освободил рабочее место\n";    //использует имя из переменной родительсткого класса
    }
}

class CluedUp extends Employee    //наследник исполняющий функционал 2 (старшие сотрудники)
{
    function fire() {
        print "{$this->name}: я звоню своему адвокату\n";
    }
}

class WellConnected extends Employee    //наследник исполняющий функционал 3 (протеже сотрудники)
{
    function fire() {
        print "{$this->name}: звоню покровителю\n";
    }
}
?>
