<?php
/** @var \Framework\Support\LinkGenerator $link */
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
        <section class="placeholder">
            <h2>Priestor pre obsah stránky</h2>
            <p>Tu sa bude zobrazovať obsah aplikácie.</p>

            <a class="button" href="<?= $link->url('home.hra') ?>">
                Otvoriť ukážku hry
            </a>
        </section>
    </main>
</div>