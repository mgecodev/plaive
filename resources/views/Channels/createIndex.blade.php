@extends('layouts.Master')

@section('content')
<div id="overviews" class="section wb">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-9 blog-post-single">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Pay Invoice</h3>
                        </div>
                        <hr>
                        <form action="" method="post" novalidate="novalidate">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Payment amount</label>
                                <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00">
                            </div>
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Name on card</label>
                                <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Card number</label>
                                <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                        <input type="checkbox">
                                        <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY" autocomplete="cc-exp">
                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Security code</label>
                                    <div class="input-group">
                                        <input id="x_card_code" name="x_card_code" type="tel" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> 생성
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> 취소
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end col -->
            <div class="col-lg-3 col-12 right-single">
            </div>
        </div><!-- end row -->
    </div>
</div>
@endsection