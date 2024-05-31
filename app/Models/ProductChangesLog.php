<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductChangesLog extends Model
{
    use HasFactory;
    protected $table = 'product_changes_logs';
    protected $fillable = ['product_id', 'action', 'changes'];

}
