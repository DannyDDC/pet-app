<?php

namespace App\Util;

use App\Mail\RegistroUsuario;
use App\Mail\RegistroSolicitud;

class Helpers
{
  static function sendEmail($data, $type)
    {
      if($type == 'user_create') {
        \Mail::to($data->recipients)->send(new RegistroUsuario($data));
      }

      if($type == 'request_create') {
        \Mail::to($data->recipients)->send(new RegistroSolicitud($data));
      }
    }

    static function localStorage($route, $file) {
      \Storage::disk('local')->put($route,\File::get($file));
    }

    static function getlocalStorageFile($route) {
      return \Storage::disk('local')->get('/'.$route);
    }
}
