<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Pemantauan extends Model
{
    use HasFactory;
    use Searchable;

    // protected $connection = 'spkk';

    /**
     * Get the value used to index the model.
     */
    public function getScoutKey(): mixed
    {
        return $this->park_name;
    }

    /**
     * Get the key name used to index the model.
     */
    public function getScoutKeyName(): mixed
    {
        return 'park_name';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'park_name' => $this->park_name,
        ];
    }
}
