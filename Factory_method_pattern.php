/**
* Шаблон Factory Method
*/

abstract class ApptEncoder {
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {
    function encode() {
        return "Кодируем данные в формат Bloggs<br />";
    }
}
