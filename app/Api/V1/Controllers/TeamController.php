<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Team;
use App\Region;
use Dingo\Api\Routing\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
	use Helpers;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Team::orderBy('name', 'ASC')->get()->toArray();
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
		$team = new Team;

		$team->name = $request->get('name');
		$team->slug = $request->get('slug');
		$team->region_id = $request->get('region_id');
    $team->games_count = 0;
		$team->wins_count = 0;

		$region = Region::find($team->region_id);
		if (!$region)
			throw new NotFoundHttpException;

		$region->teams_count++;
		$region->save();

    if ($team->save())
      return $this->response->created();
    else
    return $this->response->error('could_not_create_team', 500);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$team = Team::find($id);

		if (!$team)
			throw new NotFoundHttpException;
		return $team;
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
		$team = Team::find($id);

		if (!$team)
			throw new NotFoundHttpException;

		$team->fill($request->all());

		if ($team->save())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_update_region');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$team = Team::find($id);
		$region = Region::find($team->region_id);
		$region->teams_count--;
		$region->save();

		if (!$team)
			throw new NotFoundHttpException;

		if ($team->delete())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_delete_region');
	}
}
