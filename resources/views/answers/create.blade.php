<form action="{{ route('answers.store', [$question->id, $question->question_title]) }}" method="post" class="mt-4">

    @csrf

    <div class="form-group">
        <label for="answer" class="col-form-label"><span class="h3">Your Answer</span></label>
        <textarea name="answer" id="answer" cols="30" rows="10" class="form-control @error('answer') is-invalid @enderror">{{ old('answer') }}</textarea>

        @error('answer')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </div>
    <div class="form-group">
        <input type="hidden" value="{{ $question->id }}">
        <input type="submit" value="Submit Your Answer" class="btn btn-primary">
    </div>
</form>
