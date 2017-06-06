<?php
/**
* Шаблон Facade
* Позволяет разнести логику работы подсистемы на разные уровни (логика приложения, взаимодействие с БД, представление данных)
* Создает одну точку входа для уровня или подсистемы в целом. Чтобы клиентский код не использовал внутренние функции.
*/
function getProductFileLines($file)    //возвращает массив. Каждый элемент массива соответствует строке файла, 
                                       //с символами новой строки включительно
{
    return file($file);
}

function getProductObjectFromId($id, $productname)    //возвращает новый проинициализированный объект
{
    return new Product($id, $productname);
}
function getNameFromLine($line)    //вычленяем имя из строки
{
    if ( preg_match( "/.*-(.*)\s\d+/", $line, $array ) ) {
        return str_replace( '_',' ', $array[1] );
    }
    return '';
}

function getIDFromLine($line)      //вычленяем ID из строки
{
    if ( preg_match( "/^(\d{1,3})-/", $line, $array ) ) {
        return $array[1];
    }
    return -1;
}

class Product {    //класс продукта для хранения информации о продукте
    public $id;
    public $name;
    function __construct( $id, $name )
    {
        $this->id = $id;
        $this->name = $name;
    }
}

class ProductFacade    //класс Фасад для работы со всеми продуктами
{
    private $products = array();    //массив для хранения продуктов
    private $file;
    
    public function __construct($file)
    {
        $this->file = $file;
        $this->compile();
    }

    private function compile() {    //метод для компиляции файла $file
        $lines = getProductFileLines($this->file);    //заносит в $lines массив строк файла
        foreach ($lines as $line) {
            $id = getIDFromLine( $line );
            $name = getNameFromLine( $line );
            $this->products[$id] = getProductObjectFromID($id, $name);    //заносим в массив новый объект Продукта
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getProduct($id)
    {
        if (isset($this->products[$id])) {
            return $this->products[$id];
        }
        return null;
    }
}

//Используем инструментарий:
$facade = new ProductFacade("test2.txt");
print_r ($facade->getProduct(234));
