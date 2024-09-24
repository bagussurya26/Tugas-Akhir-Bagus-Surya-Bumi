@extends('cork.cork')

@section('title', 'Log Aktivitas')

@section('css')
<link href="{{ asset('assets/src/assets/css/light/pages/faq.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/src/assets/css/dark/pages/faq.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('konten')
@include('sweetalert::alert')

<div class="faq">

    <div class="faq-layouting layout-spacing">

        <div class="fq-tab-section">
            <div class="row">
                <div class="col-md-12">

                    <h2>Log <span>Aktivitas</span></h2>

                    <div class="row">

                        <div class="col-lg-12">
                            @foreach ($activities as $key => $activity)
                            @if ($activity->event == 'login' || $activity->event == 'logout')
                            <div class="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="mb-0 row d-flex align-items-center">
                                            <div class="col-8">
                                                <span class="faq-q-title">
                                                    <span style="font-size: 1.1em">
                                                        {{ $activity->causer_type }} {{ $activity->description }}
                                                    </span>
                                                    <small class="text-muted d-block">{{
                                                        $activity->created_at->isToday() ? 'Today at ' .
                                                        $activity->created_at->format('g:i A') :
                                                        $activity->created_at->format('d-m-Y g:i A') }}
                                                    </small>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="accordion" id="simple_faq-{{ $key }}">
                                <div class="card">
                                    <div class="card-header" id="fqheading-{{ $key }}">
                                        <div class="mb-0 row d-flex align-items-center" data-bs-toggle="collapse"
                                            role="navigation" data-bs-target="#fqcollapse-{{ $key }}"
                                            aria-expanded="false" aria-controls="fqcollapse-{{ $key }}">
                                            <div class="col-8">
                                                <span class="faq-q-title">
                                                    <span style="font-size: 1.1em">
                                                        {{ $activity->causer_type }} {{ $activity->description }}
                                                    </span>
                                                    <small class="text-muted d-block">{{
                                                        $activity->created_at->isToday() ? 'Today at ' .
                                                        $activity->created_at->format('g:i A') :
                                                        $activity->created_at->format('d-m-Y g:i A') }}
                                                    </small>
                                                </span>
                                            </div>
                                            <div class="col-4 icons text-end">
                                                <i data-feather="chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="fqcollapse-{{ $key }}" class="collapse"
                                        aria-labelledby="fqheading-{{ $key }}" data-bs-parent="#simple_faq-{{ $key }}">
                                        <div class="card-body">
                                            @if ($activity->event == 'created')
                                            <ul class="list-group">
                                                @if (isset($activity->properties['attributes']))
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
                                                @foreach ($activity->properties as $item)
                                                <li class="list-group-item">
                                                    @if ($item != " " || $item != null)
                                                    {{ $item }}
                                                    @else
                                                    Tidak Ada
                                                    @endif
                                                </li>
                                                @endforeach
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
                                            @elseif ($activity->event == 'updated')
                                            <ul class="list-group">

                                                @if (isset($activity->properties['old'])
                                                && isset($activity->properties['attributes']))
                                                @foreach ($activity->properties['old'] as $key=>$oldValue)

                                                @if ($oldValue == "" && $activity->properties['attributes'][$key] != "")
                                                <li class="list-group-item">Menambah data {{ $key }} : <strong>{{
                                                        $activity->properties['attributes'][$key] }}</strong></li>

                                                @elseif ($oldValue != $activity->properties['attributes'][$key])
                                                <li class="list-group-item">Memperbarui {{ $key }} dari <strong>{{
                                                        $oldValue
                                                        }}</strong> menjadi <strong>{{
                                                        $activity->properties['attributes'][$key]
                                                        }}</strong></li>
                                                @endif
                                                @endforeach
                                                @else
                                                @foreach ($activity->properties as $value)
                                                <li class="list-group-item">{{ $value }}</li>
                                                @endforeach
                                                @endif
                                            </ul>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('js')
<script src="{{ asset('assets/src/assets/js/pages/faq.js') }}"></script>
@endsection