<?php

namespace App\Api\V1\Controllers;

use JWTAuth;
use App\Book;
use Dingo\Api\Routing\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
	use Helpers;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$currentUser = JWTAuth::parseToken()->authenticate();
		return $currentUser
			->books()
			->orderBy('created_at', 'DESC')
			->get()
			->toArray();
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
		$currentUser = JWTAuth::parseToken()->authenticate();

		$book = new Book;

		$book->title = $request->get('title');
		$book->author_name = $request->get('author_name');
		$book->pages_count = $request->get('pages_count');

		if ($currentUser->books()->save($book))
			return $this->response->created();
		else
			return $this->response->errir('could_not_create_book', 500);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$currentUser = JWTAuth::parseToken()->authenticate();

		$book = $currentUser->books()->find($id);

		if (!$book)
			throw new NotFoundHttpException;
		return $book;
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
		$currentUser = JWTAuth::parseToken()->authenticate();

		$book = $currentUser->books()->find($id);

		if (!$book)
			throw new NotFoundHttpException;

		$book->fill($request->all());

		if ($book->save())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_update_book');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$currentUser = JWTAuth::parseToken()->authenticate();

		$book = $currentUser->books()->find($id);

		if (!$book)
			throw new NotFoundHttpException;

		$book->fill($request->all());

		if ($book->delete())
			return $this->response->noContent();
		else
			return $this->response->error('could_not_delete_book');
	}
}
