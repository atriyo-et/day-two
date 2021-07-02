<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $guarded = [];  //allowing all field to be fillable 
    public $timestamps = false; //to disable updated_at &P created_at in the database
    protected $table = 'options'; //defining the table name
}
