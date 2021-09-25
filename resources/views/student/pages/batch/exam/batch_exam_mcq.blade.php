@extends('student.layouts.default', [
'title'=>'Batch Exam',
'pageName'=>'Batch Exam',
'secondPageName'=>'Batch Exam'
])

@section('css1')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
    <style>
        html {
            scroll-behavior: smooth;
        }

        < !-- sticky header color -->
        /* [dir] .navbar-dark-pickled-bluewood {
                            background: #f7ddff !important;
                        } */

        [dir] .bg-primary {
            background-color: #81007F !important;
        }

        .text-primary {
            color: #81007F !important;
        }


        [dir] .btn-primary {
            background-color: #81007F !important;
            border-color: #81007F !important;

        }

        [dir] .btn-primary:hover {
            background-color: #DB9BDA !important;
            border-color: #DB9BDA !important;
        }

        .btn-outline-white:hover {
            color: #DB9BDA !important;
        }


        [dir] .preloader {
            background: #81007F !important;
        }

        [dir] .card-subtitle1 {
            padding-right: 60px !important;
            margin-bottom: 6px !important;

        }

        [dir] .fnav-link {
            padding: 0.4rem 1rem !important;
        }

        < !-- radio button for Quiz -->[dir] label {
            padding-left: 5px !important;
        }

        label {
            padding-left: 20px;
        }

        .exam-title .nav-item>p {
            font-size: 18px;
            margin-bottom: 0;
        }

        .exam-title .nav-item>h2 {
            margin-bottom: 8px;
        }

        .time-box {}

    </style>
@endsection

@section('content')
    <div class="mdk-header-layout__content page-content ">
        <div class="page-section border-bottom-2 bg-white">
            <div class="container page__container pt-3">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="nav flex-column exam-title">
                            <li class="nav-item">
                                <h3>Course: {{ $batch->course->title }}</h3>
                            </li>
                            <div class="page-separator">
                                <div class="page-separator__text"></div>
                            </div>
                            <li class="nav-item">
                                {{-- <p>Topic: {{ $courseLecture->title }}</p> --}}
                            </li>
                            <li class="nav-item">
                                <p>Batch: {{ $batch->title }}</p>
                            </li>
                            <li class="nav-item">
                                <p>Exam: {{ $exam->title }}</p>
                            </li>
                            <li class="nav-item">
                                <p>Marks: {{ $exam->marks }}</p>
                            </li>
                        </ul>
                    </div>
                    <!-- Timer -->
                    <div class="col-md-4 ">
                        <!-- <di class="d-flex flex-wrap align-items-end justify-content-end mb-16pt"> -->
                        <div class="text-center text-md-right">
                            <p class="d-inline-block" style="font-size:25px; color: #81007f !important;">Time Left
                                <br> <span id="countdownHours"></span> : <span id="countdownMinuits"></span> : <span
                                    id="countdownSecound">
                            </p> <br>
                            <!--  <p class="h1  font-weight-light m-0" style="font-size:70px; align-items: center; justyfy-content: center; margin:0;">Time Left :  <span id="countdownMinuits-xs"></span> : <span id="countdownSecound-xs"></span></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-section border-bottom-2 bg-white">
            <div class="container page__container pt-3">
                {{-- action="{{ route('submit', ['batch' => $batch, 'courseLecture' => $courseLecture, 'exam' => $exam]) }}" --}}
                <form action="{{ route('submit', ['batch' => $batch, 'exam' => $exam]) }}" method="post" id="exam-form">
                    {{ csrf_field() }}
                    @forelse($questions as $key => $question)
                        <div class="row card-group-row mb-lg-8pt">
                            <div class="card js-overlay card-sm overlay--primary-dodger-blue stack stack--1 card-group-row__card"
                                data-toggle="popover" data-trigger="click">

                                <div class="card-body align-items-center">
                                    <div class="questionMCQ " style="padding: 20px;">
                                        <h3>({{ $loop->index + 1 }})  </h3>
                                        <p>{!! $question->question!!}</p>
                                        <input type="hidden" name="q[{{ $loop->index + 1 }}]"
                                            value="{{ $question->id }}">
                                        <br>
                                        @if ($question->image)
                                            <div class="image-of-question"
                                                style="padding-top: 30px; padding-bottom: 30px; ">
                                                <div class="___class_+?25___" style="">
                                                    <img src="{{ Storage::url($question->image) }}"
                                                        class="img-wh11-quiz" alt="" style="height: auto; width: 400px; ">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6 ">
                                                <div class="custom-control custom-radio QAoptions"
                                                    style="padding-bottom: 10px;">
                                                    <input type="radio"
                                                        id="r{{ $question->field1 }}{{ $loop->index + 1 }}"
                                                        value="{{ $question->field1 }}"
                                                        name="a[{{ $loop->index + 1 }}]" required />
                                                        <span>A)</span>
                                                    <label for="r{{ $question->field1 }}{{ $loop->index + 1 }}">
                                                        {!! $question->field1 !!}</label>
                                                </div>
                                                <div class="custom-control custom-radio QAoptions"
                                                    style="padding-bottom: 10px;">
                                                    <input type="radio"
                                                        id="r{{ $question->field2 }}{{ $loop->index + 1 }}"
                                                        value="{{ $question->field2 }}"
                                                        name="a[{{ $loop->index + 1 }}]" />
                                                        <span>B)</span>
                                                    <label for="r{{ $question->field2 }}{{ $loop->index + 1 }}">
                                                        {!! $question->field2 !!}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 ">
                                                <div class="custom-control custom-radio QAoptions"
                                                    style="padding-bottom: 10px;">
                                                    <input type="radio"
                                                        id="r{{ $question->field3 }}{{ $loop->index + 1 }}"
                                                        value="{{ $question->field3 }}"
                                                        name="a[{{ $loop->index + 1 }}]" />
                                                        <span>C)</span>
                                                    <label for="r{{ $question->field3 }}{{ $loop->index + 1 }}">
                                                        {!! $question->field3 !!}</label>
                                                </div>
                                                <div class="custom-control custom-radio QAoptions"
                                                    style="padding-bottom: 10px;">
                                                    <input type="radio"
                                                        id="r{{ $question->field4 }}{{ $loop->index + 1 }}"
                                                        value="{{ $question->field4 }}"
                                                        name="a[{{ $loop->index + 1 }}]" />
                                                        <span>D)</span>
                                                    <label for="r{{ $question->field4 }}{{ $loop->index + 1 }}">
                                                        {!! $question->field4 !!}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="page-separator">
                            <div class="page-separator__text">No Question</div>
                        </div>
                    @endforelse
                    <!-- Submit Button -->
                    <div class="card-body d-flex align-items-end" style="padding-bottom: 200px;">
                        <div class="col-md-4 offset-md-4">
                            <a href="#">
                                <button class="btn btn-md btn-primary ">Submit Answers</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js1')
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Timer for Quiz -->
    <script>
        var timeleft = '<?php echo $exam->duration * 60; ?>';
        var downloadTimer = setInterval(function() {
            timeleft--;
            let hour = Math.floor(timeleft / 3600);
            let min = Math.floor(timeleft / 60) >= 60 ? Math.floor(timeleft / 60) - 60 : Math.floor(timeleft / 60);
            let sec = timeleft % 60;
            if (hour < 10) {
                hour = `0${hour}`;
            }
            if (min < 10) {
                min = `0${min}`;
            }
            if (sec < 10) {
                sec = `0${sec}`;
            }
            document.getElementById('countdownHours').textContent = hour;
            document.getElementById('countdownMinuits').textContent = min;
            document.getElementById('countdownSecound').textContent = sec;


            if (timeleft <= 0) {
                document.getElementById('exam-form').submit();
                clearInterval(downloadTimer);

            }

        }, 1000);
    </script>

    <script>
        (function() {
            'use strict';
            var headerNode = document.querySelector('.mdk-header')
            var layoutNode = document.querySelector('.mdk-header-layout')
            var componentNode = layoutNode ? layoutNode : headerNode
            componentNode.addEventListener('domfactory-component-upgraded', function() {
                headerNode.mdkHeader.eventTarget.addEventListener('scroll', function() {
                    var progress = headerNode.mdkHeader.getScrollState().progress
                    var navbarNode = headerNode.querySelector('#default-navbar')
                    navbarNode.classList.toggle('bg-transparent', progress <= 0.2)
                })
            })
        })()

        $(window).scroll(function() {
            $('.fade-in, .fade-out').each(function() {
                var top_of_element = $(this).offset().top;
                var bottom_of_element = $(this).offset().top + $(this).outerHeight();
                var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
                var top_of_screen = $(window).scrollTop();

                if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element) && !$(this)
                    .hasClass('is-visible')) {
                    $(this).addClass('is-visible');
                }
            });
        });

        (function($) {
            $.fn.countTo = function(options) {
                options = options || {};
                return $(this).each(function() {
                    // set options for current element
                    var settings = $.extend({},
                        $.fn.countTo.defaults, {
                            from: $(this).data("from"),
                            to: $(this).data("to"),
                            speed: $(this).data("speed"),
                            refreshInterval: $(this).data("refresh-interval"),
                            decimals: $(this).data("decimals")
                        },
                        options
                    );

                    // how many times to update the value, and how much to increment the value on each update
                    var loops = Math.ceil(settings.speed / settings.refreshInterval),
                        increment = (settings.to - settings.from) / loops;

                    // references & variables that will change with each update
                    var self = this,
                        $self = $(this),
                        loopCount = 0,
                        value = settings.from,
                        data = $self.data("countTo") || {};

                    $self.data("countTo", data);

                    // if an existing interval can be found, clear it first
                    if (data.interval) {
                        clearInterval(data.interval);
                    }
                    data.interval = setInterval(updateTimer, settings.refreshInterval);
                    // initialize the element with the starting value
                    render(value);

                    function updateTimer() {
                        value += increment;
                        loopCount++;

                        render(value);

                        if (typeof settings.onUpdate == "function") {
                            settings.onUpdate.call(self, value);
                        }
                        if (loopCount >= loops) {
                            // remove the interval
                            $self.removeData("countTo");
                            clearInterval(data.interval);
                            value = settings.to;
                            if (typeof settings.onComplete == "function") {
                                settings.onComplete.call(self, value);
                            }
                        }
                    }

                    function render(value) {
                        var formattedValue = settings.formatter.call(self, value, settings);
                        $self.html(formattedValue);
                    }
                });
            };

            $.fn.countTo.defaults = {
                from: 0, // the number the element should start at
                to: 0, // the number the element should end at
                speed: 1000, // how long it should take to count between the target numbers
                refreshInterval: 100, // how often the element should be updated
                decimals: 0, // the number of decimal places to show
                formatter: formatter, // handler for formatting the value before rendering
                onUpdate: null, // callback method for every time the element is updated
                onComplete: null // callback method for when the element finishes updating
            };

            function formatter(value, settings) {
                return value.toFixed(settings.decimals);
            }
        })(jQuery);

        jQuery(function($) {
            // custom formatting example
            $(".count-number").data("countToOptions", {
                formatter: function(value, options) {
                    return value
                        .toFixed(options.decimals)
                        .replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
                }
            });

            // start all the timers
            $(".timer").each(count);

            function count(options) {
                var $this = $(this);
                options = $.extend({}, options || {}, $this.data("countToOptions") || {});
                $this.countTo(options);
            }
        });
    </script>
    <script type="text/javascript">
        window.onbeforeunload = function() {
            return 'Are you really want to perform the action?';
        }
    </script>
@endsection
