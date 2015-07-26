<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  /**
  * The table associated with the model.
  *
  * @var string
  */
  protected $table = 'task';
  
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = array('name', 'due_date');
  
  /**
  * Indicates if the model should be timestamped.
  *
  * @var bool
  */
  public $timestamps = false;
  
  /**
  * The accessors to append to the model's array form.
  *
  * @var array
  */
  protected $appends = ['is_due'];
  
  /**
  * Get the is due flag for all task.
  *
  * @return bool
  */
  public function getIsDueAttribute()
  {
    return false;
  }
    
}
