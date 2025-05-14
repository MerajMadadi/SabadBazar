@extends('layouts.app')
@section('title',$ticket->subject)
@section('content')
    <section class="ticket-detail"
             style="max-width: 800px; margin: 2rem auto; padding: 1.5rem; background: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #69982D; margin-bottom: 1rem;">جزئیات تیکت</h2>

        <div style="margin-bottom: 1rem;">
            <strong>موضوع:</strong> {{ $ticket->subject }}
        </div>
        <div style="margin-bottom: 1rem;">
            <strong>وضعیت:</strong>
            @if ($ticket->status == 'در انتظار')
                <span
                    style="background: #facc15; color: #fff; padding: 4px 8px; border-radius: 4px;">در انتظار پاسخ</span>
            @elseif ($ticket->status == 'پاسخ داده شده')
                <span
                    style="background: #16a34a; color: #fff; padding: 4px 8px; border-radius: 4px;">پاسخ داده شده</span>
            @endif
        </div>

        <div style="margin-bottom: 1rem;">
            <strong>تاریخ ارسال:</strong> {{$ticket->created_at_jalali}}
        </div>
        <div style="margin-bottom: 1rem;">
            <strong>پیام:</strong>
            <div style="background: #fff; padding: 1rem; border-radius: 6px; margin-top: .5rem; line-height: 1.8;">
                {{ $ticket->message }}
            </div>
        </div>

        @if (!empty($ticket_replies))
            @foreach($ticket_replies as $ticket_reply)
                <div style="margin-top: 2rem;">
                    <strong>پاسخ:</strong>
                    <div
                        style="background: #e0f2fe; padding: 1rem; border-radius: 6px; margin-top: .5rem; line-height: 1.8;">
                        {{ $ticket_reply->message }}
                    </div>
                </div>
            @endforeach
        @endif
        <div style="margin-top: 2rem;">
            <a href="/my-tickets"
               style="background: #2563eb; color: #fff; padding: 8px 16px; border-radius: 6px; text-decoration: none;">بازگشت
                به لیست تیکت‌ها</a>
        </div>
    </section>
@endsection
