<?php

namespace App\Models;
use Framework\Core\Model;

class Game extends Model
{
    protected static ?string $tableName = 'games';

    protected static ?array $fillable = [
        'game_name',
        'genre',
        'description',
        'status',
        'player_count'
    ];

    public ?int $id = null;
    public string $game_name = '';
    public string $genre = '';
    public string $description = '';
    public string $status = 'rozpracovana';
    public int $player_count = 1;
}
