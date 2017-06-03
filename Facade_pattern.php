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

class ProductFacade {
    private $products = array();
    private $file;
    
    function __construct( $file ) {
        $this->file = $file;
        $this->compile();
    }

    private function compile() {
        $lines = getProductFileLines( $this->file );
        foreach ( $lines as $line ) {
            $id = getIDFromLine( $line );
            $name = getNameFromLine( $line );
            $this->products[$id] = getProductObjectFromID( $id, $name  );
        }
    }

    function getProducts() {
        return $this->products;
    }

    function getProduct( $id ) {
        if ( isset( $this->products[$id] ) ) {
            return $this->products[$id];
        }
        return null;
    }
}
