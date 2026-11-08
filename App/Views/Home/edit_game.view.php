<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Game $game */
/** @var string|null $error */
?>

<main class="create-game-page">
    <div class="create-game-intro">
        <a class="back-to-games" href="<?= $link->url('home.index') ?>">← Späť na moje hry</a>
        <p class="page-eyebrow">Upraviť hru</p>
        <h3>Uprav informácie ku hre</h3>
        <p>Vypíš informácie ku svojej hre.</p>
    </div>

    <form class="create-game-form" method="post" action="<?= $link->url('home.edit_game', ['id' => $game->getId()]) ?>">
        <div class="game-form-scroll" role="region" aria-label="Údaje novej hry" tabindex="0">
            <div class="game-form-banner" aria-hidden="true"></div>
            <div class="game-form-fields">
                <h3>Základné informácie</h3>
                <p class="form-hint">Vyplň všetky údaje a vytvor miesto pre svoju novú hru.</p>

                <div class="game-form-field">
                    <?php if ($error !== null): ?>
                    <p role="alert">
                        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <?php endif; ?>
                    <label for="game_name">Názov hry</label>
                    <input id="game_name" name="game_name" type="text" maxlength="150" placeholder="Napríklad Vražda na chate" value="<?= htmlspecialchars($game->getGameName(), ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="game-form-row">
                    <div class="game-form-field">
                        <label for="genre">Žáner</label>
                        <select id="genre" name="genre" required>
                            <option value="" disabled <?= $game->getGenre() === '' ? 'selected' : '' ?>>Vyber žáner</option>
                            <option
                                    value="zahada"
                                    <?= $game->getGenre() === 'zahada' ? 'selected' : '' ?>
                            >Záhada</option>
                            <option
                                    value="thriller"
                                    <?= $game->getGenre() === 'thriller' ? 'selected' : '' ?>
                            >Thriller</option>
                            <option
                                    value="komedia"
                                    <?= $game->getGenre() === 'komedia' ? 'selected' : '' ?>
                            >Komédia</option>
                        </select>
                    </div>
                    <div class="game-form-field">
                        <label for="player_count">Počet hráčov</label>
                        <input id="player_count" name="player_count" type="number" min="1" value="<?= (int) $game->getPlayerCount() ?>" required>
                    </div>
                </div>

                <div class="game-form-field">
                    <label for="description">Opis hry</label>
                    <textarea
                            id="description"
                            name="description"
                            rows="6"
                            required><?= htmlspecialchars($game->getDescription(), ENT_QUOTES, 'UTF-8') ?></textarea>
                    <p class="form-hint">Tento text sa zobrazí aj na karte hry v tvojom zozname.</p>
                </div>

                <div class="game-form-field">
                    <label for="status">Stav projektu</label>
                    <select id="status" name="status" required>
                        <option value="rozpracovana" <?= $game->getStatus() === 'rozpracovana' ? 'selected' : '' ?>>Rozpracovaná</option>
                        <option value="dokoncena" <?= $game->getStatus() === 'dokoncena' ? 'selected' : '' ?>>Dokončená</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="game-form-actions">
            <a class="back-to-games" href="<?= $link->url('home.index') ?>">Zrušiť</a>
            <button class="button" type="submit">Uložiť zmeny →</button>
        </div>
    </form>
</main>
