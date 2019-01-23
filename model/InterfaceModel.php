<?php
namespace InterfaceModel;

interface InterfaceModel
{
    public function save();

    public function update($id);

    public static function delete($id);

    public static function search($search);

    public static function getById($id);
}
