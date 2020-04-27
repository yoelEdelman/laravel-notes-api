<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Validator;
class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
                    ->json(['error' => Null, 'notes' => Note::all()]);

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
    public function store(Request $request )
    {

        $validation = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if ($validation->fails()) {


            $message = $validation->messages()->toArray();
            return response()
                        ->json(['error' => $message['content'][0]] );
        }

       $note = note::create($request->all());

        return response()
                    ->json(['error' => Null, 'note' => $note->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note, $id)
    {
        //
        $result = $note->find($id);

        if ($result){
            return response()
                        ->json(["error" => Null, 'note' => $result]);
        } else{
            return response()
                        ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note, $id)
    {
        //

        $note = Note::find($id);

        if(!$note){
            return response()
                ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

        $validation = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if ($validation->fails()) {
            $message = $validation->messages()->toArray();

            return response()
                        ->json(['error' => $message['content'][0]] );
        }

        $note->update($request->all());

        return response()
                    ->json(['error' => Null, 'note' => $note->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note, $id)
    {
        $note = Note::find($id);

        if(!$note){
            return response()
                        ->json(["error" => "Cet identifiant est inconnu"], 404);
        }

        $note->delete();

        return response()
                    ->json(["error" => Null ]);


    }
}
