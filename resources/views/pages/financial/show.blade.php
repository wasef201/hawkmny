
    <div class="row">
        @foreach($financial_inputs->groupBy('type') as $type => $financial_input2)
            <fieldset class="mt-4 text-danger">
                <legend>{{$type}}</legend>
                <div class="row">

                    @foreach($financial_input2 as $financial_input)
                        @php
                            $current_input=$user_financial_inputs->firstWhere('financial_input_id', $financial_input->id);
                        @endphp
                        <div class="col-6 col-md-6 my-4">
                            <div class="text-body text-gray-500">{{$financial_input->label }} : </div>
                            <div>{{$current_input?$current_input->financial_value:null}}</div>

                        </div>
                    @endforeach
                </div>
            </fieldset>
        @endforeach

    </div>
