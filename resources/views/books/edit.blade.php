<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-bold text-gray-700 text-lg mb-4">
                        {{ __("Edit Book") }}
                    </h3>

                    @if($errors->any())
                        <div class="bg-red-200 text-red-800 p-2 rounded border-red-800 mb-4">
                            <i class="fa fa-triangle-exclamation text-xl pl-2 pr-4"></i>
                            You have errors in your form submission.
                        </div>
                    @enderror

                        <form action="{{ route('books.update', compact(['book'])) }}"
                              class="flex flex-col gap-4"
                              method="post">

                            @csrf
                            @method('patch')

                            <div class="grid grid-cols-6 gap-1">
                                <label for="Title" class="">{{ __("Title") }}</label>
                                <input type="text"
                                       id="Title" name="title"
                                       value="{{ old("title") ?? $book->title }}"
                                       class="p-2 col-span-5">
                                @error('title')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="SubTitle" class="">{{ __("Sub Title") }}</label>
                                <input type="text"
                                       id="SubTitle" name="subtitle"
                                       value="{{ old("subtitle") ?? $book->subtitle }}"
                                       class="p-2 col-span-5">
                                @error('subtitle')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="YearPublish" class="">{{ __("Year Published") }}</label>
                                <input type="text"
                                       id="YearPublish" name="year_published"
                                       value="{{ old("year_published") ?? $book->year_published }}"
                                       class="p-2 col-span-5">
                                @error('year_published')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Edition" class="">{{ __("Edition") }}</label>
                                <input type="text"
                                       id="Edition" name="edition"
                                       value="{{ old("edition") ?? $book->edition }}"
                                       class="p-2 col-span-5">
                                @error('edition')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="ISBN10" class="">{{ __("ISBN 10") }}</label>
                                <input type="text"
                                       id="ISBN10" name="isbn_10"
                                       value="{{ old("isbn_10") ?? $book->isbn_10 }}"
                                       class="p-2 col-span-5">
                                @error('isbn_10')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="ISBN13" class="">{{ __("ISBN 13") }}</label>
                                <input type="text"
                                       id="ISBN13" name="isbn_13"
                                       value="{{ old("isbn_13") ?? $book->isbn_13 }}"
                                       class="p-2 col-span-5">
                                @error('isbn_13')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Genre" class="">{{ __("Genre") }}</label>
                                    <select class="form-control m-bot15" id="Genre" name="genre">
                                        @if ($genres->count() > 0)
                                            @foreach($genres as $genre)
                                                <option value="{{ $genre->name }}" @selected($book->genre == $genre->name)>
                                                    {{ $genre->name }}
                                                </option>
                                            @endForeach
                                        @else
                                            No Record Found
                                        @endif
                                    </select>
                                    @error('genre')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="SubGenre" class="">{{ __("Sub Genre") }}</label>
                                <select class="form-control m-bot15" id="SubGenre" name="sub_genre">
                                    @if ($genres->count() > 0)
                                        @foreach($genres as $genre)
                                            <option value="{{ $genre->name }}" @selected($book->sub_genre == $genre->name)>
                                                {{ $genre->name }}
                                            </option>
                                        @endForeach
                                    @else
                                        No Record Found
                                    @endif
                                </select>
                                @error('sub_genre')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-1">
                                <label for="Height" class="">{{ __("Height") }}</label>
                                <input type="text"
                                       id="Height" name="height"
                                       value="{{ old("height") ?? $book->height }}"
                                       class="p-2 col-span-5">
                                @error('height')
                                <span></span>
                                <p class="text-red-800 mb-2 text-sm col-span-5">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-6 gap-4">

                                <span></span>

                                <div class="mt-6 col-span-5 flex flex-row gap-4 -ml-2">
                                    <a href="{{ route('books.index') }}"
                                       class="py-2 px-4 mx-2 w-1/6 text-center
                                      rounded border border-stone-600
                                      hover:bg-stone-600
                                      text-stone-600 hover:text-white
                                      transition duration-500">
                                        <i class="fa fa-circle-left"></i> {{ __("Back") }}
                                    </a>

                                    <button type="submit"
                                            class="py-2 px-4 mx-2 w-1/6 text-center
                                       rounded border border-sky-600
                                       hover:bg-sky-600
                                       text-sky-600 hover:text-white
                                       transition duration-500">
                                        <i class="fa fa-floppy-disk"></i> {{ __("Save") }}
                                    </button>
                                </div>
                            </div>
                        </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
