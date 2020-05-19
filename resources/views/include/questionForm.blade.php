<div class="form-group">
    <input type="text" class="form-control @error('question_title') is-invalid @enderror" name="question_title" id="question_title" placeholder="質問タイトル" value="{{ $question->question_title ?? old('question_title')}}">

    @error('question_title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <textarea class="form-control @error('question_body') is-invalid @enderror" name="question_body" id="question_body" placeholder="質問">{{ $question->question_body ?? old('question_body') }}</textarea>

    @error('question_body')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>

<div class="form-group">
    <label for="tag">Tags :</label>
    <input type="text" name="tag" id="tag" class="form-control @error('tag') is-invalid @enderror" placeholder="タグ。こっま：','で分けてください" value="{{ $tags ?? old('tag') }}">

    @error('tag')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary">
</div>
