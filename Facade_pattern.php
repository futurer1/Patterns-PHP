<?php
/**
* Шаблон Facade
*/
function getProductFileLines( $file )
{
    return file( $file );
}

function getProductObjectFromId( $id, $productname )
{
    return new Product( $id, $productname );
}

class Product {
    public $id;
    public $name;
    function __construct( $id, $name )
    {
        $this->id = $id;
        $this->name = $name;
    }
}
