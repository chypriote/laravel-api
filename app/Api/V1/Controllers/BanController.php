<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Champion;
use Dingo\Api\Routing\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BanController extends Controller
{
	use Helpers;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Ban::orderBy('created_at', 'DESC')->get()->toArray();
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
		$ban = new Ban;

		$ban->ban_1 = $request->get('ban_1');
		$ban->ban_1 = $request->get('ban_2');
		$ban->ban_1 = $request->get('ban_3');
		$ban->team_id = $request->get('team_id');
		$ban->game_id = $request->get('game_id');

		if ($ban->save())
			return $this->response->created();
		else
		return $this->response->error('could_not_create_ban', 500);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$ban = Ban::find($id);

		if (!$ban)
			throw new NotFoundHttpException;
		return $ban;
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
		$ban = Ban::find($id);

		if (!$ban)
			throw new NotFoundHttpException;

		$ban->fill($request->all());

		if ($ban->save())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_update_ban');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$ban = Ban::find($id);

		if (!$ban)
			throw new NotFoundHttpException;

		if ($ban->delete())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_delete_ban');
	}
}
