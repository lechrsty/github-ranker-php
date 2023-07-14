<h1><strong><a href="{{ $repository->url }}">{{ $repository->name }}</a></strong></h1>

    <div>
        <strong>Description:</strong> {{ $repository->description }}
    </div>

    <div>
        <strong>Created Date:</strong> {{ $repository->created_date }}
    </div>

    <div>
        <strong>Last Push Date:</strong> {{ $repository->last_push_date }}
    </div>

    <div>
        <strong>Stars:</strong> {{ $repository->stars }}
    </div>
