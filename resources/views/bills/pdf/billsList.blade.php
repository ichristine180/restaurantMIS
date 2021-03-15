<!doctype html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top:100px;

}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #f0dee8;
  color: black;
}
.title{
    font-size:30px;
}
.date{
    margin-left:450px;
}
</style>
</head>
<body>
@php
$i = 0;
@endphp
<div class="header"> <span class="title">Bills List</span><span class="date"> <strong>date {{ date('Y-m-d') }}</strong></span>
</div>
<table id="customers">
  <thead>
  <tr>
                <th>#</th>
                <th>BillNumber</th>
                <th>Ammount [rwf]</th>
                <th>status</th>
                <th>Created By</th>
                <th>created At</th>
                
             
            </tr>
  </thead>
  <tbody>
  @foreach($data as $data)
    <tr class="table-active">
    <td>{{$i++}}</td>
                <td>{{$data->billNumber}}</td>
                <td>{{$data->order->ammount}}</td>
                <td>{{$data->status}}</td>
                <td>{{$data->user->name}}</td>
                <td>{{$data->created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<script type="text/php">
    if (isset($pdf)) {
        $x = 250;
        $y = 800;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 14;
        $color = array(255,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
</body>
</html>