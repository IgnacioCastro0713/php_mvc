<?php
namespace InterfaceModel;

interface InterfaceModel
{
    public function fillable();

    public function save();

    public function update($id);

    public static function delete($id);

    public static function search($search);
}
