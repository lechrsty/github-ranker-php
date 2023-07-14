<h1>Repositories</h1>

<form action="{{ route('repositories.refresh') }}" method="POST">
    @csrf
    <button type="submit">Refresh</button>
</form>

<ul>
    @foreach ($repositories as $repository)
        <li>
            <strong>Name:</strong> {{ $repository['name'] }}<br>
            <strong>Stars:</strong> {{ $repository->stars }}<br>
            <a href="{{ route('repositories.show', ['id' => $repository->id]) }}">View Details</a>
        </li>
    @endforeach
</ul>
