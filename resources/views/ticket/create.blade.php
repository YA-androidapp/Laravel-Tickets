@extends('layouts.app')

@section('template_title')
    Create Ticket
@endsection

@section('head')
    <script src="/js/faceapi/face-api.min.js"></script>
    <script src="/js/faceapi/fa.js"></script>
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Ticket</span>
                    </div>
                    <div class="card-body">
                        <video id="video" autoplay onloadedmetadata="onPlay()"></video>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tickets.store') }}"  role="form" enctype="multipart/form-data" id="form-create">
                            @csrf

                            @include('ticket.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
