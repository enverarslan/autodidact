<nav class="bg-white border-b fixed w-full z-10">
    <div class="container mx-auto sm:max-w-lg lg:max-w-5xl">
        <div class="py-2 px-4 sm:px-0">
            <div class="flex items-center justify-center justify-between  grid grid-cols-4">
                <div class="flex space-x-10 col-span-1">
                    <a href="/" class="link lg:w-20 text-gray-500">
                        <span><i class="fi-rr-line-width text-2xl"></i></span>
                    </a>
                </div>
                <div class="flex items-center justify-center col-span-2">
                    <form action="{{route('topics.search')}}" class="flex w-full" method="get">
                        <input type="text" name="q" placeholder="Search" class="border py-2 px-4 outline-none w-5/6">
                        <button type="submit" class="p-2 bg-gray-100 border border-l-0 outline-none focus:outline-none w-1/6"><i class="fi fi-rr-search"></i></button>
                    </form>
                </div>
                <div class="flex col-span-1 justify-end">
                    @auth
                        <a href="{{route('topics.create')}}"  class="py-1 px-4 text-white rounded-2xl bg-green-600 border-green-700 border font-semibold">
                            <span><i class="fi fi-rr-plus"></i> Yeni</span>
                        </a>
                        <a href=""  class="py-1 px-4 text-gray-500">
                            <span>{{auth()->user()->username}}</span>
                        </a>
                        <a href="{{route('auth.logout')}}"  class="py-1 px-4 text-gray-500">
                            <span>Çıkış</span>
                        </a>
                    @endauth
                    @guest
                        <a href="{{route('auth.register')}}"  class="text-sm py-1 px-4 text-gray-500">
                            <span>Kayıt</span>
                        </a>
                        <a href="{{route('auth.login')}}"  class="text-sm py-1 px-4 text-gray-500">
                            <span>Giriş</span>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

</nav>
