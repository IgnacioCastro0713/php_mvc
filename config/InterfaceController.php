<?php
namespace InterfaceModel;

interface InterfaceController
{
    public static function instanceModel();

    public static function save();

    public static function update();

    public static function destroy();

    public static function table();
}