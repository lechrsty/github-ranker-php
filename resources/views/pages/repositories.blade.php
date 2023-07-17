@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Stars</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($repositories as $repository)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $repository->name }}</td>
                <td>{{ $repository->stars }}</td>
                <td>
                    <a href="{{ route('repositories.details', ['id' => $repository->id]) }}" class="btn btn-info text-light">View Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection