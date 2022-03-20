<div>
    @section('title') Workflow - Estadísticas de {{$this->excercise_name}} @endsection
    <h1>Estadísticas para {{$this->excercise_name}}</h1>
    <div class="my-8 flex flex-col md:flex-row items-end md:items-center justify-end">
        <div class="w-full mr-0 sm:w-auto sm:mr-3">
            <x-jet-label class="text-base">Inicio:</x-jet-label>
            <x-jet-input type="date" class="w-full" wire:model.defer="start_date" id="start_date"></x-jet-input>
            <x-jet-input-error for="start_date"></x-jet-input-error>
        </div>
        <div class="w-full mr-0 sm:w-auto sm:mr-3">
            <x-jet-label class="text-base">Fin:</x-jet-label>
            <x-jet-input type="date" class="w-full" wire:model.defer="end_date" id="end_date"></x-jet-input>
            <x-jet-input-error for="end_date"></x-jet-input-error>
        </div>
        <div>
            <x-button class="justify-center mt-6 py-3" id="filter">
                Filtrar
            </x-button>
        </div>
    </div>


    <h2>Peso levantado por sesión:</h2>
    <p id="excercise_id" class="hidden">{{$this->excercise_id}}</p>
    <p id="excercise_name" class="hidden">{{$this->excercise_name}}</p>

    <div class="my-8">
        <div id="ExcerciseWeightSession" style="height: 300px;"></div>
    </div>

    <h2>Peso medio levantado por repeticion:</h2>
    <div class="my-8">
        <div id="AverageWeightPerRep" style="height: 300px;"></div>
    </div>


    @push('scripts')
        <script>

            window.addEventListener('load', () =>{
                start_date = document.getElementById('start_date').value;
                end_date = document.getElementById('end_date').value;
                excercise_id = document.getElementById('excercise_id').innerText;
                excercise_name = document.getElementById('excercise_name').innerText;
                //console.log(start_date, end_date, excercise_id, excercise_name);


            

                document.getElementById('filter').addEventListener('click', () =>{
                    start_date = document.getElementById('start_date').value;
                    end_date = document.getElementById('end_date').value;
                    console.log(start_date, end_date);

                    ExcerciseWeightSession.update({
                        url: "@chart('excercise_weight_session')" + "?excercise_id="+excercise_id + "&excercise_name="+excercise_name + "&start_date=" + start_date + "&end_date=" + end_date,
                    });
                    AverageWeightPerRep.update({
                        url: "@chart('average_weight_per_rep')" + "?excercise_id="+excercise_id + "&excercise_name="+excercise_name + "&start_date=" + start_date + "&end_date=" + end_date,
                    });
                });


                    const ExcerciseWeightSession = new Chartisan({
                        el: '#ExcerciseWeightSession',
                        url: "@chart('excercise_weight_session')" + "?excercise_id="+excercise_id + "&excercise_name="+excercise_name + "&start_date=" + start_date + "&end_date=" + end_date,
                        hooks: new ChartisanHooks()
                        .datasets(['line'])
                        .tooltip()
                    });


                    const AverageWeightPerRep = new Chartisan({
                        el: '#AverageWeightPerRep',
                        url: "@chart('average_weight_per_rep')" + "?excercise_id="+excercise_id + "&excercise_name="+excercise_name + "&start_date=" + start_date + "&end_date=" + end_date,
                        hooks: new ChartisanHooks()
                        .datasets(['line'])
                        .tooltip(),
                    });





            });
        </script>
    @endpush
</div>