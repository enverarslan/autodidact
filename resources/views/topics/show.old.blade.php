@extends('layout')

@section('content')
    <div class="w-auto mt-20 mb-10 mx-4 sm:mx-auto sm:max-w-lg lg:max-w-2xl">
        <div class="topic">
            <div class="header px-5 pb-6 relative">
                <div class="meta flex">
                    <div class="flex-none w-16 h-16">
                        <div class="flex items-center justify-center rounded-full h-full border bg-white text-center">
                            <span class="inline-block align-middle"><i class="fi fi-rr-comment text-gray-500 text-2xl"></i></span>
                        </div>
                    </div>
                    <h2 class="text-gray-600 ml-4 mb-8">"Inside Obama's Presidency" -- The First Term</h2>
                </div>
                <div class="description flex">
                    <div class="flex-none w-16">
                        <a href="#"><img class="w-full max-w-full rounded" src="avatar.png" alt=""></a>
                    </div>
                    <div class="ml-4 text-lg text-gray-600">
                        <p>
                            As Barack Obama is sworn in for his second term, FRONTLINE takes a probing look at the first four years of his presidency.
                            <a href="#">pbs.org →</a>
                        </p>
                    </div>
                </div>

                <div class="progress"></div>

            </div>
            <div class="posts bg-white  shadow-sm border  rounded">
                @include('topics/post')
                @include('topics/post')
                @include('topics/post')
                @include('topics/post')
                @include('topics/post')
                @include('topics/post')
                @include('topics/post')
            </div>
            @include('topics/editor')
        </div>
    </div>

@stop
