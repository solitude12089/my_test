@extends('layouts.app')

@section('css')
    <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="example" class="display" width="100%"></table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')



<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
    var dataSet = <?php echo $sign_logs; ?>;
    $('#example').DataTable( {
        data: dataSet,
        order : [[ 0, "desc" ]],
        columns: [
            { title: "日期" , data: "date" },
            { title: "星座" , data: "sign" },
            { title: "整體運勢" , data: "all_count" },
            { title: "說明" , data: "all_note" },
            { title: "愛情運勢" , data: "love_count" },
            { title: "說明" , data: "love_note" },
            { title: "事業運勢" , data: "job_count" },
            { title: "說明" , data: "job_note" },
            { title: "財運運勢" , data: "lucky_count" },
            { title: "說明" , data: "lucky_note" },
           
        ]
    });
</script>
@endsection