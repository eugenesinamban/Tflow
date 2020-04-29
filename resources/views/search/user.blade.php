<div class="col-sm-4 mr-auto mb-2">
    <div class="card" style="width: 11rem;">
        <img class="card-img-top" src="/storage/{{ $result->searchable->profile->profile_image }}" alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title"><a href="{{ $result->url }}">{{ $result->searchable->username }}</a></h4>
            <h6 class="card-subtitle">About {{ $result->searchable->username }}:</h6>
            <p class="card-text">{{ $result->searchable->profile->about_myself }}</p>
        </div>
    </div>
</div>
