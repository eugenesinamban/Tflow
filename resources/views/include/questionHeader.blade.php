<div class="row">
    <div class="col-sm-9 mr-auto">
        <h1>{{ $questions->total() }} Questions{{ $title ?? "" }}</h1>
    </div>
    <div class="col-sm-3 text-right">
        <a href="{{ action('QuestionsController@create') }}" class="btn btn-primary">Add Question</a>
    </div>
</div>
<hr>
