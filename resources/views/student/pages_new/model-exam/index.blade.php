<x-landing-layout headerBg="white">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/model-exam-index.css">
    <link rel="stylesheet" href="/css/tooltip.css">
    <style>
        .bold-header {
            font-weight: bolder;
            color: #6400c8;
        }
        .card-footer:hover {
            background: #6400c8 !important;
        }
    </style>
<div class="page-section">
    <div class="container">
        @include('partials.alert')
        <h3 class="text-center mt-6 bold-header">{{$category->name}}</h3>
        @if(count($exam_topics) > 0 )
            <div class="my-md-3 my-sm-2">
                <div class=" text-center bradius-10 py-2 w-100 text-gray text-xsm fw-700">Topics</div>
            </div>
            <div class="text-center @if($exam_topics->count()>=7) course-category-js @endif ">
                @foreach($exam_topics as $topic)
                    <a href="{{route('model.exam.category.topics',['uuid' => $category->uuid,'t' => $topic->id])}}"
                       class="{{Illuminate\Support\Facades\Cache::get('exam_topic') == $topic->id ? 'text-white btn-orange-customed' : 'text-purple bg-white'}} mb-3 d-inline-block course-category-single-js btn fw-800 text-xxsm
                            mx-1 bradius-15 bshadow-medium px-4" style="box-shadow: 0px 9px 80px rgba(249, 150, 51, 0.173674), 0px 2.01027px 17.869px rgba(249, 150, 51, 0.256326), 0px 0.598509px 5.32008px rgba(249, 150, 51, 0.43);">{{$topic->name}}</a>
                @endforeach
            </div>
        @else
            <div class="py-4">
                <div class="text-center bradius-10 py-2 w-100 text-gray text-sm fw-700">
                    Topics will be added soon<br>
                    <img style="width: 60%;margin-top: 20px;" src="/img/category_details/topic_not_found.svg" alt="">
                </div>

            </div>
        @endif

            @if(count($exams) > 0 )
                <div class="row row-cols-lg-4 justify-content-center py-3 card-group-row mb-lg-8pt" style="row-gap: 25px">

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
                        
                        <div>
                            <div class="card text-center"
                                style="border-radius: 26px;width: 248px;height: 301px;padding:0px !important">
                                <div class="{{$d_none}} ribbon ribbon-top-left"><span>done</span></div>
                                <div class="card-header fw-800"
                                    style="color: #6400C8;font-size: 16px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;border-radius: 26px 26px 0 0"
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="{{ $exam->title }}">
                                    {{ $exam->title }}
                                </div>
                                <div class="card-body">
                                    @if ($exam->image)
                                        <img class="img-fluid" height="96" width="112"
                                            src="{{$exam->image ? Storage::url('examImage/'.$exam->image) : ''}}"
                                            alt="Exam image">
                                    @else
                                        <img class="img-fluid" height="96" width="112"
                                            src="/img/category_details/default-image.png" alt="Exam image">
                                    @endif

                                </div>

                                <a href="{{!auth()->check() ? 'javascript:void(0);' : $href}}"
                                    class="{{auth()->check() && auth()->user()->is_admin == 1 ? 'disabled' : ''}}{{!auth()->check() ? 'logInAlert' : ''}}">
                                    <div class="card-footer fw-700 text-white d-flex justify-content-between" style="border-radius: 0 0 26px 26px;background:#FA9632">
                                        @if(!is_null($exam->exam_price) && $exam->exam_price != 0)
                                            <span class="py-auto" style="font-size: .9rem;">{{(int)($exam->exam_price)}} ৳</span>
                                        @else
                                            <span style="font-size: .9rem">FREE</span>
                                        @endif
                                        
                                        <span style="font-size: .9rem">{{$label}}</span>
                                    </div>
                                </a>

                                
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

