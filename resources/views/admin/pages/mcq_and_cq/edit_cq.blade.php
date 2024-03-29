@extends('admin.layouts.default', [
'title'=> $type.' CQ',
'pageName'=> 'Edit '.$type.' CQ',
'secondPageName'=>'Edit '.$type.' CQ'
])
@section('css1')
   <!-- Select2 -->
   <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
   <!-- Bootstrap4 Duallistbox -->
   <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

   <!-- summernote -->
   <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">

   <script>
      function previewFile(input) {
         var file = $("input[type=file]").get(0).files[0];

         if (file) {
               var reader = new FileReader();

               reader.onload = function() {
                  $("#previewImg").attr("src", reader.result);
               }

               reader.readAsDataURL(file);
         }
      }
   </script>
@endsection

@section('content')
   {{-- @livewire('exam.cq', ['exam'=>$exam]) --}}

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
               <!-- right column -->
               <div class="col-md-12">
                  <!-- general form elements disabled -->
                  <div class="card card-warning">
                     <div class="card-header">
                           <h3 class="card-title">Create CQ</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                           <form role="form" method="POST" action="{{ route($update_route, [$exam, $cq]) }}"
                              enctype="multipart/form-data">
                              {{ csrf_field() }}
                              @method('PUT')
                              <input name="examId" type="hidden" value="{{ $exam->id }}">
                              <input name="slug" type="hidden" value="{{ $exam->slug }}">
                              {{-- উদ্দীপক --}}
                              <fieldset class="border p-2">
                                 <legend class="w-auto">উদ্দীপক <span class="must-filled">*</span></legend>
                                 <div class="form-group">
                                       {{-- <label for="question" class="col-form-label">Question <span
                                             class="must-filled">*</span></label> --}}
                                       <textarea input="creative_question" id="creative_question" name="creative_question"
                                          placeholder="Enter question"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          required>{{ old('creative_question') ? old('creative_question') : $cq->creative_question }}</textarea>
                                       @error('creative_question')
                                          <p style="color: red;">{{ $message }}</p>
                                       @enderror
                                 </div>
                                 <div class="col-md-6">
                                       <div class="row">
                                          <div class="col-md-8">
                                             <div class="form-group">
                                                   <label for="exampleInputFile" class="col-form-label">Choose
                                                      Image</label>
                                                   <div class="input-group">
                                                      <div class="custom-file">
                                                         <input type="file" name="uddipokimage"
                                                               class="custom-file-input hidden" id="exampleInputFile"
                                                               onchange="previewFile(this);">
                                                         <label class="custom-file-label" for="exampleInputFile">Choose
                                                               image</label>
                                                      </div>
                                                   </div>
                                                   @error('uddipokimage')
                                                      <p style="color: red;">{{ $message }}</p>
                                                   @enderror
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             @if ($cq->image)
                                                   <img class="product-image" src="{{ Storage::url($cq->image) }}"
                                                      id="previewImg" class="avatar" alt="...">
                                             @endif
                                          </div>
                                       </div>
                                 </div>
                              </fieldset>

                              {{-- জ্ঞানমূলক --}}
                              <fieldset class="border p-2 mt-4">
                                 <legend class="w-auto">জ্ঞানমূলক <span class="must-filled">*</span></legend>
                                 <div class="form-group">
                                       {{-- <label for="question" class="col-form-label">Question <span
                                             class="must-filled">*</span></label> --}}
                                       <textarea input="question" id="question1" name="gyanmulokquestion"
                                          placeholder="Enter question"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          required>{{ old('gyanmulokquestion') ? old('gyanmulokquestion') : $cquestion1->question }}</textarea>
                                       @error('gyanmulokquestion')
                                          <p style="color: red;">{{ $message }}</p>
                                       @enderror
                                 </div>
                                 <div class="col-md-6">
                                       <div class="row">
                                          <div class="col-md-8">
                                             <div class="form-group">
                                                   <label for="exampleInputFile" class="col-form-label">Choose
                                                      Image</label>
                                                   <div class="input-group">
                                                      <div class="custom-file">
                                                         <input type="file" name="gyanmulokimage"
                                                               class="custom-file-input hidden" id="exampleInputFile"
                                                               onchange="previewFile(this);">
                                                         <label class="custom-file-label" for="exampleInputFile">Choose
                                                               image</label>
                                                      </div>
                                                   </div>
                                                   @error('gyanmulokimage')
                                                      <p style="color: red;">{{ $message }}</p>
                                                   @enderror
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             @if ($cquestion1->image)
                                                   <img class="product-image"
                                                      src="{{ Storage::url($cquestion1->image) }}" id="previewImg"
                                                      class="avatar" alt="...">
                                             @endif
                                          </div>
                                       </div>
                                 </div>

                                 <div class="row">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label class="col-form-label" for="marks">Marks <span
                                                      class="must-filled">*</span></label>
                                             <input type="text" id="marks" class="form-control" name="gyanmulokmarks"
                                                   value="1" placeholder="Enter marks" required readonly>
                                             @error('gyanmulokmarks')
                                                   <p style="color: red;">{{ $message }}</p>
                                             @enderror
                                          </div>
                                       </div>
                                       <div class="col-md-8">
                                          <label class="col-form-label" for="examId">Content Tag <span
                                                   class="must-filled">*</span></label>
                                          <div class="select2-purple">
                                             <select class="select2" multiple name="gyanmulokcontentTagIds[]"
                                                   data-placeholder="Select a Content Tag"
                                                   data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                                   @foreach ($questionContentTags1 as $questionContentTag1)
                                                      <option value="{{ $questionContentTag1->content_tag_id }}"
                                                         selected>
                                                         {{ $questionContentTag1->contentTag->title }}</option>
                                                   @endforeach
                                                   @foreach ($contentTags1 as $contentTag1)
                                                      <option value="{{ $contentTag1->id }}">
                                                         {{ $contentTag1->title }}
                                                      </option>
                                                   @endforeach
                                             </select>
                                          </div>
                                          @error('gyanmulokcontentTagIds')
                                             <p style="color: red;">{{ $message }}</p>
                                          @enderror
                                       </div>
                                 </div>
                              </fieldset>

                              {{-- অনুধাবন --}}
                              <fieldset class="border p-2 mt-4">
                                 <legend class="w-auto">অনুধাবন <span class="must-filled">*</span></legend>
                                 <div class="form-group">
                                       {{-- <label for="question" class="col-form-label">Question <span
                                             class="must-filled">*</span></label> --}}
                                       <textarea input="question" id="question2" name="onudhabonquestion"
                                          placeholder="Enter question"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          required>{{ old('onudhabonquestion') ? old('onudhabonquestion') : $cquestion2->question }}</textarea>
                                       @error('onudhabonquestion')
                                          <p style="color: red;">{{ $message }}</p>
                                       @enderror
                                 </div>
                                 <div class="col-md-6">
                                       <div class="row">
                                          <div class="col-md-8">
                                             <div class="form-group">
                                                   <label for="exampleInputFile" class="col-form-label">Choose
                                                      Image</label>
                                                   <div class="input-group">
                                                      <div class="custom-file">
                                                         <input type="file" name="onudhabonimage"
                                                               class="custom-file-input hidden" id="exampleInputFile"
                                                               onchange="previewFile(this);">
                                                         <label class="custom-file-label" for="exampleInputFile">Choose
                                                               image</label>
                                                      </div>
                                                   </div>
                                                   @error('onudhabonimage')
                                                      <p style="color: red;">{{ $message }}</p>
                                                   @enderror
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             @if ($cquestion2->image)
                                                   <img class="product-image"
                                                      src="{{ Storage::url($cquestion2->image) }}" id="previewImg"
                                                      class="avatar" alt="...">
                                             @endif
                                          </div>
                                       </div>
                                 </div>

                                 <div class="row">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label class="col-form-label" for="marks">Marks <span
                                                      class="must-filled">*</span></label>
                                             <input type="text" id="marks" class="form-control" name="onudhabonmarks"
                                                   value="2" placeholder="Enter marks" required readonly>
                                             @error('onudhabonmarks')
                                                   <p style="color: red;">{{ $message }}</p>
                                             @enderror
                                          </div>
                                       </div>
                                       <div class="col-md-8">
                                          <label class="col-form-label" for="examId">Content Tag <span
                                                   class="must-filled">*</span></label>
                                          <div class="select2-purple">
                                             <select class="select2" multiple name="onudhaboncontentTagIds[]"
                                                   data-placeholder="Select a Content Tag"
                                                   data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                                   @foreach ($questionContentTags2 as $questionContentTag2)
                                                      <option value="{{ $questionContentTag2->content_tag_id }}"
                                                         selected>
                                                         {{ $questionContentTag2->contentTag->title }}</option>
                                                   @endforeach
                                                   @foreach ($contentTags2 as $contentTag2)
                                                      <option value="{{ $contentTag2->id }}">
                                                         {{ $contentTag2->title }}
                                                      </option>
                                                   @endforeach
                                             </select>
                                          </div>
                                          @error('onudhaboncontentTagIds')
                                             <p style="color: red;">{{ $message }}</p>
                                          @enderror
                                       </div>
                                 </div>
                              </fieldset>

                              {{-- প্রয়োগমূলক --}}
                              <fieldset class="border p-2 mt-4">
                                 <legend class="w-auto">প্রয়োগমূলক <span class="must-filled">*</span></legend>
                                 <div class="form-group">
                                       {{-- <label for="question" class="col-form-label">Question <span
                                             class="must-filled">*</span></label> --}}
                                       <textarea input="question" id="question3" name="proyugquestion"
                                          placeholder="Enter question"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          required>{{ old('proyugquestion') ? old('proyugquestion') : $cquestion3->question }}</textarea>
                                       @error('proyugquestion')
                                          <p style="color: red;">{{ $message }}</p>
                                       @enderror
                                 </div>
                                 <div class="col-md-6">
                                       <div class="row">
                                          <div class="col-md-8">
                                             <div class="form-group">
                                                   <label for="exampleInputFile" class="col-form-label">Choose
                                                      Image</label>
                                                   <div class="input-group">
                                                      <div class="custom-file">
                                                         <input type="file" name="proyugimage"
                                                               class="custom-file-input hidden" id="exampleInputFile"
                                                               onchange="previewFile(this);">
                                                         <label class="custom-file-label" for="exampleInputFile">Choose
                                                               image</label>
                                                      </div>
                                                   </div>
                                                   @error('proyugimage')
                                                      <p style="color: red;">{{ $message }}</p>
                                                   @enderror
                                             </div>
                                          </div>
                                          <div class="col-md-4">
                                             @if ($cquestion3->image)
                                                   <img class="product-image"
                                                      src="{{ Storage::url($cquestion3->image) }}" id="previewImg"
                                                      class="avatar" alt="...">
                                             @endif
                                          </div>
                                       </div>
                                 </div>

                                 <div class="row">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label class="col-form-label" for="marks">Marks <span
                                                      class="must-filled">*</span></label>
                                             <input type="text" id="marks" class="form-control" name="proyugmarks"
                                                   value="3" placeholder="Enter marks" readonly required>
                                             @error('proyugmarks')
                                                   <p style="color: red;">{{ $message }}</p>
                                             @enderror
                                          </div>
                                       </div>
                                       <div class="col-md-8">
                                          <label class="col-form-label" for="examId">Content Tag <span
                                                   class="must-filled">*</span></label>
                                          <div class="select2-purple">
                                             <select class="select2" multiple name="proyugcontentTagIds[]"
                                                   data-placeholder="Select a Content Tag"
                                                   data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                                   @foreach ($questionContentTags3 as $questionContentTag3)
                                                      <option value="{{ $questionContentTag3->content_tag_id }}"
                                                         selected>
                                                         {{ $questionContentTag3->contentTag->title }}</option>
                                                   @endforeach
                                                   @foreach ($contentTags3 as $contentTag3)
                                                      <option value="{{ $contentTag3->id }}">
                                                         {{ $contentTag3->title }}
                                                      </option>
                                                   @endforeach
                                             </select>
                                          </div>
                                          @error('proyugcontentTagIds')
                                             <p style="color: red;">{{ $message }}</p>
                                          @enderror
                                       </div>
                                 </div>
                              </fieldset>

                              {{-- উচ্চতর দক্ষতা --}}
                              <fieldset class="border p-2 mt-4">
                                 <legend class="w-auto">উচ্চতর দক্ষতা <span class="must-filled">*</span>
                                 </legend>
                                 <div class="form-group">
                                       <textarea input="question" id="question4" name="ucchotorquestion"
                                          placeholder="Enter question"
                                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                          required>{{ old('ucchotorquestion') ? old('ucchotorquestion') : $cquestion4->question }}</textarea>
                                       @error('ucchotorquestion')
                                          <p style="color: red;">{{ $message }}</p>
                                       @enderror
                                 </div>
                                 <div class="col-md-6">
                                    <div class="row">
                                       <div class="col-md-8">
                                          <div class="form-group">
                                                <label for="exampleInputFile" class="col-form-label">Choose
                                                   Image</label>
                                                <div class="input-group">
                                                   <div class="custom-file">
                                                      <input type="file" name="ucchotorimage"
                                                            class="custom-file-input hidden" id="exampleInputFile"
                                                            onchange="previewFile(this);">
                                                      <label class="custom-file-label" for="exampleInputFile">Choose
                                                            image</label>
                                                   </div>
                                                </div>
                                                @error('ucchotorimage')
                                                   <p style="color: red;">{{ $message }}</p>
                                                @enderror
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          @if ($cquestion4->image)
                                                <img class="product-image"
                                                   src="{{ Storage::url($cquestion4->image) }}" id="previewImg"
                                                   class="avatar" alt="...">
                                          @endif
                                       </div>
                                    </div>
                                 </div>

                                 <div class="row">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label class="col-form-label" for="marks">Marks <span
                                                      class="must-filled">*</span></label>
                                             <input type="text" id="marks" class="form-control" name="ucchotormarks"
                                                   value="4" placeholder="Enter marks" readonly required>
                                             @error('ucchotormarks')
                                                   <p style="color: red;">{{ $message }}</p>
                                             @enderror
                                          </div>
                                       </div>
                                       <div class="col-md-8">
                                          <label class="col-form-label" for="examId">Content Tag <span
                                                   class="must-filled">*</span></label>
                                          <div class="select2-purple">
                                             <select class="select2" multiple name="ucchotorcontentTagIds[]"
                                                   data-placeholder="Select a Content Tag"
                                                   data-dropdown-css-class="select2-purple" style="width: 100%;" required>
                                                   @foreach ($questionContentTags4 as $questionContentTag4)
                                                      <option value="{{ $questionContentTag4->content_tag_id }}"
                                                         selected>
                                                         {{ $questionContentTag4->contentTag->title }}</option>
                                                   @endforeach
                                                   @foreach ($contentTags4 as $contentTag4)
                                                      <option value="{{ $contentTag4->id }}">
                                                         {{ $contentTag4->title }}
                                                      </option>
                                                   @endforeach
                                             </select>
                                          </div>
                                          @error('ucchotorcontentTagIds')
                                             <p style="color: red;">{{ $message }}</p>
                                          @enderror
                                       </div>
                                 </div>
                              </fieldset>

                              <fieldset class="border p-2 mt-4">
                                 <div class="row">

                                    @if($exam->exam_type == "Topic End Exam")
                                       <div class="col-md-12">
                                          <div class="form-group">
                                             <label class="col-form-label" for="question_set"> Question Set <span class="must-filled">*</span></label>
                                                <select class="form-control" name="question_set"  value="{{ $cq->question_set }}">
                                                      <option value="" disabled> Select Set </option>
                                                      <option value="1" @if ($cq->question_set == 1) selected @endif> Set 1 </option>
                                                      <option value="2" @if ($cq->question_set == 2) selected @endif> Set 2 </option>
                                                      <option value="3" @if ($cq->question_set == 3) selected @endif> Set 3 </option>
                                                </select>
                                             @error('question_set')
                                                <p style="color: red;">{{ $message }}</p>
                                             @enderror
                                          </div>
                                       </div>
                                    @endif

                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="exampleInputFile" class="col-form-label">Choose anser pdf file</label>
                                          <div class="input-group">
                                                <div class="custom-file">
                                                   <input type="file" name="answer" class="custom-file-input hidden"
                                                      id="exampleInputFile">
                                                   <label class="custom-file-label" for="exampleInputFile">Choose answer pdf</label>
                                                </div>
                                          </div>
                                          @error('answer')
                                                <p style="color: red;">{{ $message }}</p>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="col-form-label" for="examId">Exam <span
                                                   class="must-filled">*</span></label>
                                          <select class="form-control" name="examId" disabled>
                                                <option value="{{ $exam->id }}" selected>{{ $exam->title }} ->
                                                   {{ $exam->id }}</option>
                                          </select>
                                          @error('examId')
                                                <p style="color: red;">{{ $message }}</p>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                              </fieldset>

                              <div class="card-footer">
                                 <button type="submit" class="btn btn-primary">Update</button>
                                 <a href="{{ URL::previous() }}"><button type="button"
                                          class="btn btn-danger">Back</button></a>
                              </div>
                           </form>
                     </div>
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
               </div>
               <!--/.col (right) -->
         </div>
         <!-- /.row -->
      </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
@endsection

@section('js1')
   <!-- Select2 -->
   <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
   <!-- Bootstrap4 Duallistbox -->
   <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

   <!-- Summernote -->
   <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
   <script>
      $(function() {
         // Summernote
         $('#creative_question').summernote();
         $('#question1').summernote();
         $('#question2').summernote();
         $('#question3').summernote();
         $('#question4').summernote();
      })
   </script>

@endsection

@section('js2')
   <!-- Page script -->
   <script>
      $(function() {
         //Initialize Select2 Elements
         $('.select2').select2()

         //Initialize Select2 Elements
         $('.select2bs4').select2({
               theme: 'bootstrap4'
         })

      })
   </script>
@endsection
