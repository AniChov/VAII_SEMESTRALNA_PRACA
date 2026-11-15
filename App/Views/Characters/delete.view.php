<?php
/** @var \Framework\Support\LinkGenerator $link */
/** @var \App\Models\Character $character */
/** @var string $token */

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

        <p class="page-eyebrow">Vymazať postavu</p>
        <h3>Naozaj chceš vymazať túto postavu?</h3>

        <p>
            Postava
            <strong><?= htmlspecialchars(
                    $character->getCharacterName(),
                    ENT_QUOTES,
                    'UTF-8'
                ) ?></strong>
            bude natrvalo vymazaná.
        </p>
    </div>

    <form
        class="create-game-form"
        method="post"
        action="<?= $link->url('characters.delete') ?>"
    >
        <input
            type="hidden"
            name="id"
            value="<?= (int) $character->getId() ?>"
        >

        <input
            type="hidden"
            name="token"
            value="<?= htmlspecialchars(
                $token,
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <div class="game-form-fields">
            <div class="game-form-row">
                <button class="button" type="submit">
                    Áno, vymazať postavu
                </button>

                <a
                    class="secondary-button"
                    href="<?= $link->url('characters.index') ?>"
                >
                    Zrušiť
                </a>
            </div>
        </div>
    </form>
</main>
