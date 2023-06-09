<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specifications extends Model
{
    use HasFactory;
    protected $table = 'specification';
    protected $fillable = [
        'product_id',
        'co2_emissions',
        'urban_nonurban',
        'euro_status',
        'insurance_group',
        'security',
        'speed',
        'top_speed',
        'max_power',
        'max_torque',
        'valve_gear',
        'cyl_arr',
        'gears',
        'aspiration',
        'cylinders',
        'drive_rear',
        'length',
        'breath',
        'height',
        'max_gross_weight',
        'towing_weight_braked',
        'towing_weight_unbraked',
        'seats',
        'adult',
        'child',
        'pedestrian',
        'safety_assist',
        'overall',
    ];


}
