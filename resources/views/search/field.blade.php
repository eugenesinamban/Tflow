<div class="col-sm-4 mb-4">
    <div class="card">
        <a href="{{ action('QuestionsController@fieldView', $result->title) }}"><img class="card-img-top" src="/storage/{{ $result->searchable->field_image }}" alt="Card image cap"></a>
        <div class="card-body">
            <p class="card-text">
                Number of users : {{ $result->searchable->users->count() }}
            </p>
        </div>
    </div>
</div>
