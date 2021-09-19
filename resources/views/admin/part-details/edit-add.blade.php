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
                                {!! Form::text('number', $part->number ?? null, array('placeholder' => 'number','class'
                                =>
                                'form-control', 'readonly' => 'true')) !!}
                            </div>
                            <div class="form-group">
                                <strong>Part Name:</strong>
                                {!! Form::text('name', $part->name ?? null, array('placeholder' => 'name','class' =>
                                'form-control', 'readonly' => 'true')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-primary" href="{{ route('part-details.index') }}"> Back</a>
                            {{-- <button type="submit" class="btn btn-success">{{ isset($part) ? 'Update' : 'Submit' }}</button>
                            --}}
                            <button type="button" id="tech-req" class="btn btn-success">Tech Requirement</button>
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
                                <h2>Tech Req</h2>
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
                    <div class="row">
                        <div class="col-xs-9 col-sm-9 col-md-9">
                            <select id="import-part-dropdown" class="form-control">
                                @foreach ($techReqs as $partNumbers)
                                <option value="{{ $partNumbers->id }}">
                                    {{ $partNumbers->number . '(' . $partNumbers->name . ')' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <input type="button" class="form-control btn btn-primary" id="import-section"
                                value="Import">
                        </div>
                    </div>

                    {!! Form::model(null, ['method' => 'POST', 'id' => 'techReq-form','route' => ['part-details.update', $part]]) !!}
                    <input type="hidden" name="part_detail_id" value="{{ $part->id }}">
                    <div class="row">
                        <div class="col-xs-9 col-sm-9 col-md-9">
                            <select id="section-dropdown" class="form-control">
                                @foreach (App\Models\Section::all() as $section)
                                <option value="{{ $section->id }}" data-type="{{ $section->type }}">{{ $section->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <input type="button" class="form-control btn btn-primary" id="add-section" value="Add">
                        </div>
                    </div>

                    <div id="add-section-table" style="display: block;">
                        <table class="table table-bordered" id="basic-data-table">
                            <thead>
                                <tr>
                                    <th>Section Name</th>
                                    <th>Sequence</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($part->techReqs))
                                @foreach ($part->techReqs as $techReqs)
                                <tr id="section-row-{{ $techReqs->section_id }}" data-id="{{ $techReqs->section_id }}">
                                    <td>{{ $techReqs->section_name }}</td>
                                    <td>{{ $techReqs->sequence }}</td>
                                    <td>
                                        <span>
                                            <button type="button" class="btn btn-danger remove-section" value="Delete"
                                                data-id="{{ $techReqs->section_id }}" data-sequence="` + sequence + `"
                                                data-type="{{ $techReqs->section->type }}"
                                                id='remove-section{{ $techReqs->section_id }}'>
                                                <span class="mdi mdi-delete"></span>
                                            </button>
                                        </span>
                                    </td>
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
                                name="section[{{ $techReqs->section_id }}][section_name][]">
                            <table class="table table-bordered" data-type="{{ $techReqs->section->type }}">
                                @if ($techReqs->section->type === 1)
                                <thead>
                                    <tr>
                                        <th>Parameters</th>
                                        <th>Specification*</th>
                                        <th>Test method</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (json_decode($techReqs->parameters, true) as $key => $value)
                                    @foreach ($value as $k => $v)
                                    <tr>
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][params][]"
                                                value="{{ $k }}" id="">
                                        </td>
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][specs][]"
                                                value="{{ $v['specs'] }}" class="specifications" id="">
                                        </td>
                                        <td>
                                            <input type="text"
                                                name="section[{{ $techReqs->section->type }}][testMethod][]"
                                                value="{{ $v['test_method'] }}" id="">
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
                                        <td>
                                            <input type="text"
                                                name="section[{{ $techReqs->section->type }}][elements][]"
                                                value="{{ $k }}" class="form-control" size="2" id=""
                                                style="padding:0.2rem !important;">
                                        </td>
                                        @endforeach
                                        @endforeach
                                    </tr>
                                    <tr id="minRow">
                                        <th>Min*</th>
                                        @foreach (json_decode($techReqs->parameters, true) as $key => $value)
                                        @foreach ($value as $k => $v)
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][min][]"
                                                value="{{ $v['min'] }}" class="form-control min" size="4" id=""
                                                style="padding:0.2rem !important;">
                                        </td>
                                        @endforeach
                                        @endforeach
                                    </tr>
                                    <tr id="maxRow">
                                        <th>Max*</th>
                                        @foreach (json_decode($techReqs->parameters, true) as $key => $value)
                                        @foreach ($value as $k => $v)
                                        <td>
                                            <input type="text" name="section[{{ $techReqs->section->type }}][max][]"
                                                value="{{ $v['max'] }}" class="form-control max" size="4" id=""
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
                        <button type="submit" class="btn btn-success" id="update-tech-req">Update</button>
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
    let sequence = $('#basic-data-table tbody tr').length > 0 ? $('#basic-data-table tbody tr').length + 1 : 1  
    // if ('#basic-data-table tr').length()

    $('#tech-req').on('click', function () {
        $('#tech-req-div').toggle()
    })

    $('#add-section').on('click', function () {
        let section = $('#section-dropdown :selected')

        let repeatSection = 0
        $("#add-section-table tbody tr").each(function () {
            if ($.trim($(this).find('td').eq(0).text()) === $.trim(section.text())) repeatSection = 1
        });
        if (repeatSection === 1) alert('Section already present')
        else {
            let $type1Table
            if ($.trim(section.data('type')) === 1) {
                $type1Table =
                    `
                    <div id="section-fields-table-` + section.val() + `" style="display: block;">
                        <input type="hidden" value="` + $.trim(section.val()) + `" name="section[` + $.trim(section
                        .val()) + `][section_id][]">
                        <input type="hidden" value="` + $.trim(section.data('type')) + `" name="section[` + $.trim(
                        section.val()) + `][section_type][]">
                        <input type="hidden" value="` + sequence + `" name="section[` + $.trim(section.val()) +
                    `][sequence][]" id="sectionSequence` + $.trim(section.val()) + `">
                        <input type="text" value="` + $.trim(section.text()) + `" name="section[` + $.trim(section
                    .val()) + `][section_name][]">
                        <table class="table table-bordered" data-type="` + $.trim(section.data('type')) + `">
                            <thead>
                                <tr>
                                    <th>Parameters</th>
                                    <th>Specification*</th>
                                    <th>Test method</th>
                                </tr>
                            </thead>
                            <tbody>
    
                            </tbody>
                        </table>
                    </div>
                `
            } else {
                $type1Table =
                    `
                    <div id="section-fields-table-` + section.val() + `" style="display: block;">
                        <input type="hidden" value="` + $.trim(section.val()) + `" name="section[` + $.trim(section
                        .val()) + `][section_id][]">
                        <input type="hidden" value="` + $.trim(section.data('type')) + `" name="section[` + $.trim(
                        section.val()) + `][section_type][]">
                        <input type="hidden" value="` + sequence + `" name="section[` + $.trim(section.val()) +
                    `][sequence][]" id="sectionSequence` + $.trim(section.val()) + `">
                        <input type="text" value="` + $.trim(section.text()) + `" name="section[` + $.trim(section
                    .val()) + `][section_name][]">
                        <table class="table table-bordered table-responsive"  data-type="` + $.trim(section.data('type')) + `">
                            <tbody>
                                <tr id="elementsRow">
                                    <th>Elements</th>
                                </tr>
                                <tr id="minRow">
                                    <th>Min*</th>
                                </tr>
                                <tr id="maxRow">
                                    <th>Max*</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `
            }

            $('#field-parameter-tables-div').append($type1Table)

            let td = `
                <tr id="section-row-` + section.val() + `" data-id="` + section.val() + `">
                    <td>` + section.text() + `</td>
                    <td>` + sequence + `</td>
                    <td>
                        <span>
                            <button type="button" class="btn btn-danger remove-section" value="Delete" data-id="` +
                section.val() + `" data-sequence="` + sequence + `" data-type="` + section.data('type') +
                `" id='remove-section` + section.val() + `'>
                                <span class="mdi mdi-delete"></span>
                            </button>
                        </span>
                    </td>
                </tr>
            `
            $('#basic-data-table tbody').append(td)

            $.ajax({
                url: "/api/section-fields/" + section.val(),
                // cache: false,
                success: function (res) {
                    if (section.data('type') === 1) {
                        $('#section-fields-table-' + section.val() + ' tbody').empty()

                        res.forEach(element => {
                            let trParam1 = `
                                <tr>
                                    <td>
                                        <input type="text" name="section[` + $.trim(section.val()) +
                                `][params][]" value="` + element.parameter + `" id="">
                                    </td>
                                    <td>
                                        <input type="text" name="section[` + $.trim(section.val()) + `][specs][]"  class="specifications" value="" id="">
                                    </td>
                                    <td>
                                        <input type="text" name="section[` + $.trim(section.val()) + `][testMethod][]" value="" id="">
                                    </td>
                                </tr>
                            `

                            $('#section-fields-table-' + section.val() + ' tbody').append(
                                trParam1)
                        });
                    } else {
                        $('#section-fields-table-' + section.val() + ' tbody tr th td').empty()
                        res.forEach(element => {
                            let tdElement = `
                                <td>
                                    <input type="text" name="section[` + $.trim(section.val()) +
                                `][elements][]" value="` + element.parameter + `" class="form-control" size="2" id="" style="padding:0.2rem !important;">
                                </td>
                            `
                            let tdMin = `
                                <td>
                                    <input type="text" name="section[` + $.trim(section.val()) + `][min][]" value="" class="form-control min" size="4" id="" style="padding:0.2rem !important;">
                                </td>
                            `
                            let tdMax = `
                                <td>
                                    <input type="text" name="section[` + $.trim(section.val()) + `][max][]" value="" class="form-control" size="4" id="" style="padding:0.2rem !important;">
                                </td>
                            `

                            $('#elementsRow').append(tdElement)
                            $('#minRow').append(tdMin)
                            $('#maxRow').append(tdMax)
                        });
                    }
                    sequence++
                }
            });
        }
    })

    $(document).on('click', '.remove-section', function () {
        $('#section-row-' + $(this).data('id')).remove()
        $('#section-fields-table-' + $(this).data('type')).remove()

        sequence = 1
        $("#add-section-table tbody tr").each(function () {
            $('#sectionSequence' + $(this).data('id')).val(sequence)
            $(this).find('td').eq(1).text(sequence)
            $(this).find('button').attr('data-sequence', sequence)
            sequence++
        });
    })

    function importData() {
        $('#basic-data-table tbody, #field-parameter-tables-div').empty()
        let importSection = $('#import-part-dropdown :selected')

        $.ajax({
            url: "/api/techreq/" + importSection.val(),
            // cache: false,
            success: function (res) {
                res.forEach(element => {
                    let td = `
                        <tr id="section-row-` + element.section.id + `" data-id="` + element.section.id + `">
                            <td>` + element.section.name + `</td>
                            <td>` + element.sequence +
                        `</td>
                            <td>
                                <span>
                                    <button type="button" class="btn btn-danger remove-section" value="Delete" data-id="` +
                        element.section.id + `" data-sequence="` + element.sequence +
                        `" data-type="` + element.section.type +
                        `" id='remove-section` + element.section.id + `'>
                                        <span class="mdi mdi-delete"></span>
                                    </button>
                                </span>
                            </td>
                        </tr>
                    `
                    $('#basic-data-table tbody').append(td)
                    if (element.section.type === 1) {
                        $type1Table =
                            `
                            <div id="section-fields-table-` + element.section.id + `" style="display: block;">
                                <input type="hidden" value="` + $.trim(element.section.id) + `" name="section[` + $
                            .trim(element.section.id) + `][section_id][]">
                                <input type="hidden" value="` + $.trim(element.section.type) + `" name="section[` + $
                            .trim(element.section.id) + `][section_type][]">
                                <input type="hidden" value="` + element.sequence + `" name="section[` + $.trim(element
                                .section.id) + `][sequence][]" id="sectionSequence` + $.trim(element
                                .sequence) + `">
                                <input type="text" value="` + $.trim(element.section_name) + `" name="section[` + $
                            .trim(element.section.id) + `][section_name][]">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Parameters</th>
                                            <th>Specification*</th>
                                            <th>Test method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
                                    </tbody>
                                </table>
                            </div>
                        `
                        $('#field-parameter-tables-div').append($type1Table)

                        let parametersType1 = JSON.parse(element.parameters)
                        $('#section-fields-table-' + element.section.id + ' tbody').empty()
                        parametersType1.forEach(fields => {
                            $.map(fields, function (val, key) {
                                let specsVal = val.specs ?? ""
                                let testMethodVal = val.test_method ?? ""
                                let trParam1Import = `
                                    <tr>
                                        <td>
                                            <input type="text" name="section[` + element.section.id +
                                    `][params][]" value="` + key + `" id="">
                                        </td>
                                        <td>
                                            <input type="text" name="section[` + element.section.id +
                                    `][specs][]"  class="specifications" value="` + specsVal + `" id="">
                                        </td>
                                        <td>
                                            <input type="text" name="section[` + element.section.id +
                                    `][testMethod][]" value="` + testMethodVal + `" id="">
                                        </td>
                                    </tr>
                                `
                                $('#section-fields-table-' + element.section.id +
                                    ' tbody').append(trParam1Import)
                            })
                        });
                    } else {
                        $type1Table =
                            `
                            <div id="section-fields-table-` + element.section.id + `" style="display: block;">
                                <input type="hidden" value="` + $.trim(element.section.id) + `" name="section[` + $
                            .trim(element.section.id) + `][section_id][]">
                                <input type="hidden" value="` + $.trim(element.section.type) + `" name="section[` + $
                            .trim(element.section.id) + `][section_type][]">
                                <input type="hidden" value="` + element.sequence + `" name="section[` + $.trim(element
                                .section.id) + `][sequence][]" id="sectionSequence` + $.trim(element
                                .sequence) + `">
                                <input type="text" value="` + $.trim(element.section_name) + `" name="section[` + $
                            .trim(element.section.id) + `][section_name][]">
                                <table class="table table-bordered table-responsive">
                                    <tbody>
                                        <tr id="elementsRow">
                                            <th>Elements</th>
                                        </tr>
                                        <tr id="minRow">
                                            <th>Min*</th>
                                        </tr>
                                        <tr id="maxRow">
                                            <th>Max*</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        `
                        $('#field-parameter-tables-div').append($type1Table)

                        let parametersType2 = JSON.parse(element.parameters)
                        parametersType2.forEach(fields => {
                            $.map(fields, function (val, key) {
                                let minVal = val.min ?? ""
                                let maxVal = val.max ?? ""

                                let tdElement = `
                                    <td>
                                        <input type="text" name="section[` + element.section.id +
                                    `][elements][]" value="` + key + `" class="form-control" size="2" id="" style="padding:0.2rem !important;">
                                    </td>
                                `
                                let tdMin = `
                                    <td>
                                        <input type="text" name="section[` + element.section.id + `][min][]" value="` +
                                    minVal + `" class="form-control min" size="4" id="" style="padding:0.2rem !important;">
                                    </td>
                                `
                                let tdMax = `
                                    <td>
                                        <input type="text" name="section[` + element.section.id + `][max][]" value="` +
                                    maxVal + `" class="form-control" size="4" id="" style="padding:0.2rem !important;">
                                    </td>
                                `

                                $('#elementsRow').append(tdElement)
                                $('#minRow').append(tdMin)
                                $('#maxRow').append(tdMax)
                            })
                        });
                    }
                });
            }
        });
    }
    $('#import-section').on('click', function () {
        importData()
    })

    $('#update-tech-req').on('click', function (e) {
        e.preventDefault();
        let sectionTable = $('#basic-data-table tbody tr')
        if (sectionTable.length > 0) {
            let checkAllEmptySpecs = false
            let checkAllEmptyMin = false
            $($('#field-parameter-tables-div table')).each(function () {
                if ($(this).data('type') === 1) {
                    checkAllEmptySpecs = true
                    $($(this).find('.specifications')).each(function () {
                        if ($(this).val() != '') {
                            checkAllEmptySpecs = false
                        }
                    })
                } else {
                    checkAllEmptyMin = true
                    $($(this).find('tbody td')).find('.min').each(function () {
                        if ($(this).val() != '') {
                            checkAllEmptyMin = false
                        }
                    })
                }

            })
            console.log(checkAllEmptySpecs, checkAllEmptyMin)
            if (checkAllEmptySpecs || checkAllEmptyMin) {
                if(checkAllEmptySpecs) alert('Fill Atleast 1 Specs')
                else alert('Fill Atleast 1 Min')
            } else {
                $('#techReq-form').submit()
            }
        }
        else alert('Select at least 1 section')
    })
</script>
@endsection