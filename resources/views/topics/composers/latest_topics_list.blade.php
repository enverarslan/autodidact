@if(session('latest_topics_page') > 1)
    <div class="px-2">
        {{$latest_topics->links('topics.partials.paginator')}}
    </div>
@endif
<ul class="space-y-2 text-gray-700 text-sm leading-5 mb-3">
    @foreach($latest_topics as $latest_topic)
    <li class="flex justify-between items-center hover:bg-gray-200 p-2 rounded"><a href="{{$latest_topic->topic_self_url}}">{{$latest_topic->title}}</a><span class="text-xs pl-2">{{$latest_topic->comments_count}}</span></li>
    @endforeach
</ul>
<div class="px-2">
{{$latest_topics->links('topics.partials.paginator')}}
</div>
