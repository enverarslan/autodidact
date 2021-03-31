@extends('layout')

@section('content')
    <div class="w-auto my-4 mx-4 sm:mx-auto sm:max-w-lg lg:max-w-5xl grid grid-cols-4">
        <div class="topics col-span-1 mr-6 mt-12">
            <div class="h-8 flex justify-between items-center px-2">
                <h3 class="font-bold text-gray-600">Gündem</h3>
                <button class="refresh-button text-gray-500 focus:outline-none outline-none"><i class="fi fi-rr-refresh"></i></button>
            </div>
            <div class="topics-holder">@include('topics.composers.latest_topics_list')</div>

        </div>
        <div class="topic col-span-2">
            <div class="header pb-4 relative">
                <div class="meta flex">
                    <div class="flex-none w-16 h-16">
                        <div class="flex items-center justify-center rounded-full h-full border bg-white text-center">
                            <span class="inline-block align-middle"><i class="fi @if($topic->link) fi-rr-link @else fi-rr-comment-alt @endif text-gray-500 text-2xl"></i></span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <h2 class="text-gray-600 ml-2 mb-0">{{$topic->title}} @if($topic->link) <a href="{{$topic->link}}" target="_blank" rel="nofollow" class="noopener text-xs">({{$topic->host}}) 🠢</a> @endif</h2>
                    </div>
                </div>
                <!--div class="description flex">
                    <div class="flex-none w-16">
                        <a href="#"><img class="w-full max-w-full rounded" src="avatar.png" alt=""></a>
                    </div>
                    <div class="ml-4 text-lg text-gray-600">
                        <p>
                            As Barack Obama is sworn in for his second term, FRONTLINE takes a probing look at the first four years of his presidency.
                            <a href="#">pbs.org →</a>
                        </p>
                    </div>
                </div-->

                <div class="progress"></div>

            </div>
            <div class="posts bg-white break-words shadow-sm border  rounded">
                @if(empty(request('page')) || request('page') == 1)
                    @include('topics/partials/post', ['type'=>'topic', 'content'=>$topic, 'last'=> ($topic->comments_count === 0) ])
                @endif
                @foreach($comments as $comment)
                    @include('topics/partials/post', ['type'=>'comment', 'content'=>$comment, 'last'=> $loop->last])
                @endforeach
            </div>
            <div class="paginate mt-2">
                {{$comments->links()}}
            </div>

            @auth
                @include('topics/partials/editor')
            @endauth
        </div>
        <div class="side col-span-1 ml-6 mt-20">
            <div class="bg-white border rounded">
                <h3 class="font-bold text-gray-600 border-b bg-gray-100 py-2 px-4">Kanallar</h3>
                <ul class="font-semibold text-gray-600">
                    <li class="border-b py-2 px-4"><a href="#">Spor</a></li>
                    <li class="border-b py-2 px-4"><a href="#">Sanat</a></li>
                    <li class="border-b py-2 px-4"><a href="#">Ekonomi</a></li>
                    <li class="border-b py-2 px-4"><a href="#">Siyaset</a></li>
                    <li class="border-b py-2 px-4"><a href="#">Teknoloji</a></li>
                    <li class="py-2 px-4"><a href="#">Programlama</a></li>
                </ul>
            </div>
        </div>
    </div>

@stop
