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
                <h1>Parts</h1>
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
