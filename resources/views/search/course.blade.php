<div class="col-sm-4 mb-4">
    <a href="{{ action('QuestionsController@courseView', $result->title) }}">
    <div class="card">
        <img class="card-img-top" src="/storage/{{ $result->searchable->field->field_image }}" alt="Card image cap">
        <div class="card-body">
            <p class="card-link">
                {{ $result->searchable->name }}
            </p>
        </div>
    </div>
    </a>
</div>
