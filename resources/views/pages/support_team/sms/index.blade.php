@extends('layouts.master')
@section('page_title', 'School Messaging Module')
@section('content')

<div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Class Sections</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="sms-students" class="nav-link active" data-toggle="tab">SMS Students</a></li>
                    
                </li>
            </ul>

    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<style>
.ck-editor__editable{
    min-height: 200px;
}
</style>
<div class="tab-content">
    <div class="tab-pane fade show active" id="sms-students">
                        <table class="table datatable-button-html5-columns">
        <div class="col-md-10" id="main-container">
            <div class="col-md-10" id="main-container">
                @if(count($students) > 0)
               
                <h4>@lang('Select Students to Send Message')</h4>
                @endif
                <div class="panel-body">
                <div class="panel panel-default">
                    @if(count($students)>0)
                                     
                      <table class="table datatable-button-html5-columns ">
                          <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox">
                                            <label style="font-weight:bold;">
                                            <input type="checkbox" id="selectAll"> @lang('All')
                                            </label>
                                        </div>
                                    </th>
                                    <th>S/N</th>
                                    <th>@lang('Student Admission')</th>
                                    <th>@lang('Student Name')</th>
                                    <th>@lang('Phone Number')</th>
                                </tr>
</thead>
                                 @foreach ($students as $s) 
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="recipients[]" form="msgForm" value="{{$s->phone}}">
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->username }}</td>
                                    <td>{{ $s-> name }}</td>
                                    <td>{{ $s-> phone }}</td>
                                </tr>
                           @endforeach
                        </table>
                    </div>







                    
                    
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                <form action="{{url('sms')}}" method="POST" id="msgForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="phone" value="{{$s->phone}}">
                            <div class="form-group">
                                <label for="msg">@lang('Write Message'): </label>
                                <textarea name="msg" class="form-control" id="msg" cols="30" rows="10"></textarea>
                            </div>
                    <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons"></i> @lang('Send Message')</button>
                </form>
            </div>
            </div>
            
            <script>
                
                $(function () {
                        var r = $(':checkbox[name="recipients[]"]');
                        $('#selectAll').on('change', function () {
                            if ($(this).is(':checked')) {
                                r.prop('checked', true);
                            } else {
                                r.prop('checked', false);
                            }
                        });
              ClassicEditor
                            .create(document.querySelector('#msg'), {
                                toolbar: ['bold', 'italic','Heading', 'Link', 'bulletedList', 'numberedList', 'blockQuote']
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    });

                </script>
              
                <div class="panel-body">
                    
                </div>              
                @endif
            </div>
        </div>
    </div>
</div>
                
{{--Sms List Ends--}}

              @endsection
