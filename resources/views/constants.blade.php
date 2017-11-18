@extends('master')

@section('title', 'Customers')

@section('content')
    <h3>Constants</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Field Name</th>
                <th>Field Value</th>
                <th>Action</th>

            </tr>
            @foreach($constants as $constant)
                <tr>
                    <td>{{ $constant->id }}</td>
                    <td>{{ $constant->variable }}</td>
                    <td>{{ $constant->value }} TK.</td>
                    <td><a href="#" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Edit</a></td>


                </tr>

            @endforeach


        </table>

    </div>

@endsection