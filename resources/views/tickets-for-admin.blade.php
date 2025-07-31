@extends('layouts.admin')
@section('title', 'مدیریت تیکت‌ها')

@section('content')

        @if($tickets->count())
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead style="background: #f4f4f4;">
                    <tr>
                        <th>عنوان</th>
                        <th>کاربر</th>
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->subject }}</td>
                            <td>{{ $ticket->users->email ?? 'ناشناخته' }}</td>
                            <td>
                                @if($ticket->status === 'در انتظار')
                                    <span class="label label-success">باز</span>
                                @elseif($ticket->status === 'پاسخ داده شده')
                                    <span class="label label-warning">پاسخ داده شده</span>
                                @else
                                    <span class="label label-default">بسته</span>
                                @endif
                            </td>
                            <td>{{ $ticket->created_at_jalali }}</td>
                            <td>
                                <a href="{{route('ticket.show.reply',$ticket)}}" class="btn btn-info btn-sm">
                                    مشاهده
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="alert alert-info">هیچ تیکتی ثبت نشده است.</div>
        @endif
@endsection
