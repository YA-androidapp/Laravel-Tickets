@extends('layouts.app')

@section('template_title')
    {{ $ticket->name ?? 'Show Ticket' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Ticket</span>
                        </div>
                        <div class="float-right">
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $ticket->name }}
                        </div>
                        <div class="form-group">
                            <strong>Uuid:</strong>
                            {{ $ticket->uuid }}
                        </div>
                        <div class="form-group">
                            <strong>Note:</strong>
                            {{ $ticket->note }}
                        </div>
                        <div class="form-group">
                            <img src="https://chart.apis.google.com/chart?chs=150x150&cht=qr&chl={{ $ticket->id }} {{ $ticket->uuid }}" alt="QRコード">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-info" onclick="printJS('https://chart.apis.google.com/chart?chs=150x150&cht=qr&chl={{ $ticket->id }} {{ $ticket->uuid }}', 'image')">発券</button>
                            <a class="btn btn-primary" href="{{ route('tickets.index') }}"> Back</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
