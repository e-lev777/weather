<?php

namespace Lib;

class Cart
{
    private $products_id;

    public function __construct(){
        $this->products_id = Cookie::get('product') != null ? unserialize(Cookie::get('product')) : array();
    }

    public function getProducts($for_sql = false){
        if( $for_sql ){
            return implode(",", $this->products_id);
        }
        return $this->products_id;
    }

    public function addProduct($id){
        $id = (int)$id;

        if( !in_array($id, $this->products_id) ){
            array_push($this->products_id, $id);
        }
        Cookie::set('product', serialize($this->products_id));
    }

    public function deleteProduct($id){
        $id = (int)$id;

        $key = array_search($id, $this->products_id);
        if( $key !== false ){
            unset($this->products_id[$key]);
        }
        Cookie::set('product', serialize($this->products_id));
        if( empty(Cookie::get('product')) ){
            Cookie::delete('product');
        }
    }

    public function clear(){
        Cookie::delete('product');
    }

    public function isEmpty(){
        return !$this->products_id;
    }
}