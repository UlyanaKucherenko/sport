@extends('layouts.app')

@section('content')

    <dashboard-page
            :total-books="{{ $totalBooks }}"
            :available-books="{{ $availableBooks }}"
            expiration-data="{{ $expiration_data }}"
            locale="{{ $locale }}"
            :recent-books="{{ $recentBooks }}"
            :top-book="{{ $topBook }}"
            :plan-texts="{{ $planTexts }}"
            :plans="{{ $plans }}"
            :user="{{ $user }}"
    ></dashboard-page>

@endsection