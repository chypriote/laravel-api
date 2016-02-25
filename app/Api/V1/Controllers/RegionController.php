<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Region;
use App\Team;
use Dingo\Api\Routing\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
	use Helpers;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Region::orderBy('created_at', 'DESC')->get()->toArray();
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
		$region = new Region;

		$region->name = $request->get('name');
		$region->teams_count = 0;
		$region->games_count = 0;

		if ($region->save())
			return $this->response->created();
		else
		return $this->response->error('could_not_create_region', 500);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$region = Region::find($id);

		if (!$region)
			throw new NotFoundHttpException;
		return $region;
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
		$region = Region::find($id);

		if (!$region)
			throw new NotFoundHttpException;

		$region->fill($request->all());

		if ($region->save())
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
		$region = Region::find($id);

		if (!$region)
			throw new NotFoundHttpException;

		if ($region->delete())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_delete_region');
	}

	/**
	 * Shows the team from the current region.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function showTeams($id)
	{
		return Team::where('region_id', '=', $id)->orderBy('name', 'DESC')->get()->toArray();
	}
}
