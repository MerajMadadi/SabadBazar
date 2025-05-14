@extends('layouts.app')

@section('title', 'تیکت‌های من')

@section('content')
    <div class="panel panel-default rt rt-overflow" style="margin-top: 20px">
        <div class="panel-heading" style="height: 1cm">
            <h3 class="panel-title rt rt-bold rt-20 rt-align">تیکت‌های من</h3>
        </div>

        <div class="panel-body">
            @if($tickets->count() > 0)
                <table class="table table-striped table-bordered rt rt-14">
                    <thead>
                    <tr>
                        <th>موضوع</th>
                        <th>وضعیت</th>
                        <th>تاریخ ارسال</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->subject }}</td>
                            <td>
                                @if($ticket->status === 'در انتظار')
                                    <span class="label label-success">باز</span>
                                @elseif($ticket->status === 'پاسخ داده شده')
                                    <span class="label label-warning">پاسخ داده شده</span>
                                @else
                                    <span class="label label-default">بسته</span>
                                @endif
                            </td>
                            <td>{{$ticket->created_at_jalali }}</td>
                            <td>
                                <a href="{{ route('ticket.show', $ticket->id) }}"
                                   class="btn btn-primary btn-sm">مشاهده</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{-- صفحه‌بندی --}}
                <div class="rt rt-align">
                    {{ $tickets->links() }}
                </div>
            @else
                <p class="text-center rt rt-16">شما هنوز تیکتی ثبت نکرده‌اید.</p>
            @endif
        </div>
    </div>
@endsection
