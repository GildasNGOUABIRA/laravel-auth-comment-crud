<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My comments') }}
        </h2>
    </x-slot>

    <div class="container">
        @if (session('success_message'))

        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>

        @endif
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">PHP Laravel Project - Comment</h1>
                <div class="text-left"><a href="/comment" class="btn btn-outline-primary">Comment List</a></div>

                <form id="edit-frm" method="POST" action="{{ route('comment.update', $comment) }}" class="border p-3 mt-2">
                    @method('PUT')
                    @csrf
                    <div class="control-group col-6 mt-2 text-left">
                        <label for="body">Description</label>
                        <div>
                            <textarea id="description" class="form-control mb-4" name="description" placeholder="Enter description" rows=""
                                required>{!! $comment->description !!}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    @method('PUT')
                    <div class="control-group col-6 text-left mt-2"><button class="btn btn-primary">Save Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @include('sweetalert::alert') --}}

</x-app-layout>
