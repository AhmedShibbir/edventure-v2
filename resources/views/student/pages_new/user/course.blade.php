@extends('student.pages_new.user.profile')

<style>
    .select2-purple .select2-container--default span span{
        height: 2.35rem;
    }
    div .select2 .selection .select2-selection{
        height: 2.35rem;
    }
    .select2-container--default .select2-selection--single {
        border: 2px solid #6400c8 !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #6400c8 !important;
    }
    #journey-cart:hover {
        
        box-shadow: 0 5px 10px rgba(0,0,0,.12), 0 2px 4px rgba(0,0,0,.12);
    }
</style>

@section('mini-header')
    <div class="d-flex justify-content-between">
        <div class="d-flex flex-column fw-800 mr-3">
            <div>
                Courses
            </div>
            <div class="mx-auto">
                {{ $enrolled_course_count }}
            </div>
        </div>
        <div class="d-flex flex-column fw-800 ml-3 justify-content-center">
            <div>
                Completed
            </div>
            <div class="mx-auto">
                {{ $completed_course_count }}
            </div>
        </div>
    </div>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <div id="info-detail" class="row mx-auto my-5">
        <div id="info-left-option" class="d-flex flex-column justify-content-center my-3 col-md-3 mx-md-5 px-0">
            <div class="d-flex flex-column justify-content-center mx-auto border px-4 py-2 my-4" id="journey-cart" style="height: auto !important;">
                {{-- <h5 class="mx-auto">Select a course to view Strengths and Weaknesses</h5> --}}
                <span class="iconify-inline mx-auto" data-icon="openmoji:man-mountain-biking" data-width="36" data-height="36"></span>
                <p class="fw-500 mx-auto" id="day-count">
                    Select a course to view Strengths and Weaknesses
                </p>
            </div>

            <div class="mb-3">
                <select
                    class="select2 form-control"
                    name="bundle"
                    id="bundle_selecting"
                    data-placeholder="Choose Bundle"
                    data-dropdown-css-class="select2-purple"
                    style="width: 100%; margin-top: -8px !important;">

                    <option value="" disabled selected>Choose Bundle</option>

                    <option value="0">Non Bundle Courses</option>
                    
                    @foreach ($enrolled_bundles as $enrolled_bundle)
                        <option value="{{ $enrolled_bundle->bundle->id }}"> {{ $enrolled_bundle->bundle->bundle_name }} </option>
                    @endforeach
                </select>
            </div>

            <div>
                <select
                    class="select2 form-control"
                    name="course"
                    id="course_selecting"
                    data-placeholder="Choose Course"
                    data-dropdown-css-class="select2-purple"
                    style="width: 100%; margin-top: -8px !important;">

                    <option value="" disabled selected>Choose Course</option>

                    @foreach ($enrolled_courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>

                <div id="SelectedCourse" class="d-none mx-auto category-progress text-white">
                    <div class="course-name">
                        <div class="d-flex justify-content-between" id="course_display">
                            <h5 id="courseName" class="fw-400 pl-4"></h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="info-middle-option" class=" my-3 col-md-3 px-0">
            <div id="strength-title" class="strength-weakness-title-common">
                <h2 class="my-auto">Strength</h2>
                {{-- <div>
                    <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>
                </div> --}}
            </div>
            <div class="p-3" id="strength-body">
                <div class="strength-weakness-cq-mcq" id="">
                    <div>
                        <h5 class="fw-600">MCQ</h5>
                    </div>
                    <div class=" text-black" id="mcq_strength">
                    </div>
                    <div>
                        <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
                </div>
                <div class="w-100 h-0 border border-gray my-3 py-0 px-5" id="horizontal-line"></div>
                <div class="strength-weakness-cq-mcq" id="">
                    <div>
                        <h5 class="fw-600">CQ</h5>
                    </div>
                    <div class=" text-black" id="cq_strength">
                        {{-- <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Maxwell</p> --}}
                    </div>
                    <div>
                        <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="info-right-option" class="my-3 col-md-3 mx-md-5 px-0">
            <div id="weakness-title" class="strength-weakness-title-common">
                <h2 class="my-auto">Weakness</h2>
                {{-- <div>
                    <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>
                </div> --}}
            </div>
            <div class="p-3" id="weakness-body">
                <div class="strength-weakness-cq-mcq" id="">
                    <h5 class="fw-600">MCQ</h5>
                </div>
                <div class="text-black" id="mcq_weakness">
                    {{-- <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Plunk</p> --}}
                </div>
                <div>
                    <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                        See More
                    </a>
                </div>
                <div class="w-100 h-0 border border-gray my-3 py-0 px-5" id="horizontal-line"></div>
                <div class="strength-weakness-cq-mcq" id="">
                    <h5 class="fw-600">CQ</h5>
                </div>
                <div class="text-black" id="cq_weakness">
                    {{-- <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">Pythagoras</p> --}}
                </div>
                <div>
                    <a href="#" style="text-decoration: none; color: black; font-weight:600;">
                        See More
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- UI Arrows. Dunno what its for though. --}}

    {{-- <div class="d-flex justify-content-center">
        <div>
            <span class="iconify mr-5" data-icon="fa-solid:angle-left"></span>
        </div>
        <div>
            <span class="iconify ml-5" data-icon="fa-solid:angle-right"></span>
        </div>
    </div> --}}

@endsection

@section('js')
<script src="{{ asset('/js/new-dashboard/iconify-icons.js') }}"></script>

{{-- frontend script part --}}
<script>
    const courseButtonAction = () => {
        categorySelectionText.innerText = "Select Course";
        subjectSelectionText.innerText = "Choose Subject";
        courseOption.setAttribute("style", "background: #FA9632 ; color: white;");
        modelTestOption.setAttribute("style", "background: white ; color: black;");
    }

    const modelTestButtonAction = () => {
        categorySelectionText.innerText = "Select Test Category";
        subjectSelectionText.innerText = "Choose Subject";
        modelTestOption.setAttribute("style", "background: #FA9632 ; color: white;");
        courseOption.setAttribute("style", "background: white ; color: black;");
    }

    let categorySelectionText = document.getElementById("category-selection-text");
    let subjectSelectionText = document.getElementById("subject-selection-text");
    let courseOption = document.getElementById("course-option");
    courseOption.addEventListener("click",courseButtonAction);

    let modelTestOption = document.getElementById("model-test-option");
    modelTestOption.addEventListener("click",modelTestButtonAction);
</script>

<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({width:"100%"});
    });
</script>

<script>
    $(document).on('change', '#bundle_selecting', function(){
        var bundle_id = $( this ).val();
        var bundle_name = $( this ).find('option:selected').text();

        $('#course_selecting').html('');

        $.ajax({
            url: '{{ route("ajax-get-courses-for-bundle") }}',
            type: 'GET',
            data: { bundle_id: bundle_id },
            success: function(response)
            {
                $("#course_selecting").html('');
                var courses = response
                course_list = '<option value="" disabled selected>Choose Course</option>'

                console.log(courses)

                if (courses.length > 0){
                    jQuery.each(courses, function(index, course)
                    {
                        course_list += '<option value="' + course.id + '">' + course.title + '</option>'
                    });
                }

                console.log(course_list)
                $('#course_selecting').append(course_list);
            }
        });
    });
</script>

<script>
    $(document).on('change', '#course_selecting', function(){
        var course_id = $( this ).val();
        var course_name = $( this ).find('option:selected').text();

        console.log(course_id, course_name)

        $("#course_link").remove();
        $('#SelectedCourse').removeClass('d-none');
        $('#courseName').text(course_name);

        $('#mcq_strength').html('');
        $('#cq_strength').html('');
        $('#mcq_weakness').html('');
        $('#cq_weakness').html('');

        // console.log("SELECT HIT");
        // console.log( course_id );

        $.ajax({
            url: '{{ route("ajax-get-strengths-and-weaknesses") }}',
            type: 'GET',
            data: { course_id: course_id },
            success: function(response)
            {
                // console.log(course_id, response);

                var mcq_tags = response.mcq_content_tags;
                var cq_tags = response.cq_content_tags;
                var batch_slug = response.batch_slug;

                $('#course_display').append('<a id="course_link" href="/batch/' + batch_slug + '/"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>');

                // console.log(mcq_tags);
                // console.log(cq_tags);

                if (mcq_tags.length > 0){

                    mcq_strength_tags_html = '';
                    mcq_weakness_tags_html = '';
                    jQuery.each(mcq_tags, function(index, mcq_tag)
                    {
                        if(mcq_tag.percentage_scored != "no data"){
                            if(mcq_tag.percentage_scored > 80){
                                mcq_strength_tags_html += ' <a  href="/profile/course/pdf_and_video/'+ mcq_tag.id +'"> <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' + mcq_tag.title + '</p> </a>';
                            }
                            else if(mcq_tag.percentage_scored < 20){
                                mcq_weakness_tags_html += ' <a  href="/profile/course/pdf_and_video/'+ mcq_tag.id +'"> <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' + mcq_tag.title + '</p> </a>';
                            }
                        }
                    });

                    $('#mcq_strength').append(mcq_strength_tags_html);
                    $('#mcq_weakness').append(mcq_weakness_tags_html);
                }

                if (cq_tags.length > 0){

                    cq_strength_tags_html = '';
                    cq_weakness_tags_html = '';
                    jQuery.each(cq_tags, function(index, cq_tag)
                    {
                        if(cq_tag.percentage_scored != "no data"){
                            if(cq_tag.percentage_scored > 80){
                                cq_strength_tags_html += '<a href="/profile/course/pdf_and_video/'+ cq_tag.id +'"> <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' + cq_tag.title + '</p> </a>';
                            }
                            else if(cq_tag.percentage_scored < 20){
                                cq_weakness_tags_html += '<a  href="/profile/course/pdf_and_video/'+ cq_tag.id +'"> <p class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' + cq_tag.title + '</p> </a>';
                            }
                        }
                    });

                    $('#cq_strength').append(cq_strength_tags_html);
                    $('#cq_weakness').append(cq_weakness_tags_html);
                }

            }
        });
    });
</script>
@endsection
{{-- frontend script part ends --}}
