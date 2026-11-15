<?php

namespace App\Controllers;

use App\Models\Character;
use App\Models\Game;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

class CharactersController extends BaseController
{
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    public function index(Request $request): Response
    {
        return $this->redirect($this->url('home.index'));
    }

    public function form(Request $request): Response
    {
        $idValue = $request->isPost()
            ? $request->post('id')
            : $request->get('id');

        $isEditing = $idValue !== null && $idValue !== '';

        if ($isEditing) {
            $id = filter_var($idValue, FILTER_VALIDATE_INT);

            if ($id === false || $id < 1) {
                return $this->redirect(
                    $this->url('characters.index')
                );
            }

            $character = Character::getOne($id);

            if ($character === null) {
                return $this->redirect(
                    $this->url('characters.index')
                );
            }
        } else {
            $character = new Character();
            $type = $request->get('character_type');

            $character->setCharacterType(
                $type === 'npc' ? 'npc' : 'playable'
            );

            if (!$request->isPost()) {
                $gameId = filter_var(
                    $request->get('game_id'),
                    FILTER_VALIDATE_INT
                );

                if ($gameId !== false && $gameId > 0) {
                    if (Game::getOne($gameId) !== null) {
                        $character->setGameId($gameId);
                    }
                }
            }
        }

        $error = null;

        if ($request->isPost()) {
            $gameId = filter_var(
                $request->post('game_id'),
                FILTER_VALIDATE_INT
            );

            $name = $request->post('character_name');
            $type = $request->post('character_type');
            $role = $request->post('role');
            $description = $request->post('description');

            if (
                !is_string($name)
                || !is_string($type)
                || !is_string($role)
                || !is_string($description)
            ) {
                $error = 'Formulár obsahuje neplatné údaje.';
            } else {
                $character->setCharacterName(trim($name));
                $character->setCharacterType($type);
                $character->setRole(trim($role));
                $character->setDescription(trim($description));

                // The checkbox must have value="1".
                $character->setIsCulprit(
                    $request->post('is_culprit') === '1'
                );

                $game = null;

                if ($gameId !== false && $gameId > 0) {
                    $game = Game::getOne($gameId);
                }

                if ($game !== null) {
                    $character->setGameId($gameId);
                }

                if ($game === null) {
                    $error = 'Vyber existujúcu hru.';
                } elseif ($character->getCharacterName() === '') {
                    $error = 'Zadaj meno postavy.';
                } elseif (
                    !in_array($type, ['playable', 'npc'], true)
                ) {
                    $error = 'Vyber platný typ postavy.';
                } else {
                    $character->save();

                    $this->app->getSession()->set(
                        'character_message',
                        $isEditing
                            ? 'Postava bola upravená.'
                            : 'Postava bola vytvorená.'
                    );

                    return $this->redirect(
                        $this->url('home.game', [
                            'id' => $character->getGameId()
                        ])
                    );
                }
            }
        }

        return $this->html([
            'character' => $character,
            'games' => Game::getAll(),
            'isEditing' => $isEditing,
            'error' => $error
        ]);
    }

    public function delete(Request $request): Response
    {
        $id = filter_var(
            $request->isPost()
                ? $request->post('id')
                : $request->get('id'),
            FILTER_VALIDATE_INT
        );

        if ($id === false || $id < 1) {
            return $this->redirect($this->url('home.index'));
        }

        $character = Character::getOne($id);

        if ($character === null) {
            return $this->redirect($this->url('home.index'));
        }

        $gameUrl = $this->url('home.game', [
            'id' => $character->getGameId()
        ]);

        $session = $this->app->getSession();
        $token = $session->get('character_delete_token');

        if ($request->isPost()) {
            $submittedToken = $request->post('token');

            if (
                !is_string($token)
                || !is_string($submittedToken)
                || !hash_equals($token, $submittedToken)
            ) {
                $session->set(
                    'character_message',
                    'Potvrdenie vypršalo. Skús vymazanie znova.'
                );

                return $this->redirect($gameUrl);
            }

            $character->delete();

            $session->set('character_delete_token', null);
            $session->set(
                'character_message',
                'Postava bola vymazaná.'
            );

            return $this->redirect($gameUrl);
        }

        if (!is_string($token)) {
            $token = bin2hex(random_bytes(32));
            $session->set('character_delete_token', $token);
        }

        return $this->html([
            'character' => $character,
            'token' => $token
        ]);
    }
}