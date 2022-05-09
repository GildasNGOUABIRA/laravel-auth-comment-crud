<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        // $comments = Comment::all();
        $comments = Comment::where('user_id',auth()->user()->id)->paginate(2);
        return view('comment.list', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [
            'description' => 'required|between:2,255',
    ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();

        } else {
            $newPost = Comment::create([
                'description' => $request->description,
                'user_id' => auth()->user()->id

            ]);

            return back()->with('toast_success','Added successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //

        return view('comment.edit', [
            'comment'=>$comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //

        $validator = Validator::make($request->all(), [
            'description' => 'required|between:2,255',
    ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();

        } else {
            $comment->update([
                'description' => $request->description,

            ]);

            return back()->with('toast_success','Updated successfully!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //

        $comment->delete();
        return redirect('comment/');
    }
}
