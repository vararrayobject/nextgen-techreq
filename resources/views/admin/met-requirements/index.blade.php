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
                                {{-- <th><input type="checkbox" name="checkbox-all" id="checkbox-all"></th> --}}
                                <th>Sr No</th>
                                <th>User Id</th>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Met Requirements</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($metRequirements as $key => $met)
                            <tr>
                                {{-- <td><input type="checkbox" name="checkbox-{{ $met->id }}"
                                        id="checkbox-{{ $met->id }}"></td> --}}
                                <td>{{ ++$i }}</td>
                                <td>{{ $met->user_id }}</td>
                                <td>{{ $met->number }}</td>
                                <td>{{ $met->name }}</td>
                                <td>
                                    <span>
                                        <a type="button" href="{{ route('met-requirements.edit', $met->id) }}"
                                            class="btn btn-warning"><span class="mdi mdi-pen"></span>
                                        </a>
                                    </span>
                                    @if ($met->metReqs)
                                    <span>
                                        <a type="button" href="{{ route('met-requirements.show', $met->id) }}"
                                            class="btn btn-success"><span class="mdi mdi-eye"></span>
                                        </a>
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="mx-auto">
                    {{ $metRequirements->links("pagination::bootstrap-4") }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
