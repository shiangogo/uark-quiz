@extends('layouts.default')
@section('main')
<auth-portal :auth-option="{{ $authOption }}"></auth-portal>
@endsection
