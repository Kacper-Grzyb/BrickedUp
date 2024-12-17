<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Set;

/**
 * Class SetImage
 * 
 * @property string $set_number
 * @property bytea $image_data
 * 
 * @property Set $set
 *
 * @package App\Models
 */
class SetImage extends Model
{
	protected $table = 'set_images';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'image_data' => 'string'
	];

	protected $fillable = [
		'set_number',
		'image_data'
	];

	public function set()
	{
		return $this->belongsTo(Set::class, 'set_number');
	}
}
