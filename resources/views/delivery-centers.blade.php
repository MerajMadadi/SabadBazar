@extends('layouts.admin')

@section('title', 'مراکز تحویل')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('center.create') }}" class="btn btn-success">افزودن مرکز تحویل جدید</a>
    </div>
    <div class="flexbox">
        <div class="row">
            @forelse($centers as $center)
                <div class="main position-relative">
                    <article class="mini-s right rt-10px rt-shadow rt-relative rt-overflow">
                        {{-- دکمه حذف --}}
                        <form action="{{ route('center.delete', $center->id) }}" method="POST"
                              onsubmit="this.querySelector('button').disabled = true;"
                              class="delete-btn-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>

                        <img data-src="{{ asset($center->image_url) }}" src="{{ asset('img/lazy.gif') }}"
                             alt="مرکز تحویل" class="pic rt owl-lazy">

                        <div class="inside rt-fff rt rt-10px rt-absolute">
                            <h2 class="name rt rt-15 rt-medium">{{ $center->name }}</h2>
                            <span class="info rt rt-13 rt-op">
                                          <i class="fa fa-phone"></i>{{ toPersianNumber($center->phone) }}
                                    </span>
                            <span class="info rt rt-13 rt-op">
                                           <i class="fa fa-map"></i>{{ toPersianNumber($center->address) }}
                                    </span>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center text-muted mt-5">
                    هیچ مرکز تحویلی یافت نشد.
                </div>
            @endforelse
        </div>
    </div>
@endsection
