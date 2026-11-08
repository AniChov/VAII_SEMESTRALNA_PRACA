<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Game $game */
/** @var string $token */
?>
<main class="create-game-page">
    <section class="panel delete-game-panel" aria-labelledby="delete-heading">
        <p class="page-eyebrow">Vymazanie hry</p>
        <h2 id="delete-heading">Naozaj chceš vymazať túto hru?</h2>
        <h3><?= htmlspecialchars($game->game_name, ENT_QUOTES, 'UTF-8') ?></h3>
        <p>Hra sa odstráni z databázy. Túto akciu nie je možné vrátiť späť.</p>
        <form method="post" action="<?= $link->url('home.delete_game') ?>">
            <input type="hidden" name="id" value="<?= (int) $game->id ?>">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8') ?>">
            <div class="delete-game-actions">
                <a class="back-to-games" href="<?= $link->url('home.index') ?>">Zrušiť a ponechať hru</a>
                <button class="button" type="submit">Áno, vymazať hru</button>
            </div>
        </form>
    </section>
</main>
