@extends('layout.app')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Please Fill This Form
            </div>
            <div class="card-body" style="padding: 2rem">
                <form id="form">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Choose Solar Pump Model</label>
                        <div class="col-sm-9">
                                <select name="pump" class="form-control" required>
                                    <option value="">-- choose --</option>
                                    @foreach ($pumps as $pump)
                                        <option value="{{$pump['voltage']}}">Pump model {{$pump['model']}} ({{$pump['voltage']}}V)</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="form-check row">
                        <div class="col-sm-3">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-check-label" for="defaultCheck1">
                            Need Extra Cable
                            </label>
                        </div>
                    </div>
                    <div class="form-group row mt-3" id="cable-field" style="display: none">
                        <label class="col-sm-3 col-form-label">Enter Cable Length (in meters)</label>
                        <div class="col-sm-7">
                                <input type="number" name="length" class="form-control" min="1" max="80" required placeholder="meters">
                        </div>
                        <button class="btn btn-secondary" id="btn-submit">calculate extra cost</button>

                        <div class="col-sm-12 mt-5" id="cost-field"></div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
    @include('layout.scripts')
    <script>
        $('#defaultCheck1').change(function(){
            if ($(this).prop('checked') == true) {
                $('#cable-field').show();
            } else {
                $('#cable-field').hide();
            }
        });

        $('select[name="pump"]').change(function(){
            if ($(this).val() == 24) {
                $('input[name="length"]').attr('max',50);
            } else if($(this).val() == 48) {
                $('input[name="length"]').attr('max',70);
            }else{
                $('input[name="length"]').attr('max',80);
            }
        });

        $('#form').submit(function(e){
            e.preventDefault();
            //console.log($('select[name="pump"]'));
            if($('select[name="pump"]').val() == ""){
                $(this).click();
            }else if($('input[name="length"]').val() > $('input[name="length"]').prop('max') || $('input[name="length"]').val() < $('input[name="length"]').prop('min')){
                $(this).click();
            }else{
                var formData = $('#form').serialize();
                $.ajax({
                    url:"{{route('calculate')}}",
                    type: 'get',
                    data: formData,
                    success: function(response) {
                        $('#cost-field').html('\
                            <h5>Cost is : $'+ response.cost +' ($'+response.unit+'/meter)</h5>\
                        ');
                    }
                });
            }
        });

    </script>
@endsection
