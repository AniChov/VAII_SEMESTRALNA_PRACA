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

    protected ?int $id = null;
    protected string $game_name = '';
    protected string $genre = '';
    protected string $description = '';
    protected string $status = 'rozpracovana';
    protected int $player_count = 1;

    public function getId(): ?int {
        return $this->id;
    }

    public function getGameName(): string {
        return $this->game_name;
    }

    public function setGameName(string $gameName): void
    {
        $this->game_name = $gameName;
    }

    public function getGenre(): string {
        return $this->genre;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getPlayerCount(): int {
        return $this->player_count;
    }
}
