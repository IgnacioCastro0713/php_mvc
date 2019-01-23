<?php
namespace SweetAlert;

class SweetAlert
{

    public static function toast($message, $type, $location)
    {
        echo "<script type='text/javascript'>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top',
          showConfirmButton: false,
          timer: 1500
        });
        Toast.fire({
          type: '{$type}',
          title: '{$message}'
        }).then(function() {
          setTimeout(\"location . href = '../$location'\", 0)
        });</script>";
    }

}