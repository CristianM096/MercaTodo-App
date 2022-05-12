<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    @if (count($data) > 0)
    <div>
        <div class="flex justify-between m-10">
            <div class="flex">
                <img width="50" src="http://127.0.0.1:8000/storage/img/logo.svg" alt="">
                <h1 class="font-semibold text-4xl">Mercatodo</h1>
            </div>
            <div>
                <p class="text-red-500">No. Reporte: 0001</p>
                <p class="font-semibold">Fecha: {{$date}}</p>
            </div>
        </div>
        <div class="flex justify-between m-10">
            <div>
                <h3 class="font-semibold">Información del Usuario</h1>
                <p> Pepito perez </p>
            </div>
            <div>
                <h3 class="">Detalles del Reporte</h1>
                <p class="font-semibold" >Reporte del {{$initialDate}} hasta  {{$endDate}}</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <table class="mx-10 divide-y divide-gray-200 table-fixed dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700">
                    <th class="py-3 px-1 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                        Id
                    </th>
                    <th scope="col" class="py-3 px-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                        Fecha
                    </th>
                    <th scope="col" class="py-3 px-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                        Descuento
                    </th>
                    <th scope="col" class="py-3 px-3 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                        Vendido
                    </th>
                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                        Subtotal
                    </th>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200  dark:divide-gray-700">
                @php
                  $total = 0;
                @endphp
                @for ($i = 0; $i < 1; $i++)
                <tr >
                    <td class="py-2 px-1 text-sm font-semibold text-black whitespace-nowrap ">{{$i+1}}</td>
                    <td class="py-2 px-6 text-sm font-semibold text-black whitespace-nowrap">{{$data[$i]['date']}}</td>
                    <td class="py-2 px-6 text-sm font-semibold text-black whitespace-nowrap">{{0}}</td>
                    <td class="py-2 px-6 text-sm font-semibold text-black whitespace-nowrap">{{$data[$i]['total']}}</td>
                    <td class="py-2 px-6 text-sm font-semibold text-black whitespace-nowrap">{{$data[$i]['total'] - 0}}</td>
                </tr>
                    @php
                        $total += $data[$i]['total'] - 0;
                    @endphp
                @endfor
            </tbody>
            <tfoot class="bg-zinc-800">
                <tr class="flex-col mt-10 text-right px-5 text-white font-light">
                    <th colspan="2"></th>
                    <td >Monto Sub-Total</td>
                    <td >Descuento</td>
                    <td >Total</td>
                </tr>
                <tr class="text-white flex-col text-right text-4xl px-5">
                    <td colspan="2"></td>
                    <td >${{$total}}</td>
                    <td >$0</td>
                    <td >${{$total-0}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
        <h1>NO HAY DATOS PARA MOSTRAR</h1>
    @endif
</body>
</html>