<div class="row">
    <div class="col-sm-9 mr-auto">
        <h1>{{ $count ?? "" }} 質問{{ $title ?? "" }}</h1>
    </div>
    @can('create', \App\Question::class)
    <div class="col-sm-3 text-right">
        <a href="{{ action('QuestionsController@create') }}" class="btn btn-primary">質問を聞く</a>
    </div>
    @endcan
</div>
<hr>
