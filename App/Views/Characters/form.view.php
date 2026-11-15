<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Character $character */
/** @var \App\Models\Game[] $games */
/** @var bool $isEditing */
/** @var string|null $error */

$title = $isEditing ? 'Upraviť postavu' : 'Vytvoriť postavu';

$backUrl = $character->getGameId() !== null
        ? $link->url('home.game', [
                'id' => $character->getGameId()
        ])
        : $link->url('home.index');
?>

<main class="create-game-page">
    <div class="create-game-intro">
        <a
            class="back-to-games"
            href="<?= htmlspecialchars($backUrl, ENT_QUOTES, 'UTF-8') ?>"
        >
            ← Späť na postavy
        </a>

        <p class="page-eyebrow">
            <?= $title ?>
        </p>

        <h3>
            <?= $isEditing
                ? 'Uprav informácie o postave'
                : 'Pridaj novú postavu do hry' ?>
        </h3>
    </div>

    <form
        class="create-game-form"
        method="post"
        action="<?= $link->url('characters.form') ?>"
    >
        <!-- Empty for creation; contains the character ID for editing. -->
        <input
            type="hidden"
            name="id"
            value="<?= htmlspecialchars(
                (string) ($character->getId() ?? ''),
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <div
            class="game-form-scroll"
            role="region"
            aria-label="Údaje postavy"
            tabindex="0"
        >
            <div class="game-form-banner" aria-hidden="true"></div>

            <div class="game-form-fields">
                <h3>Základné informácie</h3>

                <?php if ($error !== null): ?>
                    <p role="alert">
                        <?= htmlspecialchars(
                            $error,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </p>
                <?php endif; ?>

                <?php if (empty($games)): ?>
                    <p role="alert">
                        Najprv vytvor hru, ku ktorej priradíš postavu.
                    </p>

                    <a href="<?= $link->url('home.create_game') ?>">
                        Vytvoriť hru
                    </a>
                <?php endif; ?>

                <div class="game-form-field">
                    <label for="character_name">Meno postavy</label>

                    <input
                        id="character_name"
                        name="character_name"
                        type="text"
                        maxlength="150"
                        value="<?= htmlspecialchars(
                            $character->getCharacterName(),
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                        required
                    >
                </div>

                <div class="game-form-row">
                    <div class="game-form-field">
                        <label for="game_id">Hra</label>

                        <select id="game_id" name="game_id" required>
                            <option
                                value=""
                                disabled
                                <?= $character->getGameId() === null
                                    ? 'selected'
                                    : '' ?>
                            >
                                Vyber hru
                            </option>

                            <?php foreach ($games as $game): ?>
                                <option
                                    value="<?= (int) $game->getId() ?>"
                                    <?= $character->getGameId() === $game->getId()
                                        ? 'selected'
                                        : '' ?>
                                >
                                    <?= htmlspecialchars(
                                        $game->getGameName(),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="game-form-field">
                        <label for="character_type">Typ postavy</label>

                        <select
                            id="character_type"
                            name="character_type"
                            required
                        >
                            <option
                                value="playable"
                                <?= $character->getCharacterType() === 'playable'
                                    ? 'selected'
                                    : '' ?>
                            >
                                Hrateľná postava
                            </option>

                            <option
                                value="npc"
                                <?= $character->getCharacterType() === 'npc'
                                    ? 'selected'
                                    : '' ?>
                            >
                                NPC – nehrateľná postava
                            </option>
                        </select>
                    </div>
                </div>

                <div class="game-form-field">
                    <label for="role">Rola v príbehu</label>

                    <input
                        id="role"
                        name="role"
                        type="text"
                        maxlength="50"
                        placeholder="Napríklad detektív, svedok alebo obeť"
                        value="<?= htmlspecialchars(
                            $character->getRole() ?? '',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>"
                    >
                </div>

                <div class="game-form-field">
                    <label for="description">Opis postavy</label>

                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                    ><?= htmlspecialchars(
                            $character->getDescription(),
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?></textarea>
                </div>

                <div class="game-form-field">
                    <label class="culprit-checkbox" for="is_culprit">
                        <input
                                id="is_culprit"
                                name="is_culprit"
                                type="checkbox"
                                value="1"
                                <?= $character->getIsCulprit() ? 'checked' : '' ?>
                        >
                        <span>Postava je páchateľ</span>
                    </label>
                </div>

                <div class="game-form-row">
                    <button
                        class="button"
                        type="submit"
                        <?= empty($games) ? 'disabled' : '' ?>
                    >
                        <?= $isEditing
                            ? 'Uložiť zmeny'
                            : 'Vytvoriť postavu' ?>
                    </button>

                    <a
                            class="secondary-button"
                            href="<?= htmlspecialchars($backUrl, ENT_QUOTES, 'UTF-8') ?>"
                    >
                        Zrušiť
                    </a>
                </div>
            </div>
        </div>
    </form>
</main>