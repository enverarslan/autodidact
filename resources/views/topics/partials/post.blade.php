<?php
$last = isset($last) ? $last : false;
$delete_route = ($type === 'topic') ? route('topics.destroy', $content->identifier) : route('topics.comment.destroy', $content->identifier);
?>

<div class="post relative p-4 @if (!$last) border-b @endif" id="c-{{$content->identifier}}">
    <div class="flex">
        <div class="content w-full">
            <div class="author-info relative flex w-full items-center mb-1">
                <a href="#" class="mr-2"><div class="flex items-center justify-center w-6 h-6 text-sm text-white font-semibold text-center bg-gray-500 border-gray-600 border rounded avatar">{{$content->author->avatar}}</div></a>
                <!--a href="#" class="mr-2"><img class="w-12 rounded" src="{{$content->author->avatar}}" alt=""></a-->
                <a href="#" class="text-gray-500 hover:text-gray-700 font-semibold">{{$content->author->username}}</a>
                <div class="flex-auto text-right ml-2">
                    @can('update', $content)
                    <a href="#" class="mr-2 text-xs text-gray-500 hover:underline">Düzenle</a>
                    @endcan
                    @can('delete', $content)
                        <form class="inline" action="{{$delete_route}}" method="POST" onsubmit="return confirm('Bu içeriği silmek istediğinizden emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mr-2 text-xs text-gray-500 hover:underline">Sil</button>
                        </form>
                    @endcan
                    <a class=" post-permalink text-xs text-gray-500 hover:underline" href="{{route('topics.permalink', ['pid'=>$topic->identifier])}}#c-{{$content->identifier}}">
                        <i class="fi fi-rr-link"></i> <time datetime="{{$content->updated_at->timestamp}}">{{$content->updated_at->diffForHumans()}}</time>
                    </a>
                </div>
            </div>
            <div class="body text-gray-700">
                {!! $content->body !!}
            </div>
        </div>
    </div>
</div>
