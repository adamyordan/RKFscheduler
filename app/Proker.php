<?php

namespace Scheduler;

use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    //
  public function division() {
    return $this->belongsTo('Scheduler\Division');
  }
}
