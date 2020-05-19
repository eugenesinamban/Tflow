<div class="form-group">
    <label for="answer" class="col-form-label">{{ $label }}</label>
    <textarea name="answer" id="answer" cols="30" rows="10" class="form-control @error('answer') is-invalid @enderror">{{ $answer->answer ?? old('answer') }}</textarea>

    @error('answer')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary">
</div>
