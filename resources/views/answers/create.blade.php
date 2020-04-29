<form action="{{ route('answers.store', [$question->id, $question->question_title]) }}" method="post" class="mt-4">

    @csrf

    @include('include.answerForm')
</form>
