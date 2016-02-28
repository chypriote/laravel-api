<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Champion;
use Dingo\Api\Routing\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChampionController extends Controller
{
	use Helpers;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Champion::orderBy('name', 'ASC')->get()->toArray();
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
		$champion = new Champion;

		$champion->name = $request->get('name');
		$champion->image = $request->get('image');

		if ($champion->save())
			return $this->response->created();
		else
		return $this->response->error('could_not_create_champion', 500);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$champion = Champion::find($id);

		if (!$champion)
			throw new NotFoundHttpException;
		return $champion;
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
		$champion = Champion::find($id);

		if (!$champion)
			throw new NotFoundHttpException;

		$champion->fill($request->all());

		if ($champion->save())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_update_champion');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$champion = Champion::find($id);

		if (!$champion)
			throw new NotFoundHttpException;

		if ($champion->delete())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_delete_champion');
	}
}
