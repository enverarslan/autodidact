@extends('layout')

@section('content')
    <div class="w-auto mt-20 mb-10 mx-4 sm:mx-auto sm:max-w-sm">
        <h3 class="text-center text-2xl font-bold text-gray-600">Kayıt Olun</h3>
        <div class="relative flex items-center justify-center bg-white border rounded mt-8 p-4">
            <form action="{{route('auth.register_attempt')}}" method="post">
                @csrf
                <div class="flex flex-wrap">
                    <div class="w-full mb-2 mt-2">
                        <label>
                            <input name="email" type="email" value="{{old('email')}}" required class="bg-gray-100 rounded border border-gray-300 leading-normal w-full p-2 text-gray-700  placeholder-gray-500 focus:outline-none focus:bg-white" placeholder="E-posta Adresi"/>
                        </label>
                        <p class="text-red-500">{{ $errors->first('email') }}</p>
                    </div>
                    <div class="w-full mb-2 mt-2">
                        <label>
                            <input name="username" type="text" value="{{old('username')}}" required class="bg-gray-100 rounded border border-gray-300 leading-normal w-full p-2 text-gray-700  placeholder-gray-500 focus:outline-none focus:bg-white" placeholder="Kullanıcı adı"/>
                        </label>
                        <p class="text-red-500">{{ $errors->first('username') }}</p>
                    </div>
                    <div class="w-full mb-2 mt-2">
                        <label>
                            <input name="password" type="password" required class="bg-gray-100 rounded border border-gray-300 leading-normal w-full p-2 text-gray-700  placeholder-gray-500 focus:outline-none focus:bg-white" placeholder="Şifre"/>
                        </label>
                        <p class="text-red-500">{{ $errors->first('password') }}</p>
                    </div>
                    <div class="w-full mb-2 mt-2">
                        <label>
                            <input name="password_confirmation" type="password" required class="bg-gray-100 rounded border border-gray-300 leading-normal w-full p-2 text-gray-700  placeholder-gray-500 focus:outline-none focus:bg-white" placeholder="Şifre Tekrar"/>
                        </label>
                        <p class="text-red-500">{{ $errors->first('password_confirmation') }}</p>
                    </div>
                    <div class="w-full flex items-center">
                        <div class="text-gray-700 mr-auto">
                            <p><a href="{{route('auth.login')}}">Hesabınız mı var? Giriş yapın.</a></p>
                        </div>
                        <input type='submit' class="bg-gray-50 text-gray-700 font-medium py-1 px-3 cursor-pointer border border-gray-400 rounded tracking-wide hover:bg-gray-100 outline-none hover:border-gray-500" value='Kayıt Olun'>
                    </div>
                    <div class="w-full flex items-center">
                        <p class="text-red-500">{{ $errors->first('register') }}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
