<?php
namespace Alert;

class Alert
{

    public static function toast($message, $type, $location)
    {
        echo "<script type='text/javascript'>
        Toast.fire({
          type: '{$type}',
          title: '{$message}'
        }).then(function() {
          setTimeout(\"location . href = '../$location'\", 0)
        });</script>";
    }

    public static function message($message, $type)
    {
        echo "<div class=\"{$type} alert-with-icon\">
                <button type=\"button\" aria-hidden=\"true\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <i class=\"tim-icons icon-simple-remove\"></i>
                </button>
            <span data-notify=\"icon\" class=\"tim-icons icon-alert-circle-exc\"></span>
            <span>
              <b> Error! - </b> {$message}</span>
          </div>";
    }

}