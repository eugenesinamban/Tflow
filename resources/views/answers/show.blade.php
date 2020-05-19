<h3 class="mt-4">{{ count($answers) . (count($answers) > 1 || count($answers) == 0 ? ' Answers' : ' Answer')}}</h3>
@foreach($answers as $answer)
    <div class="card mb-2">
        <div class="card-body">
            <p class="card-text">
                {{{$answer->answer}}}
            </p>
        </div>
        <div class="card-footer">
            <div class="row ">
                <div class="col-sm-7">
                    <small>質問者 <a href="/profile/{{ $answer->user->username }}">{{ $answer->user->username }}</a> 作成日時 {{ $answer->created_at }}</small>
                </div>

                @if($answer->user->id === auth()->user()->id)
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <a href="{{ action('AnswersController@edit', $answer->id) }}" class="btn btn-sm btn-link card-link">回答編集</a>
                        </div>
                        <div class="col">
                            <form action="{{ action('AnswersController@destroy', $answer->id) }}" method="post" class="w-50">
                                @csrf
                                @method('DELETE')

                                <input type="submit" value="Delete Answer" class="text-danger card-link btn btn-link btn-sm">
                            </form>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
@endforeach
