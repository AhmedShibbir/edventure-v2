
   <x-landing-layout headerBg="white">
      {{-- custom css linked --}}
      <link rel="stylesheet" href="{{ asset('/css/new-dashboard.css') }}">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <style>
           .avatar-upload {
               position: relative;
               max-width: 205px;
               margin: 50px auto;
           }
           .avatar-upload .avatar-edit {
               position: absolute;
               right: 12px;
               z-index: 1;
               top: 10px;
           }
           .avatar-upload .avatar-edit input {
               display: none
           }
           #imageLabel {
               display: inline-block;
               width: 34px;
               height: 34px;
               margin-bottom: 0;
               border-radius: 100%;
               background: #FFFFFF;
               border: 1px solid transparent;
               box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
               cursor: pointer;
               font-weight: normal;
               transition: all .2s ease-in-out;
           }
           #imageLabel:hover {
               background: #f1f1f1;
               border-color: #d6d6d6;
           }
           #imageLabel:after {
               content: "\f303";
               font-family: 'Font Awesome 5 Free';
               color: #757575;
               position: absolute;
               top: 8px;
               left: 0;
               right: 0;
               text-align: center;
               margin: auto;
               font-weight: 900;
           }
           .avatar-preview {
               width: 197px;
               height: 192px;
               position: relative;
               border-radius: 100%;
               border: 6px solid #F8F8F8;
               box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
           }
           #imagePreview {
               width: 188px;
               height: 178px;
               border-radius: 100%;
               background-size: cover;
               background-repeat: no-repeat;
               background-position: center;
           }
       </style>
      {{-- custom css linked --}}

      <div id="parent-div" class="mt-5 pt-5 p-5">
         <div id="info-part" class="d-md-flex justify-content-between align-items-middle">

            <div class="d-md-flex justify-content-start mr-auto">
                  <div class="d-md-flex">
                          <div class="avatar-upload">
                              <div class="avatar-edit">
                                  <input type='file' id="image" name="image" accept=".png, .jpg, .jpeg" />
                                  <label id="imageLabel" for="image"></label>
                              </div>
                              <div class="avatar-preview">
                                  <div id="imagePreview" style="background-image: url({{auth()->user()->image ?
                                                                 \Illuminate\Support\Facades\Storage::url('studentImage/'.auth()->user()->image) :
                                                                   asset('/img/profile.png')}});">
                                  </div>
                              </div>
                          </div>
                  </div>
                  <div class="d-flex flex-column justify-content-center align-top ml-3">
                     <div class="d-flex">
                        <h3 class="fw-600">{{ $user->name }}</h3><span class="iconify-inline" data-icon="emojione-monotone:hand-with-fingers-splayed" data-width="36" data-height="36"></span>
                     </div>
                     <div class="w-100 h-0 border border-gray m-0 p-0 horizontal-line"></div>
                      @yield('mini-header')
               </div>
            </div>
            <div class="d-flex max-h-10 justify-content-center my-5">
                <a href="{{route('profile')}}" class="text-decoration-none">
                    <div style="{{request()->is('profile') ? 'background: #FA9632 ; color: white;' : 'background: white ; color: black;'}}"
                         class="px-4 py-2 border my-auto fw-600" id="course-option">
                        Course
                    </div>
                </a>
                <a href="{{route('profile.modelTest')}}" class="text-decoration-none">
                    <div style="{{request()->is('profile/model-test') ? 'background: #FA9632 ; color: white;' : 'background: white ; color: black;'}}"
                         class="px-4 py-2 border my-auto fw-600" id="model-test-option">
                        Model Test
                    </div>
                </a>


            </div>
         </div>
            @yield('content')
      </div>
   </x-landing-layout>
   {{--    /************************* Sweet Alert ******************************/--}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   {{--    /*******************************************************/--}}
   <script type="text/javascript">
       if ( $(window).width() < 576 ) {
           $('#imageLabel').show();
       } else {
           $('#imageLabel').hide();
       }


       $('.avatar-upload').mouseover(function () {
           $('#imageLabel').show();
       });
       $('.avatar-upload').mouseout(function () {
           $('#imageLabel').hide();
       });
       $('#image').change(function(){

           let reader = new FileReader();
           reader.onload = (e) => {
               let formData = new FormData();
               formData.append("image", $('input[name=image]')[0].files[0]);
               formData.append("_token", "{{ csrf_token() }}");

               $.ajax({
                   url : window.location.origin+"/profile/image/upload",
                   type: "POST",
                   data : formData,
                   mimeType: "multipart/form-data",
                   processData: false,
                   contentType: false,
                   success: function(res) {
                        if(res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Photo Uploaded Successfully',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                        }

                   },
                   error: function (jqXHR, textStatus, errorThrown) {
                       Swal.fire({
                           icon: 'error',
                           title: JSON.parse(jqXHR.responseText).errors.image[0],
                           showClass: {
                               popup: 'animate__animated animate__fadeInDown'
                           },
                           hideClass: {
                               popup: 'animate__animated animate__fadeOutUp'
                           }
                       })
                   }
               });
           }
           reader.readAsDataURL(this.files[0]);


       });
   </script>
