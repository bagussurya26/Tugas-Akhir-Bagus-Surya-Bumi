@extends('cork.cork')
@section('title', 'Log Aktivitas')
@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Activity Log
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        @forelse ($activities as $key => $activity)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $key }}" aria-expanded="true"
                                    aria-controls="collapse-{{ $key }}">
                                    {{ $activity->causer_type }} {{ $activity->description }}
                                    </span> <small class="text-muted ms-2 pb-1">({{
                                        $activity->created_at->isToday() ? 'Today at ' .
                                        $activity->created_at->format('g:i A') :
                                        $activity->created_at->format('d-m-Y g:i A') }})</small>
                                </button>
                            </h2>
                            <div id="collapse-{{ $key }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if ($activity->event == 'created')
                                    <ul class="list-group">
                                        @if ($activity->properties['attributes'] != null)
                                        @foreach ($activity->properties['attributes'] as $key=>$item)
                                        <li class="list-group-item">
                                            <strong>{{ $key }} :</strong>

                                            @if ($item != "")
                                            {{ $item }}
                                            @else
                                            Tidak Ada
                                            @endif
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="list-group-item">Tidak mengubah apapun</li>
                                        @endif
                                    </ul>
                                    @elseif($activity->event == 'deleted')
                                    <ul class="list-group">
                                        @foreach ($activity->properties['old'] as $key=>$item)
                                        <li class="list-group-item">
                                            <strong>{{ $key }} :</strong>

                                            @if ($item != "")

                                            {{ $item }}

                                            @else
                                            Tidak Ada
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <ul class="list-group">
                                        @if ($activity->properties['old'] != $activity->properties['attributes'])
                                        @foreach ($activity->properties['old'] as $key=>$oldValue)

                                        @if ($oldValue == "" && $activity->properties['attributes'][$key] != "")
                                        <li class="list-group-item">Menambah data {{ $key }} : <strong>{{
                                                $activity->properties['attributes'][$key] }}</strong></li>
                                        @elseif ($oldValue != $activity->properties['attributes'][$key])
                                        <li class="list-group-item">Mengubah {{ $key }} dari <strong>{{ $oldValue
                                                }}</strong> menjadi <strong>{{ $activity->properties['attributes'][$key]
                                                }}</strong></li>
                                        @endif
                                        
                                        @endforeach

                                        @elseif ($activity->properties['old'] == $activity->properties['attributes'])
                                            <li class="list-group-item">Tidak mengubah data apapun</li>
                                        @endif
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                No activity found.
                            </h2>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection