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
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>Posts</h1>
            </div>
        </div>
        <div class="tab-wrapper">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <table class="table table-bordered" id="basic-data-table">
                        <thead>
                            <tr>
                                {{-- <th><input type="checkbox" name="checkbox-all" id="checkbox-all"></th> --}}
                                <th>Sr No</th>
                                <th>User Id</th>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Tech Requirements</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partDetails as $key => $part)
                            <tr>
                                {{-- <td><input type="checkbox" name="checkbox-{{ $part->id }}"
                                        id="checkbox-{{ $part->id }}"></td> --}}
                                <td>{{ ++$i }}</td>
                                <td>{{ $part->user_id }}</td>
                                <td>{{ $part->number }}</td>
                                <td>{{ $part->name }}</td>
                                <td>
                                    <span>
                                        <a type="button" href="{{ route('part-details.edit', $part->id) }}"
                                            class="btn btn-primary"><span class="mdi mdi-pen"></span>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="mx-auto">
                    {{ $partDetails->links("pagination::bootstrap-4") }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#checkbox-all').on('click', function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    })

    $('#exportCsv').on('click', function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    })

    // function exportTableToCSV($table, filename) {

    //     var $rows = $table.find('tr:has(td),tr:has(th)'),

    //         tmpColDelim = String.fromCharCode(11),
    //         tmpRowDelim = String.fromCharCode(0),

    //         colDelim = '","',
    //         rowDelim = '"\r\n"',

    //         csv = '"' + $rows.filter((i, row) => $(row).find("td input:checked").length).map(function (i, row) {
    //             var $row = $(row),
    //                 $cols = $row.find('.exportData');
    //             return $cols.map(function (j, col) {
    //                 var $col = $(col),
    //                     text = $col.text();

    //                 return text.replace(/"/g, '""');
    //             }).get().join(tmpColDelim);

    //         }).get().join(tmpRowDelim)
    //         .split(tmpRowDelim).join(rowDelim)
    //         .split(tmpColDelim).join(colDelim) + '"',

    //         csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    //     if (window.navigator.msSaveBlob) {
    //         window.navigator.msSaveOrOpenBlob(new Blob([csv], {
    //             type: "text/plain;charset=utf-8;"
    //         }), "csvname.csv")
    //     } else {
    //         $(this).attr({
    //             'download': filename,
    //             'href': csvData,
    //             'target': '_blank'
    //         });
    //     }
    // }

    $("#exportCsv").on('click', function (event) {
        exportTableToCSV.apply(this, [$('#basic-data-table'), 'posts.csv']);
    });
</script>
@endsection