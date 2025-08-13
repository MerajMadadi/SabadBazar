@extends('layouts.app')

@section('title', 'ارسال تیکت جدید')
<style>
    .rt-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .rt-input:focus {
        border-color: #69982D;
        outline: none;
    }

    .text-danger {
        color: red;
        margin-top: 5px;
    }
</style>
@section('content')
    <section class="products rt-relative rt-overflow rt"  style="border-radius: 20px;margin-top: 10px">
        <div class="main">
            <h3 id="ticket-title-create" class="title-asli rt rt-bold rt-333 rt-relative rt-23 rt-align">ارسال تیکت جدید</h3>

            <form action="{{route('ticket.store')}}" method="POST" onsubmit="this.querySelector('button').disabled = true;"
                  class="rt rt-10px rt-bg rt-shadow rt-15px rt-relative rt-overflow" style="padding: 20px;">
                @csrf
                <div class="form-group rt rt-align-right rt-10px">
                    <label for="subject" class="rt rt-15 rt-bold rt-333">موضوع تیکت:</label>
                    <input type="text" name="subject" id="subject" class="rt-input rt rt-15 rt-8px rt-333"
                           value="{{ old('subject') }}" required>
                    @error('subject')
                    <div class="text-danger rt-12">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group rt rt-align-right rt-10px">
                    <label for="message" class="rt rt-15 rt-bold rt-333">متن پیام:</label>
                    <textarea name="message" id="message" rows="5" class="rt-input rt rt-15 rt-8px rt-333"
                              required>{{ old('message') }}</textarea>
                    @error('message')
                    <div class="text-danger rt-12">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group rt rt-align">
                    <button type="submit" class="rt-all rt-color rt-bold rt-fff rt-15 rt-8px"
                            style="background: #69982D;border: none">
                        ارسال تیکت
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
