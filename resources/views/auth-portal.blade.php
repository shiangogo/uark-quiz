@extends('layouts.default')
@section('main')
<h1>Auth Page</h1>
<auth-portal :auth-option="{{ $authOption }}"></auth-portal>
@endsection
