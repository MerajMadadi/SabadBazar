@extends('layouts.app')

@section('title', 'تیکت‌های من')

@section('content')
    <div class="ticket-wrapper">
        <div class="panel panel-default ticket-panel">
            <!-- هدر -->
            <div class="panel-heading clearfix ticket-header">
                <h3 class="panel-title ticket-title">تیکت‌های من</h3>
                <a href="/ticket" class="btn btn-success ticket-create-btn">
                    + ثبت تیکت جدید
                </a>
            </div>

            <!-- بدنه -->
            <div class="panel-body ticket-body">
                @if($tickets->count() > 0)
                    <div class="table-responsive">
                        <table id="tickets-table" class="table table-striped table-bordered ticket-table">
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
                                <tr class="ticket-row">
                                    <td data-label="موضوع">{{ $ticket->subject }}</td>
                                    <td data-label="وضعیت">
                                        @if($ticket->status === 'در انتظار')
                                            <span class="label label-success">باز</span>
                                        @elseif($ticket->status === 'پاسخ داده شده')
                                            <span class="label label-warning">پاسخ داده شده</span>
                                        @else
                                            <span class="label label-default">بسته</span>
                                        @endif
                                    </td>
                                    <td data-label="تاریخ ارسال">{{ $ticket->created_at_jalali }}</td>
                                    <td data-label="عملیات">
                                        <a href="{{ route('ticket.show', $ticket->id) }}"
                                           class="btn btn-primary btn-sm">مشاهده</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="ticket-pagination text-center">
                        {{ $tickets->links() }}
                    </div>
                @else
                    <p class="text-center ticket-empty-message">شما هنوز تیکتی ثبت نکرده‌اید.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
