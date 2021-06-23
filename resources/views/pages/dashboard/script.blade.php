<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    Highcharts.chart('jenis_kelamin', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Jumlah: <b>{point.y}</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Persen',
            colorByPoint: true,
            data: [
                {
                    name: 'Laki - Laki',
                    y: {{(int)$laki}},
                    sliced: true,
                    selected: true
                },
                {
                    name: 'Perempuan',
                    y: {{(int)$pr}},
                },
            ]
        }]
    });

    Highcharts.chart('visitor', {
        chart: {
            type: 'line'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                @foreach($stat as $val)
                    '{{$val['tanggal']}}',
                @endforeach
            ]
        },
        yAxis: {
            title: {
                text: 'Jumlah Visitor'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [
            {
                name: 'Pengunjung',
                data: [
                    @foreach($stat as $val)
                        {{$val['jml']}},
                    @endforeach
                ]
            }
        ]
    });

    var table = $('.table_artikel').DataTable({
            lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('artikel.datatable') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"judul"},
                {"data":"get_status"},
                {"data":"get_view"},
            ],
            columnDefs: [
            {
                targets: [-1],
                className: 'text-center'
            },
          ]
    });

    var table = $('.table_file').DataTable({
            lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            info :false,
            ajax: {
               url: "{{ route('file') }}",
            },
            columns: [
                {"data":"DT_RowIndex"},
                {"data":"name"},
                {"data":"status"},
                {"data":"jml_download"},
            ],
            columnDefs: [
            {
                targets: [-1],
                className: 'text-center'
            },
          ]
    });
</script>