@extends('admin.layouts.app')

@section('panel')
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('admin.product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h5>@lang('Product Information')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-control-label font-weight-bold">@lang('Name')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" class="form-control" placeholder="e.g: Product Name" value="{{ $product->name }}" />
                            </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Brands')
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="brand">
                                <option value="" selected disabled>@lang('Select one')</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : ''}}>
                                    {{ __($brand->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Category')
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="category_id" id="category">
                                <option value="" selected disabled>@lang('Select one')</option>
                                @foreach ($allCategory as $category)
                                <option data-subcategories="{{ $category->subcategories }}" value="{{ $category->id }}" {{ $product->category_id == $category->id ?'selected' : '' }}>
                                    {{ __($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Description')
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="description" class="form-control" placeholder="e.g: Product Description">{{ $product->description }}</textarea>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Included')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="included" class="form-control" placeholder="e.g: Included Items" value="{{ $product->included }}" />
                        </div> --}}
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Odometer')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="odometer" class="form-control" placeholder="e.g: Odometer Reading" value="{{ $product->odometer }}" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Fuel Type')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="fuel_type" class="form-control" placeholder="e.g: Fuel Type" value="{{ $product->fuel_type }}" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Transmission')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="transmission" class="form-control" placeholder="e.g: Transmission Type" value="{{ $product->transmission }}" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Year')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="year" class="form-control" placeholder="e.g: Year of Manufacture" value="{{ $product->year }}" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Body')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="body" class="form-control" placeholder="e.g: Body Type" value="{{ $product->body }}" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Engine Size')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="engine_size" class="form-control" placeholder="e.g: Engine Size" value="{{ $product->engine_size }}" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Doors')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="doors" class="form-control" placeholder="e.g: Number of Doors" value="{{ $product->doors }}" />
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label class="form-control-label font-weight-bold">@lang('Price')
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="price" class="form-control" placeholder="e.g: Product Price" value="{{ $product->price }}" />
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card my-2">
                <div class="card-header">
                    <h5>@lang('Product Description')</h5>
                </div>
                <div class="card-body">
                    <div class="form-group ">
                        <label class="form-control-label font-weight-bold">@lang('Inlcuded')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text"  name="included" class="form-control" value="{{ $product->included }}" >
                        <small class="form-text text-muted">@lang('Please write all included tags with seperated by commas')</small>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label font-weight-bold">@lang('Description')
                            <span class="text-danger">*</span>
                        </label>
                        <textarea rows="5" class="form-control border-radius-5 nicEdit" name="description">{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>
           
            <div class="card my-2">
                <div class="card-header">
                    <h5>@lang('Image and section')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="payment-method-item">
                                <div class="payment-method-header">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" style="background-image: url('{{ getImage(imagePath()['product']['thumb']['path'] . '/' . $product->image, imagePath()['product']['thumb']['size']) }}')"></div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                            <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <small class="mt-2 text-facebook">@lang('Supported files'):
                                    <b>@lang('jpeg'), @lang('jpg').</b> @lang('Image will be resized into '){{  imagePath()['product']['thumb']['size'] }}@lang('px')
                                </small>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Video Link')
                                        <span class="text-danger">*</span>
                                    </label>
                                     <input type="text" value="{{$product->video_link}}" name="video_link" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card my-2">
                <div class="card-header">
                    <h5 class="d-inline-block">@lang('Gallery Image')</h5>
                    <button type="button" class="btn btn-sm btn--primary float-right addUserData text-light">
                        <i class="la la-fw la-plus"></i>@lang('Add New')
                    </button>
                </div>
                <div class="card-body">
                    <div class="row addedField">
                        {{-- @if($product->ProductGallery != null) --}}
                        @foreach($productgallery as $gallery)
    <div class="col-md-3 user-data">
        <div class="form-group">
            <div class="image-upload">
                <div class="thumb">
                    <div class="avatar-preview">
                        <input type="hidden" name="imageId[]" value="{{ $gallery['id'] }}">
                        <div class="profilePicPreview"
                            style="background-image: url({{ getImage(imagePath()['product']['gallery']['path'] . '/' . $gallery['image'], imagePath()['product']['gallery']['size']) }})">
                            <button type="button" class="remove-image removeBtn d-block" data-id="{{ $product->id }}" data-image="{{ $gallery['id'] }}">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="avatar-edit">
                        <input type="file" class="profilePicUpload" name="files[]" accept=".png, .jpg, .jpeg">
                        <label  class="bg--success">@lang('Upload Image')</label>
                        <small class="mt-2 text-facebook">@lang('Supported files'):
                            <b>@lang('jpeg'), @lang('jpg').</b> @lang('Image will be resized into '){{  imagePath()['product']['gallery']['size'] }}@lang('px')
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

                    </div>
                </div>

            </div>
            <div class="card my-2">
                <div class="card-header">
                    <h5 class="d-inline-block">@lang('Product Specification')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">@lang('CO2 Emissions')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="co2_emissions" class="form-control" placeholder="e.g: CO2 Emissions" value="{{ $specification->co2_emissions }}" />
                            </div>
            
                            
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">@lang('Combined')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="combined" class="form-control" placeholder="e.g: Combined" value="{{ $specification->euro_status }}" />
                            </div>
                            
                        </div>    
                        <div class="col-md-6">
                            
                            
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">@lang('Urban/Non-Urban')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="urban_nonurban" class="form-control" placeholder="e.g: Urban/Non-Urban" value="{{ $specification->urban_nonurban }}" />
                            </div>



                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">@lang('Insurance Group')
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="insurance_group" class="form-control" placeholder="e.g: Insurance Group" value="{{ $specification->insurance_group }}" />
                            </div>
                        </div>
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Security')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="security" class="form-control" placeholder="e.g: Security Features" value="{{ $specification->security }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Speed')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="speed" class="form-control" placeholder="e.g: Speed" value="{{ $specification->speed }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Top Speed')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="top_speed" class="form-control" placeholder="e.g: Top Speed" value="{{ $specification->top_speed }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Max Power')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="max_power" class="form-control" placeholder="e.g: Max Power" value="{{ $specification->max_power }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Max Torque')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="max_torque" class="form-control" placeholder="e.g: Max Torque" value="{{ $specification->max_torque }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Valve Gear')
                            <span         class="text-danger">*</span>
                        </label>
                        <input type="text" name="valve_gear" class="form-control" placeholder="e.g: Valve Gear" value="{{ $specification->valve_gear }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Cylinder Arrangement')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="cyl_arr" class="form-control" placeholder="e.g: Cylinder Arrangement" value="{{ $specification->cyl_arr }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Gears')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="gears" class="form-control" placeholder="e.g: Gears" value="{{ $specification->gears }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Aspiration')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="aspiration" class="form-control" placeholder="e.g: Aspiration" value="{{ $specification->aspiration }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Cylinders')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="cylinders" class="form-control" placeholder="e.g: Cylinders" value="{{ $specification->cylinders }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Rear Drive')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="drive_rear" class="form-control" placeholder="e.g: Rear Drive" value="{{ $specification->drive_rear }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Length')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="length" class="form-control" placeholder="e.g: Length" value="{{ $specification->length }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Breath')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="breath" class="form-control" placeholder="e.g: Breath" value="{{ $specification->breath }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Height')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="height" class="form-control" placeholder="e.g: Height" value="{{ $specification->height }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Max Gross Weight')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="max_gross_weight" class="form-control" placeholder="e.g : Max Gross Weight" value="{{ $specification->max_gross_weight }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Towing Weight (Braked)')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="towing_weight_braked" class="form-control" placeholder="e.g: Towing Weight (Braked)" value="{{ $specification->towing_weight_braked }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Towing Weight (Unbraked)')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="towing_weight_unbraked" class="form-control" placeholder="e.g: Towing Weight (Unbraked)" value="{{ $specification->towing_weight_unbraked }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Seats')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="seats" class="form-control" placeholder="e.g: Seats" value="{{ $specification->seats }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Adult Occupancy')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="adult" class="form-control" placeholder="e.g: Adult Occupancy" value="{{ $specification->adult }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Child Occupancy')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="child" class="form-control" placeholder="e.g: Child Occupancy" value="{{ $specification->child }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Pedestrian Safety')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="pedestrian" class="form-control" placeholder="e.g: Pedestrian Safety" value="{{ $specification->pedestrian }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Safety Assist')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="safety_assist" class="form-control" placeholder="e.g: Safety Assist" value="{{ $specification->safety_assist }}" />
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Overall Safety')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="overall" class="form-control" placeholder="e.g: Overall Safety" value="{{ $specification->overall }}" />
                    </div> 

                    <div class="form-group col-md-6">
                        <label class="form-control-label font-weight-bold">@lang('Euro Status')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="euro_status" class="form-control" placeholder="e.g: Euro Status" value="{{ $specification->euro_status }}" />
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

@push('breadcrumb-plugins')
<a href="{{ route('admin.product.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small">
    <i class="la la-fw la-backward"></i> @lang('Go Back')
</a>
@endpush

@push('script')
<script>  
    (function($) {

        "use strict";

        var subcategory_id = '{{ $product->subcategory_id }}';
        $('[name=category_id]').on('change', function() {
            let subcategories = $(this).find(':selected').data('subcategories');
            let html = `<option value='' disabled selected>@lang('Select one')</option>`;
            $.each(subcategories, function(i, val) {
                html += '<option value='+val.id+' '+ (val.id == subcategory_id ? 'selected': '') +'>'+val.name+'</option>';
            });
            console.log(html)
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
                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg').</b> @lang('Image will be resized into '){{  imagePath()['product']['gallery']['size'] }}@lang('px') </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            $('.addedField').append(html);
        });

        $('.addFeatureData').on('click', function() {
            var html = `
            <div class="col-md-12 feature-data">
                <div class="form-group">
                    <div class="input-group mb-md-0 mb-4">
                        <div class="col-md-5">
                            <input name="feature_title[]" class="form-control" type="text" required placeholder="@lang('Title')">
                        </div>
                        <div class="col-md-5">
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


        var digiItem = "{{ $product->digital_item }}";
        var digiFile = "{{ $product->file_type }}";
        if(digiItem == 1){
            $("#inputSection").removeClass('d-none');
            if(digiFile == 1){
                $("#fileSection").removeClass('d-none');
            }else{
                $("#linkSection").removeClass('d-none');
            }
        }

        $("#digital_item").change(function(){
            var data = $(this).val();
            if(data == 1){
                $('#inputSection').addClass('d-block');
                $('#inputSection').removeClass('d-none');
            }else{
                $('#inputSection').addClass('d-none');
                $('#inputSection').removeClass('d-block');
                $('#linkSection').addClass('d-none');
                $('#linkSection').removeClass('d-block');
                $('#fileSection').addClass('d-none');
                $('#fileSection').removeClass('d-block');
            }
        });

        $("#file_type").change(function(){
            var data = $(this).val();
            if(data == 1){
                $('#linkSection').addClass('d-none');
                $('#linkSection').removeClass('d-block');
                $('#fileSection').addClass('d-block');
                $('#fileSection').removeClass('d-none');
            }else{
                $('#fileSection').addClass('d-none');
                $('#fileSection').removeClass('d-block');
                $('#linkSection').addClass('d-block');
                $('#linkSection').removeClass('d-none');
            }
        });
    })(jQuery);  
</script>
@endpush
