<?php

namespace App\Models;
use Framework\Core\Model;

class Character extends Model
{
    protected static ?string $tableName = 'characters';

    protected static ?array $fillable = [
        'game_id',
        'character_name',
        'character_type',
        'role',
        'description',
        'is_culprit'
    ];

    protected ?int $id = null;
    protected ?int $game_id = null;
    protected string $character_name = '';

    protected string $character_type = 'playable';
    protected ?string $role = '';
    protected string $description = '';
    protected int $is_culprit = 0;

    public function getId(): ?int {
        return $this->id;
    }

    public function getGameId(): ?int {
        return $this->game_id;
    }

    public function setGameId(int $game_id): void
    {
        $this->game_id = $game_id;
    }

    public function getCharacterName(): string {
        return $this->character_name;
    }

    public function setCharacterName(string $character_name): void {
        $this->character_name = $character_name;
    }
    public function getCharacterType(): string {
        return $this->character_type;
    }

    public function setCharacterType(string $character_type): void {
        $this->character_type = $character_type;
    }

    public function getRole(): ?string {
        return $this->role;
    }

    public function setRole(?string $role): void {
        $this->role = $role;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getIsCulprit(): bool
    {
        return (bool) $this->is_culprit;
    }

    public function setIsCulprit(bool $is_culprit): void
    {
        $this->is_culprit = $is_culprit ? 1 : 0;
    }
}