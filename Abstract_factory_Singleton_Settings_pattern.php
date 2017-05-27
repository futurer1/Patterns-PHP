/**
* Шаблон использования 2х паттернов: Abstract Factory и Singleton совместно с классом-конфигурацией (Settings)
*/

class Settings {
    static $COMMSTYPE = 'Mega'; //можно задать значение 'Bloggs', тогда фабрикой будут создаваться объекты другого типа
}

