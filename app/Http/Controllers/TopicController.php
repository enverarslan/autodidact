<?php

namespace App\Http\Controllers;

use App\Http\Requests\Topic\CommentCreateRequest;
use App\Http\Requests\Topic\CreateCommentRequest;
use App\Http\Requests\Topic\CreateRequest;
use App\Http\Requests\Topic\DeleteCommentRequest;
use App\Models\Comment;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Topic::with('author')
            ->withCount('comments');

        if ($request->has('site')){
            $query->where('link', 'like', "%".$request->get('site')."%");
        }
        $topics = $query->orderBy('last_comment_at', 'desc')
            ->paginate(10, ['*'], 'p', $request->get('p', 1));

        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $topic = Topic::create($request->all());
            DB::commit();
            return redirect()->route('topics.show', ['pid'=>$topic->identifier, 'slug'=>$topic->slug]);
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param string $pid
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, string $slug, string $pid)
    {
        $topic = Topic::with('author')
            ->withCount('comments')
            ->where('slug', $slug)
            ->where('identifier', $pid)
            ->firstOrFail();

        $comments = Comment::with('author')->where('topic_id', $topic->id)->orderBy('created_at', 'asc')->simplePaginate(20);

        return view('topics.show', compact('topic', 'comments'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $pid, Request $request)
    {
        $topic = Topic::where('identifier', $pid)->firstOrFail();
        $this->authorize('delete', $topic);
        $topic->delete();
        return redirect()->route('home');
    }

    public function comment(string $pid, CommentCreateRequest $request)
    {
        $topic = Topic::where('identifier', $pid)->firstOrFail();
        $topic->comments()->create($request->only('body'));
        $topic->timestamps = false;
        $topic->last_comment_at = Carbon::now();
        $topic->save();
        return redirect()->back();
    }

    public function commentDestroy(string $pid, Request $request)
    {
        $comment = Comment::where('identifier', $pid)->firstOrFail();
        $topic_id = $comment->topic_id;
        $comment_date =  $comment->updated_at;
        $this->authorize('delete', $comment);
        $comment->delete();

        // TODO: Restore before this comment's timestamp with topic update time.
        Topic::updateLatestCommentTimestamp($topic_id, $comment_date);

        return redirect()->back();
    }

    public function permalink(string $pid)
    {
        $topic = Topic::where('identifier', $pid)->firstOrFail();
        return redirect()->route('topics.show', ['pid'=>$topic->identifier, 'slug'=>$topic->slug]);
    }

    public function host($host)
    {
        $topics = Topic::with('author')
            ->withCount('comments')
            ->where('link', 'like', "%".$host."%")
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('topics.index', compact('topics'));
    }

    public function search(Request $request)
    {
        $title = $request->get('q');
        $topics = Topic::with('author')
            ->withCount('comments')
            ->where('title', 'like', "%$title%")
            ->orderBy('last_comment_at', 'desc')
            ->paginate(10);
        return view('topics.index', compact('topics'));
    }

    public function getTopicList(Request $request){
        $page = $request->get('p', 1);
        session()->put('latest_topics_page', $page);
        $latest_topics = Topic::getLatestTopicList($page);
        $html = view('topics.partials.latest_topics_list', compact('latest_topics'))->render();
        $html = preg_replace("/\\n/", "", $html);
        $html = preg_replace("/\\s\\s/", "", $html);
        return response()->json(['success'=> true, 'content'=> $html]);//->setCache(['max_age'=>60, 'public'=>true]);
    }
}
