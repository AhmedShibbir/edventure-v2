<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/model-exam-index.css">
    <style>
        .bold-header {
            font-weight: bolder;
            color: #6400c8;
        }
    </style>
<div class="page-section">
    <div class="container">
        @include('partials.alert')
        <h1 class="text-center mt-6 bold-header">{{$category->name}}</h1>
        @if(count($exam_topics) > 0 )
            <div class="mt-1">
                <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700">Topics</div>
            </div>
            <div class="text-center @if($exam_topics->count()>=7) course-category-js @endif ">
                @foreach($exam_topics as $topic)
                    <a href="{{route('model.exam.category.topics',['uuid' => $category->uuid,'t' => $topic->id])}}"
                       class="{{Illuminate\Support\Facades\Cache::get('exam_topic') == $topic->id ? 'text-white btn-orange-customed' : 'text-purple bg-white'}} mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm
                            mx-1 bradius-15 bshadow-medium px-4">{{$topic->name}}</a>
                @endforeach
            </div>
        @else
            <div class="py-4">
                <div class=" text-center bradius-10 py-2 w-100 text-gray text-sm fw-700">No Topics Found</div>
            </div>
        @endif

            @if(count($exams) > 0 )
                <div class="row justify-content-center py-3 card-group-row mb-lg-8pt">

                    @foreach ($exams as $exam)
                        @php($label = 'Take Exam')
                        @php($d_none = 'd-none')
                        @php($href = route('model.exam.paper.mcq', \Illuminate\Support\Facades\Crypt::encrypt($exam->id)))

                        @if(count($exam->paymentOfExams) > 0 && auth()->check())
                            @foreach($exam->paymentOfExams as $value)
                                @if($value->user_id == auth()->user()->id)
                                    @php($label = 'Take Exam')
                                    @php($href = route('model.exam.paper.mcq', \Illuminate\Support\Facades\Crypt::encrypt($exam->id)))
                                    @break
                                @else
                                    @php($label = 'Pay')
                                    @php($href = route('single.payment.initialize', $exam->id))
                                    @continue
                                @endif
                            @endforeach
                        @else
                            @if(!is_null($exam->exam_price) && $exam->exam_price != 0)
                                @php($label = 'Pay')
                                @php($href = route('single.payment.initialize', $exam->id))
                            @endif
                        @endif

                        @if(count($exam->mcqTotalResult) > 0 && auth()->check())
                            @foreach($exam->mcqTotalResult as $value)
                                @if($value->student_id == auth()->user()->id)
                                    @php($label = 'View Result')
                                    @php($d_none = '')
                                    @php($href = route('model.exam.paper.mcq', \Illuminate\Support\Facades\Crypt::encrypt($exam->id)))
                                    @break
                                @endif
                            @endforeach
                        @endif
                        <div class="col-md-3 mb-4" style="max-width: 100%;padding-right: 0 !important;">
                            <div class="{{$d_none}} ribbon ribbon-top-left"><span>done</span></div>
                            <div style="background-position: center center !important;background-size:cover !important;
                                background: url({{$exam->image ? Storage::url('examImage/'.$exam->image) : ''}})"
                                 class="single-exam text-center mx-auto p-4 mb-md-0">
                                <h5 style="line-height: 1.5em; height: 3em; width: 100%; overflow: hidden;" class="text-center mt-2">{{ $exam->title }} </h5>
                                @if(!is_null($exam->exam_price) && $exam->exam_price != 0)
                                    <p class=" text-center text-md mt-2 fw-600 text-price">{{(int)($exam->exam_price)}}৳</p>
                                @endif
                                <div style="margin-top: 40px" class="text-center d-block">
                                    <a
                                        href="{{!auth()->check() ? 'javascript:void(0);' : $href}}"
                                        class="{{auth()->check() && auth()->user()->is_admin == 1 ? 'disabled' : ''}}{{!auth()->check() ? 'logInAlert' : ''}} btn btn-outline text-purple mt-2">
                                        {{$label}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="py-5 py-md-1 text-center d-flex justify-content-center">
                    <p class="text-center">{{ $exams->withQueryString()->links('vendor.pagination.custom') }}</p>
                </div>
            @endif
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--    /*******************************************************/--}}

    <script>
        var loginAlert = document.getElementsByClassName('logInAlert');

        for(var i = 0; i < loginAlert.length; i++) {
            (function(index) {
                loginAlert[index].addEventListener("click", function() {
                    Swal.fire({
                        icon: 'info',
                        title: 'Please login to continue',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    })
                })
            })(i);
        }
    </script>
</x-landing-layout>

