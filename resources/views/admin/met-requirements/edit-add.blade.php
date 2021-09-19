{{-- 
/**
 * ==================================================================================================
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
 * ==================================================================================================
 */
--}}

@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="col-12">
        <div class="tab-wrapper">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Edit Part</h2>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @dd(count($part->techReqs)) --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Part Number:</strong>
                                {!! Form::text('number', $part->number ?? null, array('placeholder' => 'number','class' => 'form-control', 'readonly' => 'true')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Part Name:</strong>
                                {!! Form::text('name', $part->name ?? null, array('placeholder' => 'name','class' =>
                                'form-control', 'readonly' => 'true')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" href="{{ route('met-requirements.index') }}"> Back</a>
                            {{-- <button type="submit" class="btn btn-success">{{ isset($part) ? 'Update' : 'Submit' }}</button>
                            --}}
                            <button type="button" id="tech-req" class="btn btn-success">Met Requirement</button>
                        </div>
                    </div>
                    <p class="text-center text-primary"><small></small></p>

                </div>
            </div>

            <div class="card" id="tech-req-div" style="display: {{ count($part->techReqs) > 0 ? 'block' : 'none' }};">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Met Requirement</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {!! Form::model(null, ['method' => 'POST', 'id' => 'metReq-form','route' => ['met-requirements.update', $part]]) !!}
                    <input type="hidden" name="part_detail_id" value="{{ $part->id }}">

                    <div id="add-section-table" style="display: block;">
                        <table class="table table-bordered" id="basic-data-table">
                            <thead>
                                <tr>
                                    <th>Section Name</th>
                                    <th>Sequence</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($part->techReqs))
                                @foreach ($part->techReqs as $techReqs)
                                <tr id="section-row-{{ $techReqs->section_id }}" data-id="{{ $techReqs->section_id }}">
                                    <td>{{ $techReqs->section_name }}</td>
                                    <td>{{ $techReqs->sequence }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="card" id="field-parameter-tables-div" style="display: block;">
                        @if (count($part->techReqs))
                        @foreach ($part->techReqs as $techReqs)
                        <div id="section-fields-table-{{ $techReqs->section_id }}" style="display: block;">
                            <input type="hidden" value="{{ $techReqs->section_id }}"
                                name="section[{{ $techReqs->section_id }}][section_id][]">
                            <input type="hidden" value="{{ $techReqs->section->type }}"
                                name="section[{{ $techReqs->section_id }}][section_type][]">
                            <input type="hidden" value="{{ $techReqs->sequence }}"
                                name="section[{{ $techReqs->section_id }}][sequence][]"
                                id="sectionSequence{{ $techReqs->section_id }}">
                            <input type="text" value="{{ $techReqs->section_name }}"
                                name="section[{{ $techReqs->section_id }}][section_name][]" readonly>
                            <table class="table table-bordered" data-type="{{ $techReqs->section->type }}">
                                @if ($techReqs->section->type === 1)
                                <thead>
                                    <tr>
                                        <th>Parameters</th>
                                        <th>Specification*</th>
                                        <th>Test method</th>
                                        <th>Observations*</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (json_decode($techReqs->parameters, true) as $key => $value)
                                    @foreach ($value as $k => $v)
                                    {{-- @dump($v['specs']) --}}
                                    @if (!$v['specs'])
                                        @continue
                                    @endif
                                    <tr>
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][params][]"
                                                value="{{ $k }}" id="" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][specs][]"
                                                value="{{ $v['specs'] }}" class="specifications" id="" readonly>
                                        </td>
                                        <td>
                                            <input type="text"
                                                name="section[{{ $techReqs->section->type }}][testMethod][]"
                                                value="{{ $v['test_method'] }}" id="" readonly>
                                        </td>
                                        <td>
                                            <input type="text"
                                                name="section[{{ $techReqs->section->type }}][observations][]"
                                                value="" class="observations" id="">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>

                                @else
                                <tbody>
                                    <tr id="elementsRow">
                                        <th>Elements</th>
                                        @foreach (json_decode($techReqs->parameters, true) as $key => $value)
                                        @foreach ($value as $k => $v)
                                        @if (!$v['min'])
                                            @continue
                                        @endif
                                        <td>
                                            <input type="text"
                                                name="section[{{ $techReqs->section->type }}][elements][]"
                                                value="{{ $k }}" class="form-control" size="2" id=""
                                                style="padding:0.2rem !important;" readonly>
                                        </td>
                                        @endforeach
                                        @endforeach
                                    </tr>
                                    <tr id="minRow">
                                        <th>Min*</th>
                                        @foreach (json_decode($techReqs->parameters, true) as $key => $value)
                                        @foreach ($value as $k => $v)
                                        @if (!$v['min'])
                                            @continue
                                        @endif
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][min][]"
                                                value="{{ $v['min'] }}" class="form-control min" size="4" id=""
                                                style="padding:0.2rem !important;" readonly>
                                        </td>
                                        @endforeach
                                        @endforeach
                                    </tr>
                                    <tr id="maxRow">
                                        <th>Max*</th>
                                        @foreach (json_decode($techReqs->parameters, true) as $key => $value)
                                        @foreach ($value as $k => $v)
                                        @if (!$v['min'])
                                            @continue
                                        @endif
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][max][]"
                                                value="{{ $v['max'] }}" class="form-control max" size="4" id=""
                                                style="padding:0.2rem !important;" readonly>
                                        </td>
                                        @endforeach
                                        @endforeach
                                    </tr>
                                    <tr id="actuals">
                                        <th>Actuals*</th>
                                        @foreach (json_decode($techReqs->parameters, true) as $key => $value)
                                        @foreach ($value as $k => $v)
                                        @if (!$v['min'])
                                            @continue
                                        @endif
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][actuals][]"
                                                value="" class="form-control actuals" size="4" id=""
                                                style="padding:0.2rem !important;">
                                        </td>
                                        @endforeach
                                        @endforeach
                                    </tr>
                                </tbody>
                                @endif
                            </table>
                        </div>
                        @endforeach
                        @endif

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-success" id="update-tech-req">Submit</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let checkAllObservations = false
    let checkAllActuals = false
    $('#update-tech-req').on('click', function (e) {
        e.preventDefault();
        // console.log($('#field-parameter-tables-div table').find('.observations').length)
        observationsLength = $('#field-parameter-tables-div table').find('.observations').length
        if (observationsLength > 0) {
            checkAllObservations = false
            $($('#field-parameter-tables-div table').find('.observations')).each(function () {
                // console.log($(this).val())
                if ($(this).val() === '') {
                    checkAllObservations = true        
                }
            })
        }

        actualsLength = $('#field-parameter-tables-div table').find('.actuals').length
        if (actualsLength > 0) {
            checkAllActuals = false
            $($('#field-parameter-tables-div table').find('.actuals')).each(function () {
                if ($(this).val() === '') {
                    checkAllActuals = true        
                }
            })
        }
        if (checkAllObservations || checkAllActuals) {
            if(checkAllObservations) alert('Fill All Observations')
            else alert('Fill All Actuals')
        } else {
            $('#metReq-form').submit()
        }
    })
</script>
@endsection