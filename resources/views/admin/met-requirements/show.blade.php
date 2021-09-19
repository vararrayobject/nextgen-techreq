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
                {{-- @dd(count($metDetails->techReqs)) --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Part Number:</strong>
                                {!! Form::text('number', $metDetails->partDetail->number ?? null, array('placeholder' =>
                                'number','class' => 'form-control', 'readonly' => 'true')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Part Name:</strong>
                                {!! Form::text('name', $metDetails->partDetail->name?? null, array('placeholder' =>
                                'name','class' =>
                                'form-control', 'readonly' => 'true')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" href="{{ route('met-requirements.index') }}"> Back</a>
                            {{-- <button type="submit" class="btn btn-success">{{ isset($metDetails) ? 'Update' : 'Submit' }}</button>
                            --}}
                            <button type="button" id="tech-req" class="btn btn-success">Met Requirement</button>
                        </div>
                    </div>
                    <p class="text-center text-primary"><small></small></p>

                </div>
            </div>

            <div class="card" id="tech-req-div" style="display: block;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2>Met Requirements</h2>
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
                                {{-- @dd($metDetails) --}}
                                @foreach (json_decode($metDetails->final_values) as $item)
                                {{-- @dd($item) --}}
                                <tr id="section-row-{{ $item->section_id }}" data-id="{{ $item->section_id }}">
                                    <td>{{ $item->section_name }}</td>
                                    <td>{{ $item->sequence }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- here --}}
                    <div class="card" id="field-parameter-tables-div" style="display: block;">
                        @foreach (json_decode($metDetails->final_values) as $metItem)
                        <div id="section-fields-table-{{ $metItem->section_id }}" style="display: block;">
                            <input type="text" value="{{ $metItem->section_name }}"
                                name="section[{{ $metItem->section_id }}][section_name][]" readonly>
                            <table class="table table-bordered" data-type="{{ $metItem->section_type }}">
                                @if ($metItem->section_type == 1)

                                <thead>
                                    <tr>
                                        <th>Parameters</th>
                                        <th>Specification*</th>
                                        <th>Test method</th>
                                        <th>Observations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($metItem->fields as $k => $v)
                                    <tr>
                                        <td>
                                            <input type="text" name="section[{{ $metItem->section_type }}][params][]"
                                                value="{{ $k }}" id="" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="section[{{ $metItem->section_type }}][specs][]"
                                                value="{{ $v->specs }}" class="specifications" id="" readonly>
                                        </td>
                                        <td>
                                            <input type="text"
                                                name="section[{{ $metItem->section_type }}][testMethod][]"
                                                value="{{ $v->test_method }}" id="" readonly>
                                        </td>
                                        <td>
                                            <input type="text"
                                                name="section[{{ $metItem->section_type }}][observations][]"
                                                value="{{ $v->observations }}" id="" readonly>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                                @else
                                <tbody>
                                    <tr id="elementsRow">
                                        <th>Elements</th>
                                        @foreach ($metItem->fields as $k => $v)
                                        <td>
                                            <input type="text" name="section[{{ $metItem->section_type }}][elements][]"
                                                value="{{ $k }}" class="form-control" size="2" id=""
                                                style="padding:0.2rem !important;" readonly>
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr id="minRow">
                                        <th>Min*</th>
                                        @foreach ($metItem->fields as $k => $v)
                                        <td>
                                            <input type="text" name="section[{{ $metItem->section_type }}][min][]"
                                                value="{{ $v->min }}" class="form-control min" size="4" id=""
                                                style="padding:0.2rem !important;" readonly>
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr id="maxRow">
                                        <th>Max*</th>
                                        @foreach ($metItem->fields as $k => $v)
                                        <td>
                                            <input type="text" name="section[{{ $metItem->section_type }}][max][]"
                                                value="{{ $v->max }}" class="form-control max" size="4" id=""
                                                style="padding:0.2rem !important;" readonly>
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr id="actuals">
                                        <th>Actuals*</th>
                                        @foreach ($metItem->fields as $k => $v)
                                        <td>
                                            <input type="text" name="section[{{ $metItem->section_type }}][actuals][]"
                                                value="{{ $v->actuals }}" class="form-control actuals" size="4" id=""
                                                style="padding:0.2rem !important;" readonly>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                                @endif
                            </table>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
