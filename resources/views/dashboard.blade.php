{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">Available Shows</h3>
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Movie</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shows as $show)
                        <tr>
                            <td class="border px-4 py-2">{{ $show->movie_name }}</td>
                            <td class="border px-4 py-2">{{ $show->show_date }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($show->show_time)->format('h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">No shows available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout> --}}


@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🎬 Shows</h2>
    <div class="row">
        @foreach($shows as $show)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>{{ $show->show_date }} @ {{ $show->show_time }}</h5>
                        <a href="{{ route('dashboard.show', $show->id) }}" class="btn btn-primary mt-3">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
