@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Id')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Phonenumber')</th>
                                <th> @lang('Wishtoreserve')</th>
                                <th> @lang('Message')</th>
                                <th> @lang('Date')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phonenumber }}</td>
                                <td>{{ $user->wishtoreserve }}</td>
                                <td>{{ $user->message }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                   
                    </table><!-- table end -->
                </div>
            </div>
        </div><!-- card end -->
    </div>
</div>

{{-- create category --}}
<div id="createCoupon" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @lang('Add New Shipping Method')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.shipping.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-control-label font-weight-bold">
                                @lang('Name') <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control border-radius-5" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-control-label font-weight-bold">@lang('Shipping Charge') <span
                                    class="text-danger">*</span></label>
                            <div class="input-group has_append">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> {{ __($general->cur_sym) }}</div>
                                </div>
                                <input type="number" step="any" name="price" class="form-control border-radius-5"
                                    value="{{ old('price') }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editShipping" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    @lang('Update Shipping Method')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-control-label font-weight-bold">
                                @lang('Name') <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control border-radius-5" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-control-label font-weight-bold">@lang('Shipping Charge') <span
                                    class="text-danger">*</span></label>
                            <div class="input-group has_append">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"> {{ __($general->cur_sym) }}</div>
                                </div>
                                <input type="number" step="any" name="price" class="form-control border-radius-5" />
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="form-control-label font-weight-bold">
                                @lang('Status')</label>
                            <input type="checkbox" id="status" data-width="100%" data-onstyle="-success"
                                data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')"
                                data-off="@lang('Disabled')" name="status">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('breadcrumb-plugins')
<a data-toggle="modal" href="#createCoupon" class="btn btn-sm btn--primary mr-2 d-flex align-items-center add-new-btn">
    <i class="las la-plus"></i> @lang('Add New')
</a>
<form method="GET" class="form-inline float-sm-right bg--white search-form">
    <div class="input-group has_append">
        <input type="text" name="search" id="mySearch" class="form-control" placeholder="@lang('Area name')"
            value="{{ request()->search }}">
        <div class="input-group-append">
            <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>

@endpush
@push('script')
<script>
    (function($) {
            "use strict"
            $('.editButton').on('click', function() {
                var modal = $('#editShipping');
                var id = $(this).data('id');
                var name = $(this).data('name');
                var status = $(this).data('status');
                var price = $(this).data('price');
                modal.find('form').attr('action', `{{ route('admin.shipping.store','') }}/${$(this).data('id')}`);
                modal.find('input[name=name]').val($(this).data('name'));
                modal.find('input[name=price]').val($(this).data('price'));

                if ($(this).data('status') == 1) {
                    modal.find('input[name=status]').bootstrapToggle('on');
                } else {
                    modal.find('input[name=status]').bootstrapToggle('off');
                }
            });
        })(jQuery);
</script>
@endpush