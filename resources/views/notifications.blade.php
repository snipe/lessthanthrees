<div class="col-xs-12 margin-top-10">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissable margin-top-10">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-exclamation-circle"></i>
            <strong>Error:</strong> {{ trans('validation.generic_form_error')}}
        </div> <!-- alert -->
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-check"></i>
            <strong>Success:</strong> {{ $message }}
        </div> <!-- alert -->
    @endif


    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-exclamation-circle"></i>
            <strong>Error: </strong>
            {{ $message }}
        </div> <!-- alert -->
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-exclamation-triangle"></i>  {{ $message }}
        </div> <!-- alert -->
    @endif

    @if ($message = Session::get('info'))
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-2x fa-info-circle"></i> {{ $message }}
        </div> <!-- alert -->
    @endif

    @if ($message = Session::get('alert-no-fade'))
        <div class="alert-no-fade alert-warning" role="alert">
            <i class="fa fa-info-circle"></i> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('success-no-fade'))
        <div class="alert-no-fade alert-success alert-dismissable" role="alert">
            <i class="fa fa-check"></i> {{ $message }}
        </div>
    @endif

    @if ($message = Session::get('error-no-fade'))
        <div class="alert-no-fade alert-danger alert-dismissable" role="alert">
            <i class="fa fa-exclamation-circle"></i> {{ $message }}
        </div>
    @endif
</div> <!-- col-md-12 -->

<!-- ajax success -->
<div class="col-md-12 margin-top-10 ajax_success hidden">
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
    </div> <!-- alert -->
</div> <!-- col-md-12 -->

<!-- ajax error -->
<div class="col-md-12 margin-top-10 ajax_error hidden">
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-exclamation-circle"></i>
    </div> <!-- alert -->
</div> <!-- col-md-12 -->

