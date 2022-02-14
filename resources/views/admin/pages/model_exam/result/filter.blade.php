<form action="">
    <div class="row">
        <div class="col-md-3">
            <div class="select2-purple d-flex align-middle py-0 pb-5">
                <select
                    name="query[student]"
                    class="select2 form-control"
                    id="query_student_selected"
                    data-placeholder="Select Student"
                    data-dropdown-css-class="select2-purple"
                    style="width: 100%; margin-top: -8px !important;">
                    @foreach ($filters['student'] as $filter)
                        <option value=""></option>
                        <option value="{{ $filter->student->id }}">{{ $filter->student->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="select2-purple d-flex align-middle py-0 pb-5">
                <select
                        class="select2 selected_topic form-control"
                        id="query_email_selected"
                        name="query[email]"
                        data-placeholder="Select Student Email"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                    @foreach ($filters['student'] as $filter)
                        <option value=""></option>
                        <option value="{{ $filter->student->id }}">{{ $filter->student->email }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <select
                class="select2 form-control"
                id="query_exam_selected"
                name="query[exam]"
                data-placeholder="Select Exam"
                data-dropdown-css-class="select2-purple"
                style="width: 100%; margin-top: -8px !important;">
                @foreach ($filters['exam'] as $filter)
                    <option value=""></option>
                    <option value="{{ $filter->modelExam->id }}">{{ $filter->modelExam->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-outline-primary">Find</button>
        </div>
        <div class="col-md-1">
            <a href="{{route('model.exam.result')}}" class="btn btn-outline-secondary">Clear</a>
        </div>
        </div>


    </div>
</form>
