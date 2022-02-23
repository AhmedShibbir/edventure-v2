@extends('student.pages_new.user.profile')


@section('mini-header')
    <div class="d-flex justify-content-between">
        <div class="d-flex flex-column fw-800 mr-3">
            <div>
                Exams Attended
            </div>
            <div class="mx-auto">
                {{$exam_attended_count}}
            </div>
        </div>
    </div>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <div id="info-detail" class="row mx-auto my-5">
        <div id="info-left-option" class="d-flex flex-column justify-content-center my-3 col-md-3 mx-md-5 px-0">
            <div class="d-flex flex-column justify-content-center mx-auto border px-5 my-3" id="journey-cart">
                <h5 class="fw-800 mx-auto">Amazing!</h5>
                <span class="iconify-inline mx-auto" data-icon="openmoji:man-mountain-biking" data-width="36" data-height="36"></span>
                <p class="fw-500 mx-auto" id="day-count">
                    You are on a 16 Day streak
                </p>
            </div>
            {{-- subject selection part --}}
            <div>
                <select
                        class="select2 form-control"
                        name="category"
                        id="category_selecting"
                        data-placeholder="Choose Category"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                    @foreach ($categories as $category)
                        <option value=""></option>
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <div id="SelectedCategory" class="d-none mx-auto category-progress text-white">
                    <div class="category-name">
                        <div class="d-flex">
                            <h5 id="categoryName" class="fw-600 pl-4"></h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <select
                        class="select2 form-control"
                        name="topic"
                        id="topic_selecting"
                        data-placeholder="Choose Topic"
                        data-dropdown-css-class="select2-purple"
                        style="width: 100%; margin-top: -8px !important;">
                </select>
                <div id="SelectedTopic" class="d-none mx-auto category-progress text-white">
                    <div class="category-name">
                        <div class="d-flex">
                            <h5 id="topicName" class="fw-600 pl-4"></h5>
                        </div>
                    </div>
                </div>

            </div>
            {{-- subject selection part ends --}}
        </div>
        <div id="info-middle-option" class=" my-3 col-md-3 px-0">
            <div id="strength-title" class="strength-weakness-title-common">
                <h2>Strength</h2>
{{--                <div>--}}
{{--                    <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>--}}
{{--                </div>--}}
            </div>
            <div class="p-3" id="strength-body">
                <div class="strength-weakness-cq-mcq" id="">
                    <div>
                        <h5 class="fw-600">MCQ</h5>
                    </div>
                    <div class=" text-black" id="mcq_strength">

                    </div>
                    <div id="strengthMessage">
                        Strength will be shown here
                    </div>
                    <div>
                        <a target="_blank" id="strengthDetailsText" href="{{route('tag.analysis,index',['type' => 'strength'])}}" style="text-decoration: none; color: black; font-weight:600;">
                            See More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="info-right-option" class="my-3 col-md-3 mx-md-5 px-0">
            <div id="weakness-title" class="strength-weakness-title-common">
                <h2>Weakness</h2>
{{--                <div>--}}
{{--                    <a href="#"><span class="iconify" data-icon="bi:arrow-down-right-square-fill" style="color: white;" data-flip="vertical"></span></a>--}}
{{--                </div>--}}
            </div>
            <div class="p-3" id="weakness-body">
                <div class="strength-weakness-cq-mcq" id="">
                    <h5 class="fw-600">MCQ</h5>
                </div>
                <div class="text-black" id="mcq_weakness">
{{--                    <p id="" class="weakTag mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">--}}
{{--                        --}}{{--                                <a href="{{route('tag.solution',$tag->id)}}" class="text-decoration-none">{{$tag->name}}</a>--}}
{{--                    </p>--}}
                </div>
                <div id="weaknessMessage">
                    Weakness will be shown here
                </div>
                <div>
                    <a target="_blank" id="weaknessDetailsText" href="{{route('tag.analysis,index',['type' => 'weakness'])}}" style="text-decoration: none; color: black; font-weight:600;">
                        See More
                    </a>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
        {{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}
        <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
        <script>

            $('.select2').select2()
            $('#weaknessDetailsText').css('display','none')
            $('#strengthDetailsText').css('display','none')

            $('#category_selecting').on("select2:selecting", function (e) {
                $('#SelectedCategory').removeClass('d-none')
                $('#categoryName').html(e.params.args.data.text)
                $('#SelectedTopic').addClass('d-none')

                query_category_id = e.params.args.data.id
                let url = window.location.origin + '/model-test/topic/' + query_category_id;
                $('#topic_selecting').empty();
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (response) {
                        let topicsObj = [
                            id = '',
                            text = ''
                        ];
                        for (const [key, value] of Object.entries(response)) {
                            topicsObj.push({"id": value.id, "text": value.name})
                        }
                        $('#topic_selecting').select2({
                            data: topicsObj
                        });
                    },
                    error: function (e) {
                        console.log(e)
                    }
                });
            });
            $('#topic_selecting').on("select2:selecting", function (e) {
                $('#SelectedTopic').removeClass('d-none')
                $('#topicName').html(e.params.args.data.text)
                $('#mcq_strength').html('')
                $('#mcq_weakness').html('')
                $('#weaknessDetailsText').css('display','none')
                $('#strengthDetailsText').css('display','none')
                $('#weaknessMessage').html('Weakness will be shown here')
                $('#strengthMessage').html('Strength will be shown here')
                // $('#strengthMessage').css('display','block')


                let url = window.location.origin + '/model-test/tag-details/' + e.params.args.data.id;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (response) {
                        if(response.length > 0) {
                            response.forEach((item, index)=>{
                                url = window.location.origin+'/profile/model-test/tag-solutions/'+item.id
                                if(item.percentage_scored <= 60) {
                                    $('#weaknessMessage').html('')
                                    $('#weaknessDetailsText').css('display','block')
                                    $('#mcq_weakness').append('' +
                                        '<p id="" class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' +
                                        '<a target="_blank" href="'+url+'" class="text-decoration-none">'+item.name+'</a>' +
                                        '</p>')
                                } else if(item.percentage_scored >= 90) {
                                    $('#strengthMessage').html('')
                                    $('#strengthDetailsText').css('display','block')
                                    $('#mcq_strength').append('' +
                                        '<p id="" class="mx-2 badge rounded-pill text-wrap max-w-100" style="background: #DEDEDE;">' +
                                        '<a target="_blank" href="'+url+'" class="text-decoration-none">'+item.name+'</a>' +
                                        '</p>')
                                }

                            })
                        }
                    },
                    error: function (e) {
                        console.log(e)
                    }
                });
            });
        </script>
        <script src="{{ asset('/js/new-dashboard/iconify-icons.js') }}"></script>
    @endsection



@endsection

