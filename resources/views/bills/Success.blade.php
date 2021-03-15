<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Bill!</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>
<div style="margin-left:auto;margin-right:auto; width:80%;">
  <table border="1">
    <tr>
        <td>
            <h3>YUMMY RESTAURANT</h3>
            <strong>call us:</strong>:0788757497
        </td>
    </tr>

  </table>

  <table>
    <tr>
        <td><strong>billNumber:</strong>{{$data->billNumber}}
        <strong>Table:</strong>011</td>
    </tr>
  </table>
  <br/>
  <table width="80%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>item</th>
        <th>Quantity</th>
        <th>Unit Price [rwf]</th>
        <th>Discount [rwf]</th>
        <th>Total [rwf]</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>{{$data->order->item->name}}</td>
        <td align="right">{{$data->order->quantity}}</td>
        <td align="right">{{$data->order->item->price}}</td>
        <td align="right">{{$data->order->discount}}</td>
        <td align="right">{{$data->order->ammount}}</td>
      </tr>
    </tbody>

  
  </table>
</div>
</body>
</html>