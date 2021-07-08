@extends('layouts.app')


{{--{{dd($books)}}--}}
@section('content')
    <books-page
            :props_books_data="{{ $books }}"
            :total-books="{{ $totalBooks }}"
            :available-books="{{ $availableBooks }}"
            expiration-data="{{ $expiration_data }}"
            :recent-books="{{ $recentBooks }}"
            :routes="{{ $routes }}"
            :plan="{{ $plan }}"
            locale="{{ $locale }}"
            download-errors="{{ $errors }}"
{{--            :plans="{{ $plans }}"--}}
{{--            :plan-texts="{{ $planTexts }}"--}}
    ></books-page>

@endsection
