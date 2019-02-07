<?php
class Category{
    public $id;
    public $name;
    public $items = [];

    public function __construct($id, $name){
        $this->id = $id;
        $this->name = $name;
    }
}
?>