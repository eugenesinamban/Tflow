<div class="row">
    <div class="col-sm-9 mr-auto">
        <h1>{{ $count ?? "" }} Questions{{ $title ?? "" }}</h1>
    </div>
    @can('create', \App\Question::class)
    <div class="col-sm-3 text-right">
        <a href="{{ action('QuestionsController@create') }}" class="btn btn-primary">Add Question</a>
    </div>
    @endcan
</div>
<hr>
