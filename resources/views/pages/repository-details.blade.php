@extends('layouts.app')

@section('content')
    <div class="container">
    <h1 class="mt-2 mb-4">{{ $repository->name}}</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Description</th>
                <th scope="col">Created Date</th>
                <th scope="col">Last Push Date</th>
                <th scope="col">Stars</th>
                <th scope="col">Link</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $repository->description }}</td>
                <td>{{ $repository->created_date }}</td>
                <td>{{ $repository->last_push_date }}</td>
                <td>{{ $repository->stars }}</td>
                <td>
                    <a href="{{ $repository->url }}" class="btn btn-info text-light">Visit Repository</a>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
@endsection