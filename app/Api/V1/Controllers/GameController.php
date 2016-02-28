<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Champion;
use Dingo\Api\Routing\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
	use Helpers;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Game::orderBy('created_at', 'DESC')->get()->toArray();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$game = new Game;

		$game->week = $request->get('week');
		$game->team_1 = $request->get('team_1');
		$game->team_2 = $request->get('team_2');
		$game->compo_1 = $request->get('compo_1');
		$game->compo_2 = $request->get('compo_2');
		$game->ban_1 = $request->get('ban_1');
		$game->ban_2 = $request->get('ban_2');
		$game->winner = $request->get('winner');

		if ($game->save())
			return $this->response->created();
		else
		return $this->response->error('could_not_create_game', 500);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$game = Game::find($id);

		$game->team_1 = Team::find($game->team_1);
		$game->team_2 = Team::find($game->team_2);
		$game->compo_1 = Compo::find($game->compo_1);
		$game->compo_2 = Compo::find($game->compo_2);
		$game->ban_1 = Ban::find($game->ban_1);
		$game->ban_2 = Ban::find($game->ban_2);

		if (!$game)
			throw new NotFoundHttpException;
		return $game;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$game = Game::find($id);

		if (!$game)
			throw new NotFoundHttpException;

		$game->fill($request->all());

		if ($game->save())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_update_game');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$game = Game::find($id);

		if (!$game)
			throw new NotFoundHttpException;

		$comp = Compo::find($game->compo_1);
		$comp->delete();
		$comp = Compo::find($game->compo_2);
		$comp->delete();
		$ban = Ban::find($game->ban_1);
		$ban->delete();
		$ban = Ban::find($game->ban_2);
		$ban->delete();
		$team1 = Team::find($game->team_1);
		$team1->games_count--;
		$team2 = Team::find($game->team_2);
		$team2->games_count--;
		if ($game->winner == 1)
			$team1->wins_count--;
		else
			$team2->wins_count--;
		$team1->delete();
		$team2->delete();

		if ($game->delete())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_delete_game');
	}
}
