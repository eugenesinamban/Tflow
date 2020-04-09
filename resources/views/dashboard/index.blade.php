@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4 class="mt-2">Go ahead and ask away!</h4>
                        </div>
                        <div class="col text-right">
                            <a href="/questions/create" class="btn btn-primary">Ask some question!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
