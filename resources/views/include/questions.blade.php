@foreach($questions as $question)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-text">
                <a href="{{ "/questions/" . $question->id }}" class="card-link">{{ $question['question_title'] }}</a>
            </h5>
        </div>
        <div class="card-footer">
            <h6 class="card-subtitle">
                Created by <a href="/profile/{{$question->user->username}}">{{ $question->user['username'] }}</a> | Created at {{ $question['created_at'] }}
            </h6>
        </div>
    </div>
@endforeach
{{ $questions->links() }}
