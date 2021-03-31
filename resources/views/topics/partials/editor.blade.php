<!-- comment form -->
<div class="bg-white border rounded mt-8 p-4">
    <form method="post" action="{{route('topics.comment', ['pid'=>$topic->identifier])}}" id="comment">
        @csrf
        <div class="flex flex-wrap">
            <h2 class="flex items-center font-bold text-gray-600"><i class="text-2xl fi fi-rr-comment mr-2"></i> Katkıda bulunun</h2>
            <div class="w-full mb-2 mt-2">
                <textarea class="editor bg-gray-100 rounded border border-gray-300 leading-normal w-full h-20 p-2 text-gray-700  placeholder-gray-500 focus:outline-none focus:bg-white" name="body" placeholder='"{{$topic->title}}" hakkında bilgi verin.'>{{old('body')}}</textarea>
                <p class="text-red-500">{{ $errors->first('body') }}</p>
            </div>
            <div class="w-full flex justify-end">
                <input type='submit' class="text-sm bg-gray-50 text-gray-700 font-medium py-1 px-3 cursor-pointer border border-gray-400 rounded tracking-wide hover:bg-gray-100 outline-none hover:border-gray-500" value='Gönder'>
            </div>
        </div>
    </form>
</div>
