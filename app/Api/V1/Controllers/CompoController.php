<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Champion;
use Dingo\Api\Routing\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompoController extends Controller
{
	use Helpers;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return Compo::orderBy('created_at', 'DESC')->get()->toArray();
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
		$compo = new Compo;

		$compo->top = $request->get('top');
		$compo->jungle = $request->get('jungle');
		$compo->mid = $request->get('mid');
		$compo->adc = $request->get('adc');
		$compo->support = $request->get('support');
		$compo->team_id = $request->get('team_id');
		$compo->game_id = $request->get('game_id');

		if ($compo->save())
			return $this->response->created();
		else
		return $this->response->error('could_not_create_compo', 500);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$compo = Compo::find($id);

		if (!$compo)
			throw new NotFoundHttpException;
		return $compo;
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
		$compo = Compo::find($id);

		if (!$compo)
			throw new NotFoundHttpException;

		$compo->fill($request->all());

		if ($compo->save())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_update_compo');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$compo = Compo::find($id);

		if (!$compo)
			throw new NotFoundHttpException;

		if ($compo->delete())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_delete_compo');
	}
}
