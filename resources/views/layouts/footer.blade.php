<footer class="@if(auth()) text-neutral-500 bg-neutral-900 @else text-slate-500 bg-slate-900 @endif
               w-full flex flex-row gap-8 py-12 text-sm">
    <div class="h-full w-1/4 ml-4 text-left">
        <p>
            &copy; Copyright 2023 Adrian Gould
        </p>
    </div>
    <div class="h-full flex-grow text-center">
        <!-- middle section content-->
    </div>
    <div class="h-full w-1/4 mr-4 contents-right flex flex-row gap-8 text-sm">
        <a href="{{route('home')}}" class="hover:text-gray-200 transition duration-500">Home</a>
        <a href="{{route('about')}}" class="hover:text-gray-200 transition duration-500">About</a>
    </div>
</footer>
