@extends('layouts.app')

@section('content')
 @php
    function stringToColor($string) {
        $code = crc32($string);
        return sprintf('#%06X', $code & 0xFFFFFF);
    }

    $limitedShows = $shows->take(25); // Show only 25 items (5x5)
@endphp
<div class="container mx-auto mt-4">
    <div class="row mb-4">
        <div class="container mx-auto mt-4">
    <div class="row">
        @foreach($limitedShows as $index => $show)
            <div class="col-md-2 mb-4">
                <div class="card text-white" style="background-color: {{ stringToColor($show->title) }};">
                    
                    {{-- Circle with first letter of the title --}}
                    <div class="d-flex justify-content-center align-items-center" style="height: 180px; background: rgba(255,255,255,0.2);">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background-color: white; color: black; font-size: 36px; display: flex; align-items: center; justify-content: center;">
                            {{ strtoupper(substr($show->title, 0, 1)) }}
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">SHOW {{ $index + 1 }}</h5>
                     <h6 class="card-subtitle mb-2 text-light">
                        {{ optional($show->seats)->where('is_booked', false)->count() ?? 0 }} seats available
                    </h6>
                                                                    
                        <a href="{{ route('shows.book', $show->id) }}" class="btn btn-light mr-2">
                            <i class="fas fa-link"></i> Book now
                        </a>
                        {{-- <a href="{{ $show->github_url ?? '#' }}" class="btn btn-secondary">
                            <i class="fab fa-github"></i> Github
                        </a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

        {{-- @foreach($limitedShows as $index => $show)
            <div class="col-4 col-md-4 col-lg-3">
                <div class="card" style="background-color: {{ stringToColor($show->title) }}; color: white;">
                <div 
                    class="d-flex align-items-center justify-content-center" 
                    style="height: 180px; font-size: 6rem; font-weight: bold; background-color: rgba(0,0,0,0.2);"
                >
                    {{ strtoupper(substr($show->title, 0, 1)) }}
                </div>      
                @dd($show)              
                <div class="card-body">
                        <h5 class="card-title">{{ $show->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {{ \Carbon\Carbon::parse($show->show_date)->format('d M Y') }}
                        </h6>
                        <p class="card-text">{{ Str::limit($show->description ?? 'No description available.', 80) }}</p>
                        <a href="{{ route('shows.visit', $show->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-link"></i> Visit Site
                        </a>
                        <a href="{{ $show->github_url ?? '#' }}" class="btn btn-secondary">
                            <i class="fab fa-github"></i> Github
                        </a>
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>

</div>



@endsection

