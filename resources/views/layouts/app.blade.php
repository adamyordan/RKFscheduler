<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Scheduler</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">  
    <link rel="stylesheet" href="https://bootswatch.com/simplex/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.16.1/vis.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/3.3.4/sweetalert2.min.css">

    <!-- React -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.1.0/react.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.1.0/react-dom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remarkable/1.6.2/remarkable.min.js"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.16.1/vis.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/sweetalert2/3.3.4/sweetalert2.min.js"></script>

    <style>
      .row.vdivide [class*='col-']:not(:last-child):after {
        background: #e0e0e0;
        width: 1px;
        content: "";
        display:block;
        position: absolute;
        top:0;
        bottom: 0;
        right: 0;
        min-height: 70px;
      }

      .btn-group {
        display: flex;
      }

    </style>

  </head>
  <body>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
       <div class="container" id="navfluid">
           <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigationbar">
                   <span class="sr-only">Toggle navigation</span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                </button>
              <a class="navbar-brand" href="{{route('home')}}">RKF</a>
           </div>
           <div class="collapse navbar-collapse" id="navigationbar">
              <ul class="nav navbar-nav navbar-left">
                <li><a href="{{route('excel')}}">Export to Excel</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#timeline">Timeline</a></li>
                @foreach (Scheduler\Division::all() as $division)
                  <li><a href="#{{$division->shortname}}">{{$division->shortname}}</a></li>
                @endforeach
              </ul>
          </div>
       </div>
    </nav>

    <br><br><br>

    <div class="container" id="main">
        @yield('content')
    </div>

  </body>
</html>