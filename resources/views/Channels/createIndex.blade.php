@extends('layouts.Master')
@section('page_title')
<h1>채널 생성</h1>
@endsection
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
                        <form action="/CreateDevice" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="channel-name" class="control-label mb-1">채널 이름</label>
                                <input id="channel-name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field1_name" class="control-label mb-1">Field1</label>&nbsp;
                                        <input type="checkbox" checked>
                                        <input id="field1_name" name="field1_name" type="text" class="form-control cc-exp" value="" placeholder="Field1 이름" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field2_name" class="control-label mb-1">Field2</label>&nbsp;
                                        <input type="checkbox">
                                        <input id="field2_name" name="field2_name" type="text" class="form-control cc-exp" value="" placeholder="Field2 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field3_name" class="control-label mb-1">Field3</label>&nbsp;
                                        <input type="checkbox">
                                        <input id="field3_name" name="field3_name" type="text" class="form-control cc-exp" value="" placeholder="Field3 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field4_name" class="control-label mb-1">Field4</label>&nbsp;
                                        <input type="checkbox">
                                        <input id="field4_name" name="field4_name" type="text" class="form-control cc-exp" value="" placeholder="Field4 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field5_name" class="control-label mb-1">Field5</label>&nbsp;
                                        <input type="checkbox">
                                        <input id="field5_name" name="field5_name" type="text" class="form-control cc-exp" value="" placeholder="Field5 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field6_name" class="control-label mb-1">Field6</label>&nbsp;
                                        <input type="checkbox">
                                        <input id="field6_name" name="field6_name" type="text" class="form-control cc-exp" value="" placeholder="Field6 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field7_name" class="control-label mb-1">Field7</label>&nbsp;
                                        <input type="checkbox">
                                        <input id="field7_name" name="field7_name" type="text" class="form-control cc-exp" value="" placeholder="Field7 이름" required disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="field8_name" class="control-label mb-1">Field8</label>&nbsp;
                                        <input type="checkbox">
                                        <input id="field8_name" name="field8_name" type="text" class="form-control cc-exp" value="" placeholder="Field8 이름" required disabled>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <i class="fa fa-save fa-lg"></i>&nbsp;
                                    <span id="payment-button-amount">생성</span>
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