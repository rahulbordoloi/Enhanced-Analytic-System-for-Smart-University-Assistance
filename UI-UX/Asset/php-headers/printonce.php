<?php
    session_start();
?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="/Asset/print.css" type="text/css" media="print"/>
<title>BeFriend | Print This Page</title>
<style>
body,html { margin-top:0%;
   display:block;
   height:100%;}
table.minimalistBlack {
  border: 3px solid #000000;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.minimalistBlack td, table.minimalistBlack th {
  border: 1px solid #000000;
  padding: 10px 10px;
}
table.minimalistBlack tbody td {
  font-size: 20px;
}
table.minimalistBlack thead {
  background: #CFCFCF;
  background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  border-bottom: 3px solid #000000;
}
table.minimalistBlack thead th {
  font-size: 24px;
  font-weight: bold;
  color: #000000;
  text-align: left;
}
table.minimalistBlack tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #000000;
  border-top: 3px solid #000000;
}
table.minimalistBlack tfoot td {
  font-size: 14px;
}
@media print
{
    html
    {
        transform: scale(1);transform-origin: 0 0;
    }
    @page
    {
        size: 297mm 210mm; /* landscape */
        /* you can also specify margins here: */
        margin: 250mm;
        margin-right: 450mm; /* for compatibility with both A4 and Letter */
    }
}
</style>
</head>
<body>
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-2 text-center">
    <hr>
    <img src="/Asset/Image/sm-logo.png" alt="Logo" height="100px">
    <hr>
</div>
<div class="col-sm-6 text-center">
    <br><br>
    <h1 style="font-family: Times New Roman; font-weight: bolder;">
        Complete Student Details
    </h1>
</div>
<div class="col-sm-2 text-center">
    <hr>
    <img src="/Asset/Image/logo.png" alt="Logo" height="100px">
    <hr>
</div>
<div class="col-sm-1"></div>
</div>

<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-7">
    <table class="minimalistBlack">
    <thead>
    <tr>
    <th>Fileds</th>
    <th>Values</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
    <td>Signature of Student with Date</td>
    <td>Signature of Authority with Date</td>
    </tr>
    </tfoot>
    <tbody>
    <?php
    foreach ($_SESSION as $columnName => $columnData) {
        if($columnName!='tagline')
            echo '<tr><td><b>' . strtoupper($columnName) . ' </b></td><td>' . $columnData . '</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>
<div class="col-sm-3">
    <div class="container h-100">
        <div class="row align-items-center h-100">
              <div class="container text-center">
                <img src="https://befriendminor.s3.us-east-2.amazonaws.com/Display/<?php echo $_SESSION['roll']; ?>.jpg"
                alt="Image Cap" height="200">
                <br>
                <caption><b>&emsp;Attested Image</b></caption>
              </div>
        </div>
    </div>
</div>
</div>
<div class="row text-center">
<div class="col-sm-3"></div>
<div class="col-sm-6">
    &nbsp;
    <br><br><br>
    <button class="btn btn-outline-dark btn-block" onclick="printacp();">Print</button>
</div>
<iv class="col-sm-3"></iv>
</div>
<script>
function printacp()
{
    var css = '@page { size: landscape; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

    style.type = 'text/css';
    style.media = 'print';

    if (style.styleSheet){
    style.styleSheet.cssText = css;
    } else {
    style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);
    window.print();
}
</script>
</body>
</html>