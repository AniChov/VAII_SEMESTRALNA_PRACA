<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Game[] $games */
?>

<input
        type="checkbox"
        id="sidebar-toggle"
        class="sidebar-toggle"
        aria-label="Skryť bočný panel"
>

<label for="sidebar-toggle" class="sidebar-toggle-label">
    ☰ Menu a filtre
</label>

<div class="layout projects-page">
    <aside class="sidebar">
        <nav>
            <a href="<?= $link->url('home.index') ?>" aria-current="page">
                Moje projekty
            </a>
        </nav>

        <form class="filters">
            <h2>Filtre projektov</h2>

            <fieldset>
                <legend>Stav projektu</legend>

                <label>
                    <input type="radio" name="stav" value="vsetky" checked>
                    Všetky
                </label>

                <label>
                    <input type="radio" name="stav" value="rozpracovane">
                    Rozpracované
                </label>

                <label>
                    <input type="radio" name="stav" value="dokoncene">
                    Dokončené
                </label>
            </fieldset>

            <label for="zaner">Žáner</label>
            <select id="zaner" name="zaner">
                <option value="">Všetky žánre</option>
                <option value="zahada">Záhada</option>
                <option value="thriller">Thriller</option>
                <option value="komedia">Komédia</option>
            </select>

            <label for="pocet-hracov">Počet hráčov</label>
            <input
                    type="number"
                    id="pocet-hracov"
                    min="1"
                    placeholder="4"
            >

            <button type="reset">Zrušiť filtre</button>
        </form>
    </aside>

    <main>
        <section aria-labelledby="games-heading">
            <div class="games-heading">
                <div>
                    <h2 id="games-heading">Moje hry</h2>
                </div>
                <a class="button new-game-button" href="<?= $link->url('home.create_game') ?>">+ Nová hra</a>
            </div>

            <?php if (empty($games)): ?>
                <div class="games-empty">
                    <h3>Tu sa začína tvoj prvý príbeh</h3>
                    <p>Zatiaľ nemáš vytvorenú žiadnu hru. Začni tlačidlom „Nová hra“ nad zoznamom.</p>
                </div>
            <?php endif; ?>

            <?php if (!empty($message)): ?>
                <p class="game-message" role="status"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <div class="games-grid">
            <?php foreach ($games as $game): ?>
                <article class="game-card-item">
                <a class="game-card" href="<?= $link->url('home.game', ['id' => $game->getId()]) ?>">
                    <div class="game-card-cover" aria-hidden="true"></div>
                    <div class="game-card-body">
                    <h3>
                        <?= htmlspecialchars(
                                $game->getGameName(),
                                ENT_QUOTES,
                                'UTF-8'
                        ) ?>
                    </h3>

                    <p class="game-card-description">
                        <?= htmlspecialchars($game->getDescription(), ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <span class="game-card-open">Otvoriť hru <span aria-hidden="true">↗</span></span>
                    </div>
                </a>
                <div class="game-card-actions">
                    <a class="game-delete-link" href="<?= $link->url('home.delete_game', ['id' => $game->getId()]) ?>"
                       aria-label="<?= htmlspecialchars('Vymazať hru ' . $game->getGameName(), ENT_QUOTES, 'UTF-8') ?>">Vymazať</a>
                </div>
                </article>
            <?php endforeach; ?>
            </div>
        </section>
    </main>
</div>
