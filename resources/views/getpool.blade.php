<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
          rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <title>Pool</title>
</head>
<body>
<h1 class="col-md-5">Отчёт по воркерам:</h1>

<div class="col-xl-8 order-md-1">
    <form class="needs-validation" novalidate="">
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="rate">Тариф</label>
                <input name="rate" class="form-control" id="rate" placeholder="" value="" required="">
                <div class="invalid-feedback">
                    Тариф не заполнен
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="consumption">Потребление</label>
                <input name="consumption" class="form-control" id="consumption" placeholder="" value=""
                       required="">
                <div class="invalid-feedback">
                    Потребление не заполнено
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="startDate">Дата начала расчёта</label>
                <input type="text" class="date form-control" id="startDate" placeholder="" value="" required="">
                <div class="invalid-feedback">
                    Дата не заполнена
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="endDate">Дата окончания расчёта</label>
                <input type="text" class="date form-control" id="endDate" placeholder="" value="" required="">
                <div class="invalid-feedback">
                    Дата не заполнена
                </div>
            </div>
            <button class="btn btn-primary col-md-5 mb-3 mx-auto" type="submit">Вперед!</button>
        </div>
    </form>
</div>

<div>
    <div class="row bg-primary">
        <div class="col-sm text-white text-center border border-dark">
            Воркер
        </div>
        @foreach($dates as $date)
            <div class="col-sm text-white text-center border border-dark">
                {{\Carbon\Carbon::parse($date)->format('Y-m-d')}}
            </div>
        @endforeach
    </div>
    @foreach($workers as $worker)
        <div class="row bg-white">
            <div class="col-sm text-dark text-center border border-dark">
                {{ $worker->worker_name }}
            </div>
            @foreach($resultByDates as $resultByDate)
                <div class="col-sm text-dark text-center border border-dark">
                    {{ $resultByDate }}
                </div>
            @endforeach
        </div>
    @endforeach
</div>

<h1 class="col-md-5">Общий итог: {{ $result }} руб.</h1>

<script type="text/javascript">

    $('.date').datepicker({

        format: 'yyyy-mm-dd'

    });

</script>


<script>

    $('#contactForm').on('submit', function (event) {
        event.preventDefault();

        let rate = $('#rate').val();
        let consumption = $('#consumption').val();

        $.ajax({
            url: "/contact-form",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                rate: rate,
                consumption: consumption,
            },
            success: function (response) {
                console.log(response);
            },
        });
    });
</script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


</body>
</html>
