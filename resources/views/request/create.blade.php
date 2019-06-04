
@extends('layouts.admin')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8" style='margin-bottom:9px'>
                        <h3 class="box-title"><b>Add Request</b></h3>
                    </div>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="/request/store">
                       
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class='row'>
                            <div class='col-md-8'>
                               
                            </div>    
                        </div>
                        <div class="form-group col-sm-3">
                        <label for="sel1">Select FIeld (select one):</label>
                        <select name="field_name"class="form-control" id="sel1">
                            <option value='name'>Name</option>
                            <option value='education'>Education</option>
                            <option value='email'>Email</option>                            
                        </select>
                        </div>
                        <div class="form-group{{ $errors->has('fields') ? ' has-error' : '' }}">
                            <label for="fields" class="col-md-4 control-label">New Value</label>

                            <div class="col-md-6">
                                <input id="fields" type="text" class="form-control" name="fields" value="{{ old('fields') }}" autofocus>

                                @if ($errors->has('fields'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fields') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change
                                </button>
                            </div>
                        </div>
                    </form>
                
                 </div>
                </div>    
            </div>
        </div>
    </section>
@endsection
@section('footer-assets')
@endsection