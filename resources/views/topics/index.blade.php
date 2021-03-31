@extends('layout')

@section('content')
    <div class="mt-3 mb-2 w-auto mx-4 sm:mx-auto sm:max-w-lg lg:max-w-5xl grid grid-cols-4">
        <div class="col-span-3">
            <h3 class="text-center text-2xl font-bold text-gray-600 mb-4">Neler Konuşuluyor?</h3>
            <div class="border bg-white rounded shadow-md">
                @foreach($topics as $topic)
                    <div class="px-4 py-2 @if (!$loop->last) border-b @endif">
                        @if($topic->link)
                            <a href="{{$topic->link}}" target="_blank" rel="nofollow noopener" class="text-gray-700 hover:text-gray-800 text-lg  font-semibold">{{$topic->title}}</a>
                        @else
                            <a href="{{$topic->topic_self_url}}" class="text-gray-700 hover:text-gray-800 text-lg font-semibold">{{$topic->title}}</a>
                        @endif
                        @if($topic->host) <span class="text-xs text-gray-500"><a href="{{route('topics.site', ['host'=>$topic->host])}}">({{$topic->host}})</a></span> @endif
                        <p class="text-xs text-gray-500">{{$topic->last_comment_at->diffForHumans()}} &middot; {{$topic->author->username}} &middot; <a href="{{$topic->topic_self_url}}">{{$topic->comments_count}} yorum</a></p>
                    </div>
                @endforeach
            </div>
            <div class="my-4">
                {{$topics->onEachSide(1)->links()}}
            </div>
        </div>
        <div class="side col-span-1 ml-8 mt-12">
            <div class="bg-white border rounded shadow-md">
                <h3 class="font-bold text-white border-b bg-blue-600 py-2 px-4 rounded-t rounded-tr">Kanallar</h3>
                <ul class="font-semibold text-gray-600">
                    <li><a class="border-b block py-2 px-4 hover:bg-gray-100" href="#">Spor</a></li>
                    <li><a class="border-b block py-2 px-4 hover:bg-gray-100" href="#">Sanat</a></li>
                    <li><a class="border-b block py-2 px-4 hover:bg-gray-100" href="#">Ekonomi</a></li>
                    <li><a class="border-b block py-2 px-4 hover:bg-gray-100" href="#">Siyaset</a></li>
                    <li><a class="border-b block py-2 px-4 hover:bg-gray-100" href="#">Teknoloji</a></li>
                    <li><a class="block py-2 px-4 hover:bg-gray-100" href="#">Programlama</a></li>
                </ul>
            </div>
        </div>
    </div>
@stop
