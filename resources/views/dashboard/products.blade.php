@extends('dashboard.layout.app' , ['title' => 'Products'])

@section('content')
    <div class="info-box">

        <h1>
            products page
        </h1>
    </div>
@endsection


@section('breadcrump')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection
