@extends('layout')

@section('content')
<div class="w-auto mt-10 mb-10 mx-4 sm:mx-auto sm:max-w-lg lg:max-w-2xl">
    <h3 class="text-center text-2xl font-bold text-gray-600">Bir tartışma başlatın</h3>
    <div class="relative flex items-center justify-center bg-white border rounded mt-8 p-4">
        <form action="{{route('topics.store')}}" method="post">
            @csrf
            <div class="flex flex-wrap">
                <div class="w-full mb-2">
                    <label>
                        <input name="title" type="text" value="{{old('title')}}" autocomplete="off" class="bg-gray-100 rounded border border-gray-300 leading-normal w-full p-2 text-gray-700  placeholder-gray-500 focus:outline-none focus:bg-white" placeholder="Başlık"/>
                    </label>
                    <p class="text-red-500">{{ $errors->first('title') }}</p>
                </div>
                <div class="w-full mb-2">
                    <label>
                        <input name="link" type="text" value="{{old('link')}}" autocomplete="off" class="bg-gray-100 rounded border border-gray-300 leading-normal w-full p-2 text-gray-700  placeholder-gray-500 focus:outline-none focus:bg-white" placeholder="Bağlantı - Link"/>
                    </label>
                    <p class="text-red-500">{{ $errors->first('link') }}</p>
                </div>
                <div class="w-full mb-2">
                    <label>
                        <textarea class="editor bg-gray-100 rounded border border-gray-300 leading-normal w-full h-40 p-2 text-gray-700  placeholder-gray-500 focus:outline-none focus:bg-white" name="body" placeholder="Konu ile alakalı insanları bilgilendirin.">{{old('body')}}</textarea>
                    </label>
                    <p class="text-red-500">{{ $errors->first('body') }}</p>
                </div>
                <div class="w-full flex items-center">
                    <div class="flex items-start text-gray-700 mr-auto">
                        <svg fill="none" class="w-5 h-5 text-gray-600 mr-1" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs md:text-sm pt-px">Paylaşım yapmadan önce <a href="#" class="underline">içerik sözleşmesi</a> ve <a href="#" class="underline">kullanım koşullarına</a> göz atın</a>.</p>
                    </div>
                    <button type='submit' class="text-sm bg-gray-50 text-gray-700 font-medium py-1 px-3 cursor-pointer border border-gray-400 rounded tracking-wide hover:bg-gray-100 outline-none focus:outline-none hover:border-gray-500">Gönder</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
