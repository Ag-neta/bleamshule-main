@extends('layouts.app')

@section('title', __('Send Sms'))
@section ('content')
<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<style>
.ck-editor__editable{
    min-height: 200px;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <h2>@lang('Send Sms To Teachers')</h2>
            <div class="col-md-10" id="main-container">
                @if(count($teachers) > 0)
                @foreach ($teachers as $teacher)
                @break
                @endforeach
                <h4>@lang('Select Teachers to send message to')</h4>
                @endif
                <div class="panel-body">
                <div class="panel panel-default">
            
                        
                            <table class="table table-data-div table-bordered table-condensed table-striped">
                            <div class="col-md-6">    
                            <div class="table-responsive">
                               
                                    <thead>
                                <tr>
                                    <th>
                                        <div class="checkbox">
                                            <label style="font-weight:bold;">
                                            <input type="checkbox" id="selectAll"> @lang('All')
                                            </label>
                                        </div>
                                    </th>
                                    <th>@lang('Teacher code')</th>
                                    <th>@lang('Teacher name')</th>
                                    <th>@lang('Phone number')</th>
                                </tr>
                                </thead>
                                @foreach ($teachers as $teacher)
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="recipients[]" form="msgForm" value="{{$teacher->phone_number}}">
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{$teacher->code}}</td>
                                    <td>{{$teacher->name}}</td> 
                                    <td>{{$teacher->phone_number}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-6">
                        @if (session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{url('messages/sms_teachers')}}" method="POST" id="msgForm">
                            {{ csrf_field() }}
                             <input type="hidden" name="school_id" value="">
                            <div class="form-group">
                                <label for="msg">@lang('Write Customized Message'): </label>
                                <textarea name="msg" class="form-control" id="msg" cols="30" rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">send</i> @lang('Send Message')</button>
                        </form>
                </div>
                </div>
                <script>
                    $(function () {
                        var r = $(':checkbox[name="recipients[]"]');
                        $('#selectAll').on('change',function() {
                            if ($(this).is(':checked')) {
                                r.prop('checked', true);
                            } else {
                                r.prop('checked',false);
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
                
                </div>
             </div>
         </div>
   </div>




                @endsection

