@extends('layouts.show')

@php
    $status = $record->status ?? 'inactive';    
    $id = $record->id ?? 0;
@endphp

@section('form-title')
    Reviewers @if( 0 == $id) "New"  @endif
@endsection

@section('action-buttons')
    @if (0 != $id)
        <button class="btn btn-sm btn-danger" onclick="deleteRecord()"><i class="fas fa-trash"></i>Delete</button>                
    @endif
    <button class="btn btn-sm btn-success" onclick="$('form#main').submit()"><i class="fas fa-save"></i>{{ empty($record->ide) ? 'Save' : 'Update' }}</button>
    <button class="btn btn-sm btn-secondary" onclick="window.close()"><i class="fas fa-times"></i>Close</button>
@endsection

@section('card-body')
    @if (!empty($record->id))
        @method('PUT')    
    @endif
    
    <input type="hidden" name="id" value="{{$record->id ?? ''}}">
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('reviewer_name', 'Name:', ['class' => 'control-label']) !!}
                {!! Form::text('reviewer_name', $record->name ?? '', ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
                {!! Form::select('status', ['inactive' => 'Inactive', 'active' => 'Active'], $record->status ?? 'inactive', ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-2">
                {!! Form::label('category', 'Category:', ['class' => 'control-label']) !!}
                {!! Form::select('category', [
                        'accounting' => 'Accounting',
                        'engineering' => 'Engineering',
                        'civil-service' => 'Civil Service',
                        'entrance-exam' => 'Entrance Exam',
                        'nursing' => 'Nursing',
                        'medicine' => 'Medicine',
                        'education' => 'Education',
                        'law' => 'Law',
                        'others' => 'Others',
                        ], $record->category ?? 'other', ['class' => 'form-control']) !!}
            </div>
        </div>

    </div>
    
   
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                {!! Form::label('questionnaires_to_display', 'Questionnaires to display:', ['class' => 'control-label']) !!}
                {!! Form::select('questionnaires_to_display', ['10' => '10 questions', 
                                                '20' => '20 questions',
                                                '30' => '30 questions',
                                                '40' => '40 questions',
                                                '50' => '50 questions',
                                                '60' => '60 questions',], $record->questionnaires_to_display ?? '30', ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('time_limit', 'Time limit:', ['class' => 'control-label']) !!}
                {!! Form::select('time_limit', ['10' => '10 minutes', 
                                                '20' => '20 minutes',
                                                '30' => '30 minutes',
                                                '40' => '40 minutes',
                                                '50' => '50 minutes',
                                                '60' => '60 minutes',], $record->time_limit ?? '30', ['class' => 'form-control']    ) !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('price', 'Price:', ['class' => 'control-label']) !!}
                {!! Form::text('price', $record->price ?? '30', ['class' => 'form-control']) !!} 
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                
                {!! Form::label('cover_photo', 'Cover photo:', ['class' => 'control-label']) !!}
                {!! Form::file('cover_photo', ['class' => 'form-control', 'accept' => 'image/*']) !!}          
            </div>
            <div class="col-md-6 existingImg">
                <input type='hidden' name='remove_cover_photo' value="no" />
                @if (''!=$record->cover_photo)
                    <label class="control-label">Existing image <input type='button' class="btn btn-sm btn-danger" onclick="removeCoverPhoto()" value='Remove' /></label>
                    <br/>
                    <a href="{{ env('AWS_S3_URL') . $record->cover_photo }}" target="cover_photo">
                        <img height="60px" src="{{ env('AWS_S3_URL') . $record->cover_photo }}">
                    </a>                    
                @endif

            </div>            
        </div>

        <div class="row" style="margin-top:20px;">
            <div class="col-md-12">
                @if (0 != $id)
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="learningmaterial-tab" data-toggle="tab" href="#learningmaterial" role="tab" aria-controls="learningmaterial" aria-selected="true">Learning materials</a>
                        </li>
                        <li class="nav-item">                    
                            <a class="nav-link" id="questionnaire-tab" data-toggle="tab" href="#questionnaire" role="tab" aria-controls="questionnaire" aria-selected="false">Questionnaires</a>
                        </li>
                    </ul>
                    <div class="row tab tab-content">                
                        <div class="col-md-12 tab-pane fade show active" id="learningmaterial" role="tabpanel" aria-labelledby="learningmaterial-tab"><livewire:learningmaterial-list :reviewer_id="$record->id"/></div>
                        <div class="col-md-12 tab-pane fade" id="questionnaire" role="tabpanel" aria-labelledby="questionnaire-tab"><livewire:questionnaire-list :reviewer_id="$record->id"/></div>
                    </div>
                @else
                    <span class="text-muted font-italic">Learning materials & questionnaires will be available when you save the reviewer.</span>
                @endif            
            </div>
        </div>
     
    </div>  


    <script type="text/javascript">      

        document.addEventListener('DOMContentLoaded', function(){ 
    
            removeCoverPhoto = function(){
                $('.existingImg input[name=remove_cover_photo]').val('yes');
                $('.existingImg').hide();            
            }

            $('ul.nav li.nav-item input').on('click', function(e){
                // toggle tabs
                $('ul.nav li.nav-item input').removeClass('active');
                $(this).addClass('active');
                // toggle tabs content
                $('div.tab').hide();
                $('div.' + $(this).attr('tab')).show();
            });

        }, false);
    
    
    </script>    
@endsection




