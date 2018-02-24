<?php

namespace App\Http\Controllers;

use App\Discuss;
use App\Http\Requests\DiscussRequest;
use App\Markdown\Markdown;
use Illuminate\Http\Request;

class DiscussController extends Controller
{
    protected $markdown;

    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth', ['only' => ['store', 'update', 'edit', 'create']]);
        $this->markdown = $markdown;
    }

    /**
     * Display a listing of the resource*
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $discussions = Discuss::orderBy('id', 'desc')->paginate(15);
        return view('discuss.index')->with(compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discuss.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscussRequest $request)
    {
        $params = $request->toArray() + ['user_id' => \Auth::id(), 'last_user_id' => \Auth::id()];
        $discussion = Discuss::create($params);
        return redirect()->action('DiscussController@show', ['id' => $discussion->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discuss $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Discuss $discussion)
    {
        $html = $this->markdown->markdown($discussion->body);
        return view('discuss.show')->with(compact('discussion', 'html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discuss $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discuss $discussion)
    {
        // only the owner can go access this action
        if (\Auth::check() && \Auth::id() != $discussion->user_id) {
            \Session::flash('discussion_edit_failed', '<strong>Sorry：</strong>只有帖子的作者可以编辑帖子');
            return redirect('/');
        }
        return view('discuss.edit')->with(compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DiscussRequest $request
     * @param Discuss $discussion
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(DiscussRequest $request, Discuss $discussion)
    {
        $discussion->update($request->toArray());
        return redirect('discussions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discuss $discuss
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discuss $discuss)
    {
        //
    }
}
