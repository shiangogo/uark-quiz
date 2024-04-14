@extends('layouts.default')

@section('main')
    <h1 class="text-3xl font-bold mb-6">首頁</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="space-y-2">
            <h2 class="text-lg font-medium">姓名：{{ $user->name }}</h2>
            <h2 class="text-lg font-medium">帳號：{{ $user->account }}</h2>
            <h2 class="text-lg font-medium">Email：{{ $user->email }}</h2>
            <h2 class="text-lg font-medium">機關單位代碼：{{ $user->organization->org_no }}</h2>
            <h2 class="text-lg font-medium">機關單位名稱：{{ $user->organization->title }}</h2>
        </div>

        <div class="space-y-2">
            @if ($user->status === 'pending')
                <p class="text-red-600">此帳號待審核開通</p>
            @endif

            <form method="POST" action="{{ url('/sessions') }}" class="inline-block">
                @method('DELETE')
                @csrf
                <button class="bg-red-600 hover:bg-red-500 text-white font-bold py-2 px-4 rounded" type="submit">登出</button>
            </form>
        </div>
    </div>

@endsection
