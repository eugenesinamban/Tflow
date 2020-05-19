@foreach($questions as $question)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-text">
                <a href="{{ "/questions/" . $question->id }}" class="card-link">{{ $question['question_title'] }}</a>
            </h5>
        </div>
        <div class="card-footer">
            <h6 class="card-subtitle">
                質問者 <a href="/profile/{{$question->user->username}}">{{ $question->user['username'] }}</a> | 作成日時 {{ $question['created_at'] }}
            </h6>
        </div>
    </div>
@endforeach
{{ $questions->links() }}
