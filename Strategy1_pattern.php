<?php
/**
* Продолжение усложнения архитектуры паттерна "Стратегия"
* За основу используются классы из файла Strategy_pattern.php
*/
class RegistrationMgr    //класс для отправки уведомлений о событии
{
    function register( Lesson $lesson ) {
        //...какие-либо действия с объектом Lesson...

        //в переменную $notifier берём возвращенный методом getNotifier() объект
        $notifier = Notifier::getNotifier();
        //вызываем метод inform того типа объекта, который в переменной $notifier, 
        //вставив в него возвращенное из объекта Lesson значение ($lesson->cost())
        $notifier->inform( "новое занятие: стоимость - ({$lesson->cost()})" );
    }
}

abstract class Notifier   //класс для отделения способа отправки сообщений
{
    static function getNotifier() {   //статический метод создает и возвращает объект одного из 2х типов
        if (rand(1,2) === 1) {
            return new MailNotifier();
        } else {
            return new TextNotifier();
        }
    }

    abstract function inform( $message );
}

class MailNotifier extends Notifier   //способ уведомления через почту. Внутри этого класса вся логика отправки.
{
    function inform( $message ) {
        print "MAIL сообщение: {$message}\n";
    }
}

class TextNotifier extends Notifier   //способ уведомления через sms. Внутри этого класса вся логика отправки.
{
    function inform( $message ) {
        print "SMS сообщение: {$message}\n";
    }
}

//Вызов отправки уведомлений для объектов, созданных в файле Strategy_pattern.php
$mgr = new RegistrationMgr();   //объект-менеджер отправки
$mgr->register($lessons[0]);    //в элементе [0] - new Seminar( 4, new TimedCostStrategy() );
$mgr->register($lessons[1]);    //в элементе [1] - new Lecture( 4, new FixedCostStrategy() );

/*
Выведет:
MAIL сообщение: новое занятие: стоимость - (20)
SMS сообщение: новое занятие: стоимость - (30)
*/
?>
