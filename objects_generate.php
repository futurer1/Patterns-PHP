<?php
/**
* Генерация объектов, разделение логики
*/

abstract class Employee    //абстрактный супер-класс для всех сотрудников
{
    protected $name;
    private static $types = array( 'Minion', 'CluedUp', 'WellConnected' );    //типы объектов, которые будет создавать фабрика

    static function recruit( $name ) {      //создает объект сотрудника случайного типа и возвращает его
        $num = rand( 1, count( self::$types ) )-1;
        $class = self::$types[$num];
        return new $class( $name );
    }

    public function __construct( $name ) {
        $this->name = $name;
    }
    
    abstract function fire();    //реализация будет внутри каждого типа сотрудника по отдельности
}

class Minion extends Employee    //наследник исполняющий функционал 1 (младшие сотрудники)
{
    public function fire() {    //одинаковое название метода у всех типов наследников
        print "{$this->name}: я освободил рабочее место\n";    //использует имя из переменной родительсткого класса
    }
}

class CluedUp extends Employee    //наследник исполняющий функционал 2 (старшие сотрудники)
{
    public function fire() {
        print "{$this->name}: я звоню своему адвокату\n";
    }
}

class WellConnected extends Employee    //наследник исполняющий функционал 3 (протеже сотрудники)
{
    public function fire() {
        print "{$this->name}: звоню покровителю\n";
    }
}

class NastyBoss    //класс-фабрика для создания и удаления объектов Employee
{
    private $employees = array();    //здесь будут храниться объекты сотрудников

    public function addEmployee( Employee $employee ) {    //добавляет новых сотрудников в массив
        $this->employees[] = $employee;
    }

    public function projectFails() {          //удаляет сотрудника, использую метод fire() класса сотрудника
        if ( count( $this->employees ) ) {    //если есть кого уволить
            $emp = array_pop( $this->employees );
            $emp->fire();                     //использован полиморфизм
        }
    }
}

//Используем инструментарий
$boss = new NastyBoss();
$boss->addEmployee( Employee::recruit("Василий") );   //используем статический метод супер-класса для получения объекта
$boss->addEmployee( Employee::recruit("Николай") );
$boss->addEmployee( Employee::recruit("Галина") );

$boss->projectFails();
$boss->projectFails();
$boss->projectFails();

/*
Выведет:
Галина: я освободил рабочее место
Николай: я звоню своему адвокату
Василий: звоню покровителю
*/
?>
