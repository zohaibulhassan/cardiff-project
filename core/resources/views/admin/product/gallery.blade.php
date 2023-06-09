@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.product.addgallery') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h1>{{ $product->name }}</h1>
                <input type="text" value="{{ $product->id }}" name="productid" hidden>
                <div class="card my-2">
                    <div class="card-header">
                        <h5 class="d-inline-block">@lang('Gallery Images')</h5>
                        <button type="button" class="btn btn-sm btn--primary float-right addUserData text-light">
                            <i class="la la-fw la-plus"></i>@lang('Add New')
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row addedField">

                        </div>
                    </div>
                </div>

                <div class="card my-2">
                    <div class="card-header">
                        <h5 class="d-inline-block">@lang('Specification Cost and Efficiency')</h5>
                    </div>

                    <!-- Rest of the form fields -->
                    <div class="card-body">
                        <div class="row">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('CO2 EMISSIONS')</label>
                                            <input type="text" name="co2_emissions" class="form-control"
                                                placeholder="e.g. 150 g/km">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">@lang('URBAN/NON-URBAN')</label>
                                            <input type="text" name="urban_nonurban" class="form-control"
                                                placeholder="Enter value (e.g., 28)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">EuroStatus</label>
                                            <input type="text" name="euro_status" class="form-control" placeholder="Enter EuroStatus">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Insurance Group (1 - 50)</label>
                                            <input type="text" name="insurance_group" class="form-control" placeholder="Enter insurance group">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Security</label>
                                            <input type="text" name="security" class="form-control" placeholder="Enter security">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Speed</label>
                                            <input type="text" name="speed" class="form-control" placeholder="Enter speed">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Top Speed</label>
                                            <input type="text" name="top_speed" class="form-control" placeholder="Enter top speed">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">MAX Power</label>
                                            <input type="text" name="max_power" class="form-control" placeholder="Enter max power">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">MAX TORQUE</label>
                                            <input type="text" name="max_torque" class="form-control" placeholder="Enter max torque">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Valve Gear</label>
                                            <input type="text" name="valve_gear" class="form-control" placeholder="Enter valve gear">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Cyl. ARR</label>
                                            <input type="text" name="cyl_arr" class="form-control" placeholder="Enter Cyl. ARR">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Gears</label>
                                            <input type="text" name="gears" class="form-control" placeholder="Enter number of gears">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Aspiration</label>
                                            <input type="text" name="aspiration" class="form-control" placeholder="Enter aspiration">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">Cylinders</label>
                                            <input type="text" name="cylinders" class="form-control" placeholder="Enter number of cylinders">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label font-weight-bold">DriveREAR</label>
                                            <input type="text" name="drive_rear" class="form-control" placeholder="Enter drive type (e.g., REAR)">
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h4>DIMENSIONS</h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Length</label>
                                                    <input type="text" name="length" class="form-control" placeholder="Enter length">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Breath</label>
                                                    <input type="text" name="breath" class="form-control" placeholder="Enter breath">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Height</label>
                                                    <input type="text" name="height" class="form-control" placeholder="Enter height">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Max Gross Weight</label>
                                                    <input type="text" name="max_gross_weight" class="form-control" placeholder="Enter max gross weight">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Towing Weight (Braked)</label>
                                                    <input type="text" name="towing_weight_braked" class="form-control" placeholder="Enter towing weight (braked)">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Towing Weight (Unbraked)</label>
                                                    <input type="text" name="towing_weight_unbraked" class="form-control" placeholder="Enter towing weight (unbraked)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Seats</label>
                                                    <input type="text" name="seats" class="form-control" placeholder="Enter number of seats">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <h4>SAFETY (NCAP)</h4>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Adult</label>
                                                    <input type="text" name="adult" class="form-control" placeholder="Enter adult safety rating">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Child</label>
                                                    <input type="text" name="child" class="form-control" placeholder="Enter child safety rating">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Pedestrian</label>
                                                    <input type="text" name="pedestrian" class="form-control" placeholder="Enter pedestrian safety rating">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Safety Assist</label>
                                                    <input type="text" name="safety_assist" class="form-control" placeholder="Enter safety assist rating">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-control-label font-weight-bold">Overall</label>
                                                    <input type="text" name="overall" class="form-control" placeholder="Enter overall safety rating">
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>                                              
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn--primary btn-block">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<!-- @push('breadcrumb-plugins')
    <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small">
            <i class="la la-fw la-backward"></i> @lang('Go Back')
        </a>
@endpush -->

@push('script')
    <script>
        (function($) {
            "use strict";

            $('[name=category_id]').on('change', function() {
                let subcategories = $(this).find(':selected').data('subcategories');
                let html = `<option value='' disabled selected>@lang('Select one')</option>`;
                $.each(subcategories, function(i, val) {
                    html += `<option value="${val.id}">${val.name}</option>`
                });
                $('[name=subcategory_id]').html(html);
            }).change();

            $('input[name=currency]').on('input', function() {
                $('.currency_symbol').text($(this).val());
            });
            $('.addUserData').on('click', function() {

                var randomId = Math.floor(Math.random() * 100);
                var html = `
            <div class="col-md-3 user-data">
                <div class="form-group">
                    <div class="image-upload">
                        <div class="thumb">
                            <div class="avatar-preview">
                                <div class="profilePicPreview" style="background-image: url({{ getImage('/', imagePath()['product']['gallery']['size']) }})">
                                    <button type="button" class="remove-image removeBtn d-block"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="avatar-edit">
                                <input type="file" class="profilePicUpload" name="files[]" id="${randomId}" accept=".png, .jpg, .jpeg">
                                <label for="${randomId}" class="bg--success">@lang('Upload Image')</label>
                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg'), @lang('png').</b> @lang('Image will be resized into') {{ imagePath()['product']['gallery']['size'] }}@lang('px') </small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>`;

                $('.addedField').append(html);
            });

            $('.addFeatureData').on('click', function() {
                var html = `
            <div class="feature-data">
                <div class="form-group">
                    <div class="mb-4 row">
                        <div class="col-md-5 mb-2 mb-md-0">
                            <input name="feature_title[]" class="form-control" type="text" required placeholder="@lang('Title')">
                        </div>
                        <div class="col-md-5 mb-2 mb-md-0">
                            <input name="feature_desc[]" class="form-control" type="text" required placeholder="@lang('Description')">
                        </div>
                        <div class="col-md-2 mt-md-0 mt-2 text-right">
                            <span class="input-group-btn">
                                <button class="btn btn--danger btn-lg remove-Btn w-100" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>`;

                $('.addedFeature').append(html);
            });




            $(document).on('click', '.removeBtn', function() {
                $(this).closest('.user-data').remove();
            });
            $(document).on('click', '.remove-Btn', function() {
                $(this).closest('.feature-data').remove();
            });
            @if (old('currency'))
                $('input[name=currency]').trigger('input');
            @endif

            $("#digital_item").change(function() {
                var data = $(this).val();
                if (data == 1) {
                    $('#inputSection').addClass('d-block');
                    $('#inputSection').removeClass('d-none');
                } else {
                    $('#inputSection').addClass('d-none');
                    $('#inputSection').removeClass('d-block');
                    $('#linkSection').addClass('d-none');
                    $('#linkSection').removeClass('d-block');
                    $('#fileSection').addClass('d-none');
                    $('#fileSection').removeClass('d-block');
                }
            });

            $("#file_type").change(function() {
                var data = $(this).val();
                if (data == 1) {
                    $('#linkSection').addClass('d-none');
                    $('#linkSection').removeClass('d-block');
                    $('#fileSection').addClass('d-block');
                    $('#fileSection').removeClass('d-none');
                } else {
                    $('#fileSection').addClass('d-none');
                    $('#fileSection').removeClass('d-block');
                    $('#linkSection').addClass('d-block');
                    $('#linkSection').removeClass('d-none');
                }
            });
        })(jQuery);
    </script>
@endpush
