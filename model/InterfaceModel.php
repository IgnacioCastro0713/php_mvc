<?php
namespace InterfaceModel;

interface InterfaceModel
{
    public function save();
    public function update($id);
    public function delete($id);
    public function getAll();
    public function getById($id);
}
