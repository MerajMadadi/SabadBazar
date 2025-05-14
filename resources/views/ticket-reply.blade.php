@extends('layouts.app')
@section('title', 'مشاهده تیکت')

@section('content')
    <div class="container" style="margin-bottom: 10px;">
        <h2>مشاهده تیکت</h2>
        <hr>

        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 16px; font-weight: bold;">
                عنوان: {{ $ticket->subject }}
            </div>
            <div class="panel-body">
                <p><strong>کاربر:</strong> {{ $ticket->users->name ?? 'کاربر ناشناس' }}</p>
                <p><strong>وضعیت:</strong>
                    @if($ticket->status === 'در انتظار')
                        <span class="label label-success">باز</span>
                    @elseif($ticket->status === 'پاسخ داده شده')
                        <span class="label label-warning">پاسخ داده شده</span>
                    @else
                        <span class="label label-default">بسته</span>
                    @endif
                </p>
                <p><strong>توضیحات اولیه:</strong></p>
                <div class="well">
                    {!! nl2br(e($ticket->message)) !!}
                </div>
                @php
                    $reply_to_ticket = \App\Models\TicketReply::where('ticket_id',$ticket->id)->first();
                @endphp
                @if(!empty($reply_to_ticket))
                    <form style="width: 10%" action="{{route('ticket.close',$ticket->id)}}" method="post">
                        <p>
                            @csrf
                            <button class="btn btn-primary btn-block">بستن تیکت</button>
                        </p>
                    </form>
                @endif
                <form style="width: 10%" action="{{route('ticket.destroy', $ticket->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <p>
                        <button class="btn btn-danger btn-block">حذف تیکت</button>
                    </p>
                </form>
            </div>
        </div>

        @if($ticket->ticket_replies && $ticket->ticket_replies->count())
            <h4 style="margin-top: 30px;">پاسخ‌ها</h4>
            @foreach($ticket->ticket_replies as $reply)
                <div class="panel {{ $reply->user_id === null ? 'panel-info' : 'panel-default' }}">
                    <div class="panel-heading">
                        <strong>پشتیبانی</strong>
                        <span class="pull-left">{{$reply->created_at_jalali}}</span>
                    </div>
                    <div class="panel-body">
                        {!! nl2br(e($reply->message)) !!}
                    </div>
                </div>
            @endforeach
        @endif

        @if($ticket->status !== 'بسته شده')
            @if(!$ticket->ticket_replies->count())
                <h4 style="margin-top: 20px;">ارسال پاسخ</h4>
                <form action="{{ route('reply.ticket', $ticket->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="message">پاسخ شما:</label>
                        <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">ارسال پاسخ</button>
                </form>
            @endif
        @else
            <div class="alert alert-warning" style="margin-top: 30px;">
                این تیکت بسته شده است و امکان پاسخ‌گویی وجود ندارد.
            </div>
        @endif
    </div>
@endsection
