<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Game $game */
/** @var string|null $error */
?>

<main class="create-game-page">
    <div class="create-game-intro">
        <a class="back-to-games" href="<?= $link->url('home.index') ?>">← Späť na moje hry</a>
        <p class="page-eyebrow">Nový príbeh</p>
        <h2>Vytvor si novú hru</h2>
        <p>Začni názvom a námetom. Daj svojmu príbehu prvé obrysy.</p>
    </div>

    <form class="create-game-form" method="post" action="<?= $link->url('home.create_game') ?>">
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
                    <input id="game_name" name="game_name" type="text" maxlength="150" placeholder="Napríklad Vražda na chate" value="<?= htmlspecialchars($game->game_name, ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="game-form-row">
                    <div class="game-form-field">
                        <label for="genre">Žáner</label>
                        <select id="genre" name="genre" required>
                            <option value="" disabled <?= $game->genre === '' ? 'selected' : '' ?>>Vyber žáner</option>
                            <option
                                    value="zahada"
                                    <?= $game->genre === 'zahada' ? 'selected' : '' ?>
                            >Záhada</option>
                            <option
                                    value="thriller"
                                    <?= $game->genre === 'thriller' ? 'selected' : '' ?>
                            >Thriller</option>
                            <option
                                    value="komedia"
                                    <?= $game->genre === 'komedia' ? 'selected' : '' ?>
                            >Komédia</option>
                        </select>
                    </div>
                    <div class="game-form-field">
                        <label for="player_count">Počet hráčov</label>
                        <input id="player_count" name="player_count" type="number" min="1" value="<?= (int) $game->player_count ?>" required>
                    </div>
                </div>

                <div class="game-form-field">
                    <label for="description">Opis hry</label>
                    <textarea
                            id="description"
                            name="description"
                            rows="6"
                            required><?= htmlspecialchars($game->description, ENT_QUOTES, 'UTF-8') ?></textarea>
                    <p class="form-hint">Tento text sa zobrazí aj na karte hry v tvojom zozname.</p>
                </div>

                <div class="game-form-field">
                    <label for="status">Stav projektu</label>
                    <select id="status" name="status" required>
                        <option value="rozpracovana" <?= $game->status === 'rozpracovana' ? 'selected' : '' ?>>Rozpracovaná</option>
                        <option value="dokoncena" <?= $game->status === 'dokoncena' ? 'selected' : '' ?>>Dokončená</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="game-form-actions">
            <a class="back-to-games" href="<?= $link->url('home.index') ?>">Zrušiť</a>
            <button class="button" type="submit">Vytvoriť hru →</button>
        </div>
    </form>
</main>
