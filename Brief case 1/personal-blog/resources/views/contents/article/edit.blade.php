<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('article.update', $data->id) }}" class="space-y-6" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <div>
                            <x-input-label for="title" :value="__('Judul')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $data->title)" required autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="cover" :value="__('Cover')" />
                            <input type="hidden" name="oldCover" value="{{ $data->cover }}">
                            <img src="{{ asset('storage/'.$data->cover) }}" class="img-preview max-w-xs">
                            <x-text-input id="cover" name="cover" type="file" class="mt-1 block w-full" :value="old('cover')" autocomplete="cover" onchange="previewImage()" accept="image/*" />
                            <x-input-error class="mt-2" :messages="$errors->get('cover')" />
                        </div>
                        <div>
                            <x-input-label for="category" :value="__('Kategori')" />
                            <select name="category" id="category" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach ($category as $key => $val)
                                    <option value="{{ $key }}" {{ $key == $data->category_id ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
                        </div>
                        <div>
                            <x-input-label for="tag" :value="__('Tag')" />
                            <select name="tag[]" id="tag" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" multiple required>
                                @foreach ($tag as $key => $val)
                                    <option value="{{ $key }}" {{ $key == $data->tag[$key] ? 'selected' : '' }}>{{ $val }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('tag')" />
                        </div>
                        <div>
                            <x-input-label for="content" :value="__('Konten')" />
                            <input id="content" type="hidden" name="content" value="{{ old('content', $data->content) }}" />
                            <trix-editor input="content"></trix-editor>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>
                        <div class="flex items-center justify-end gap-4">
                            @if (session('status') === 'article-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                            <a href="{{ route('article.index') }}">
                                <x-danger-button :type="__('button')">Batal</x-danger-button>
                            </a>
                            <x-success-button>Simpan</x-success-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
