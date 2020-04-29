<div class="col-sm-4 mb-4">
    <div class="card">
        <a href="{{ action('QuestionsController@courseView', $result->title) }}"><img class="card-img-top" src="/storage/{{ $result->searchable->field->field_image }}" alt="Card image cap"></a>
        <div class="card-body">
            <p class="card-text">
                {{ $result->searchable->name }}
            </p>
        </div>
    </div>
</div>
