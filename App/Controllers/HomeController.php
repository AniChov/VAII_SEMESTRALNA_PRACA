<?php

namespace App\Controllers;

use App\Models\Game;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class HomeController
 * Handles actions related to the home page and other public actions.
 *
 * This controller includes actions that are accessible to all users, including a default landing page and a contact
 * page. It provides a mechanism for authorizing actions based on user permissions.
 *
 * @package App\Controllers
 */
class HomeController extends BaseController
{
    /**
     * Authorizes controller actions based on the specified action name.
     *
     * In this implementation, all actions are authorized unconditionally.
     *
     * @param string $action The action name to authorize.
     * @return bool Returns true, allowing all actions.
     */
    public function authorize(Request $request, string $action): bool
    {
        return true;
    }

    /**
     * Displays the default home page.
     *
     * This action serves the main HTML view of the home page.
     *
     * @return Response The response object containing the rendered HTML for the home page.
     */
    public function index(Request $request): Response
    {
        $session = $this->app->getSession();
        $message = $session->get('game_message');
        $session->set('game_message', null);
        return $this->html([
            'games' => Game::getAll(),
            'message' => $message
        ]);
    }

    /** Shows confirmation on GET and deletes the selected game on POST. */
    public function delete_game(Request $request): Response
    {
        $id = filter_var(
            $request->isPost() ? $request->post('id') : $request->get('id'),
            FILTER_VALIDATE_INT
        );

        if ($id === false || $id < 1) {
            return $this->redirect($this->url('home.index'));
        }

        $game = Game::getOne($id);
        if ($game === null) {
            return $this->redirect($this->url('home.index'));
        }

        $session = $this->app->getSession();
        $token = $session->get('game_delete_token');
        if ($request->isPost()) {
            $submittedToken = $request->post('token');
            if (!is_string($token) || !is_string($submittedToken)
                || !hash_equals($token, $submittedToken)) {
                $session->set('game_message', 'Potvrdenie vypršalo. Skús vymazanie znova.');
                return $this->redirect($this->url('home.index'));
            }

            $game->delete();
            $session->set('game_delete_token', null);
            $session->set('game_message', 'Hra bola vymazaná.');
            return $this->redirect($this->url('home.index'));
        }

        if (!is_string($token)) {
            $token = bin2hex(random_bytes(32));
            $session->set('game_delete_token', $token);
        }

        return $this->html(['game' => $game, 'token' => $token]);
    }

    public function edit_game(Request $request): Response
    {
        $id = filter_var($request->get('id'), FILTER_VALIDATE_INT);

        if ($id === false || $id < 1) {
            return $this->redirect($this->url('home.index'));
        }

        $game = Game::getOne($id);

        if ($game === null) {
            return $this->redirect($this->url('home.index'));
        }

        $error = null;

        if ($request->isPost()) {
            $game->setFromRequest($request);
            $game->setGameName(trim($game->getGameName()));

            if ($game->getGameName() === '') {
                $error = 'Zadaj názov hry.';
            } else {
                $game->save();

                return $this->redirect($this->url('home.game', ['id' => $game->getId()]));
            }
        }
        return $this->html(['game' => $game, 'error' => $error]);
    }

    /**
     * This function creates a new game that will be added to database.
     * Then after saving the window for the game creation will be opened.
     */
    public function create_game(Request $request): Response
    {
        $game = new Game();
        $error = null;
        if ($request->isPost()) {
            $game->setFromRequest($request);
            $game->setGameName(trim($game->getGameName()));
            if ($game->getGameName() === '') {
                $error = 'Zadaj nazov hry.';
            } else {
                $game->save();
                return $this->redirect(
                    $this->url('home.game', ['id' => $game->getId()])
                );
            }
        }
        return $this->html([
            'game' => $game,
            'error' => $error
        ]);
    }

    /**
     * Displays the game page.
     *
     * This action serves the HTML view for the game page.
     *
     * @return Response The response object containing the rendered HTML for the game page.
     */
    public function game(Request $request): Response
    {
        $id = filter_var($request->get('id'), FILTER_VALIDATE_INT);

        if ($id === false || $id < 1) {
            return $this->redirect($this->url('home.index'));
        }

        $game = Game::getOne($id);

        if ($game == null) {
            return $this->redirect($this->url('home.index'));
        }

        return $this->html([
            'game' => $game
        ]);
    }
}
