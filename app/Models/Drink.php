<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $table = 'drink';

    protected $primaryKey = 'id_drink';
    protected $fillable = [
        'Drink_Name',
        'Qty',
        'Price',
        'Description',
        'Image'];
}
