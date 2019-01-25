<?php
namespace InterfaceModel;

interface InterfaceModel
{
    public function save();

    public function update();

    public static function delete($id);

    public static function search($search);
}
