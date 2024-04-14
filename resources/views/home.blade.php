@extends('layouts.default')

@section('main')
    <h1>首頁</h1>
    <h2>姓名：{{ $user->name }}</h2>
    <h2>帳號：{{ $user->account }}</h2>
    <h2>Email：{{ $user->email }}</h2>

    @if ($user->status === 'pending')
        <p>此帳號待審核開通</p>
    @endif

    <form method="POST" action="{{ url('/sessions') }}" class="inline-block">
        @method('DELETE')
        @csrf
        <button class="btn btn-red" type="submit">登出</button>
    </form>

@endsection
