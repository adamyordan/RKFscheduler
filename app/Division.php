<?php

namespace Scheduler;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{

    public function prokers() {
      return $this->hasMany('Scheduler\Proker');
    }

    public function members() {
      return $this->hasMany('Scheduler\Member');
    }

}
