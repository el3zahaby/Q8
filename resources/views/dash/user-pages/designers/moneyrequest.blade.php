@extends('layouts.dash')

@push('plugin-styles')
@endpush

@section('content')

<!-- {{ print("<pre>".print_r($items , true)."</pre>") }} -->

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Designers</h4>
                <p class="card-description">
                    <button class="btn btn-success" data-toggle="modal" data-target="#store"><I CLASS="mdi mdi-plus-box"></I>Add new</button>
                </p>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> ID</th>
                                <th>Designer Name</th>
                                <th>Designer Mail</th>
                                <th>Amount</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key=> $item)
                            <tr>
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->first_name . " " . $item->last_name }} </td>
                                <td> {{ $item->email }} </td>
                                <td>  </td>

                                <td>
                                    <!-- delete -->
                                    <a href="{{ route('admin.users.show',$item->id) }}" data-id="{{ $item->id }}" title="DELETE" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>

                                    <!-- edit -->
                                    <a href="{{ route('admin.users.edit',$item->id) }}" data-id="{{ $item->id }}" title="EDIT" class="btn btn-success"><i class="mdi mdi-file-edit"></i></a>


                                    <!-- view -->
                                    <a href="{{ route('admin.users.show',$item->id) }}" data-id="{{ $item->id }}" title="VIEW" class="btn btn-info"><i class="mdi mdi-eye"></i></a>
                                    @if (!$item->hasVerifiedEmail())
                                    <a href="{{ route('admin.users.verify',$item->id) }}" data-id="{{ $item->id }}" title="Verify" class="btn btn-primary"><i class="mdi mdi-hand-okay"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@push('plugin-scripts')

@endpush

@push('custom-scripts')

@endpush