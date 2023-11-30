@extends('layouts.app')

@section('content')
    <div class="min-h-[200px] w-full m-auto">
        <div class="max-w-[500px] m-auto">
            <div class="w-full flex justify-between items-center gap-5">
                <input id="city" placeholder="Plase type city name" type="text" class="border-slate-600 border rounded-full block py-1 px-4 w-full outline-none hover:border-slate-950 duration-200">
                
                <button type="button" id="getData" class="outline-none rounded border border-slate-600 bg-600 px-4 py-1 bg-slate-600 hover:bg-white hover:text-black text-white duration-200">
                    Submit
                </button>
                <img src="/spinner.svg" alt="spinner" class="hidden w-10 h-10 bg-black" id="spinner">
            </div>
            <div class="w-full">
                <p class="text-red-500 hidden text-xs px-4" id="alert"> </p>
            </div>
        </div>
        <div class="w-full max-w-[600px] m-auto mt-6">
            <div class="flex justify-end px-4">
                <div class="pr-4">°C</div>
                <input
                    class="mr-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-neutral-300 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-neutral-100 after:shadow-[0_0px_3px_0_rgb(0_0_0_/_7%),_0_2px_2px_0_rgb(0_0_0_/_4%)] after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ml-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-[0_3px_1px_-2px_rgba(0,0,0,0.2),_0_2px_2px_0_rgba(0,0,0,0.14),_0_1px_5px_0_rgba(0,0,0,0.12)] checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:ring-0 focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-[3px_-1px_0px_13px_rgba(0,0,0,0.6)] focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ml-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca] checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-neutral-600 dark:after:bg-neutral-400 dark:checked:bg-primary dark:checked:after:bg-primary dark:focus:before:shadow-[3px_-1px_0px_13px_rgba(255,255,255,0.4)] dark:checked:focus:before:shadow-[3px_-1px_0px_13px_#3b71ca]"
                    type="checkbox"
                    role="switch"
                    id="flexSwitchCheckDefault" />
                <label
                    class="inline-block pl-[0.15rem] hover:cursor-pointer"
                    for="flexSwitchCheckDefault"
                >°F</label>
            </div>
            <div class="grid grid-cols-12 text-black text-sm px-4 mt-3">
                <div class="col-span-4">City Name</div>
                <div class="col-span-4">Current Temperature</div>
                <div class="col-span-4 text-end">Description</div>
            </div>
            <div class="hidden w-full" id="table">
                <div class="grid grid-cols-12 text-black text-sm rounded bg-slate-400 py-2 px-4">
                    <div class="col-span-4" id="city_name"></div>
                    <div class="col-span-4" id="temp"></div>
                    <div class="col-span-4 text-end" id="description"></div>
                </div>
            </div>
        </div>
        {{-- Country search select --}}
        {{-- <div>
            @foreach ($state as $item)
                @foreach ($item['regions'] as $city)
                    <div> {{ $item['countryName'] }} / {{ $city['name'] }}</div>
                @endforeach
            @endforeach
        </div> --}}
    </div>
    <script>
        $(document).ready(function(){
            $("#getData").click(function(){
                const city = $("#city").val();
                if(city.length === 0){
                    $("#alert").html("Please type city name.");
                    $("#alert").show();
                }else{
                    const checked = $('#flexSwitchCheckDefault');
                    checked.prop('checked', false);
                    $("#getData").hide();
                    $("#spinner").show();
                    $("#alert").hide();
                    $.ajax({
                        type: "GET",
                        url: "/getData",
                        data: {city:city},
                        success: function(res){
                            $("#spinner").hide();
                            $("#getData").show();
                            if(res?.data?.cod === 200){
                                $("#table").show();
                                const weather = res?.data;
                                $("#city_name").html(weather.name);
                                $("#temp").html((weather.main?.temp - 273.15).toFixed(2));
                                $("#description").html(weather.weather[0].description);
                            }else{
                                $("#table").hide();
                                $("#alert").html(res?.data?.message)
                                $("#alert").show();
                            }
                        }
                    })
                }
            });
            $("#flexSwitchCheckDefault").click(function(){
                const checked = $("#flexSwitchCheckDefault").prop('checked');
                const temp = $("#temp").html();
                var f = 0;
                if(checked === true){
                    f = Number(temp)*9/5 + 32;
                }else{
                    f = (Number(temp) - 32)*5/9;
                }
                $("#temp").html(f)
            })
        });
    </script>
@endsection