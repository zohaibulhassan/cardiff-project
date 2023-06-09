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
                                    <th>@lang('id')</th>
                                    <th>@lang('User Name')</th>
                                    <th>@lang('Role')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Created Date')</th>
                                    <th> @lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.coupon.delete', $user->id) }}"><i
                                                    class="fa fa-trash"></i></a>
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

    <div id="createCoupon" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @lang('Add New Coupon')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form action="{{ route('admin.coupon.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">


                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Username') <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" />
                        </div>


                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Role') <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" readonly value="Manager" />
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Email') <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                        </div>


                     

                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Password')</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--primary w-100">@lang('Submit')</button>
                        </div>
                </form>
            </div>
        </div>
    </div>


    <div id="editCoupon" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @lang('Update Coupon')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Name') <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Amount') <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="discount" class="form-control" value="{{ old('discount') }}" />
                                <div class="input-group-append">
                                    <select name="discount_type" class="input-group-text">
                                        <option value="1">{{ __($general->cur_text) }}</option>
                                        <option value="2">@lang('%')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                @lang('Minimum Order') <span class="text-danger">*</span>
                            </label>

                            <div class="input-group has_append">
                                <div class="input-group has_append">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"> {{ __($general->cur_sym) }}</div>
                                    </div>
                                    <input type="number" name="min_order" class="form-control"
                                        value="{{ old('min_order') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="date">@lang('Start Date') <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="datepicker-here form-control" data-language='en'
                                data-date-format="yyyy-mm-dd" data-position='bottom left'
                                placeholder="@lang('Select date')" name="start_date" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="date">@lang('End Date') <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="datepicker-here form-control" data-language='en'
                                data-date-format="yyyy-mm-dd" data-position='bottom left'
                                placeholder="@lang('Select date')" name="end_date" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">
                                @lang('Status')</label>
                            <input type="checkbox" id="status" data-width="100%" data-onstyle="-success"
                                data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')"
                                data-off="@lang('Disabled')" name="status">
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
    <a data-toggle="modal" href="#createCoupon"
        class="btn btn-sm btn--primary mr-2 d-flex align-items-center add-new-btn"><i class="las la-plus"></i>
        @lang('Add
            New')
    </a>

    <form method="GET" class="form-inline float-sm-right bg--white search-form">
        <div class="input-group has_append">
            <input type="text" name="search" id="mySearch" class="form-control" placeholder="@lang('Coupon name')"
                value="{{ request()->search }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush
@push('script')
    <script>
        $('.datepicker-here').datepicker();

        (function($) {
            "use strict"


            $('.editButton').on('click', function() {
                var modal = $('#editCoupon');
                modal.find('form').attr('action',
                `{{ route('admin.coupon.store', '') }}/${$(this).data('id')}`);
                var name = $(this).data('name');
                var status = $(this).data('status');
                var end_date = $(this).data('end_date');
                var start_date = $(this).data('start_date');
                var discount = $(this).data('discount');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('input[name=name]').val($(this).data('name'));
                modal.find('input[name=discount]').val(parseFloat($(this).data('discount')).toFixed(2));
                modal.find('input[name=end_date]').val($(this).data('end_date'));
                modal.find('input[name=min_order]').val(parseFloat($(this).data('min_order')).toFixed(2));
                modal.find('input[name=end_date]').val($(this).data('end_date'));
                modal.find('input[name=start_date]').val($(this).data('start_date'));
                modal.find('select[name=discount_type]').val($(this).data('discount_type'));

                if ($(this).data('status') == 1) {
                    modal.find('input[name=status]').bootstrapToggle('on');
                } else {
                    modal.find('input[name=status]').bootstrapToggle('off');
                }
            });
        })(jQuery);
    </script>
@endpush
