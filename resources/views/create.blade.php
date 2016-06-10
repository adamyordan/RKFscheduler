@extends('layouts.app')

@section('content')

<h2>Tambah Proker Baru</h2>

<div class="row">

  <div class="col-md-5">
    <div id="division_proker_container"></div>
  </div>

  <div class="col-md-7">
    <form id="proker-form">
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label for="">Divisi</label>
            <div id="division_select_container"></div>
          </div>
          <div class="form-group">
            <label for="">Nama Proker</label>
            <input type="text" class="form-control" placeholder="Nama proker" name="name"/>
          </div>
          <div class="form-group">
            <label for="">Deskripsi Proker</label>
            <input type="text" class="form-control" placeholder="Deskripsi proker" name="description"/>
          </div>              
          <div class="form-group">
            <label for="">Tanggal Pelaksanaan</label>
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="input-sm form-control" name="startDate"/>
                <span class="input-group-addon">to</span>
                <input type="text" class="input-sm form-control" name="endDate"/>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="">Tanggal Deadline</label>
            <div id="deadline-datepicker"></div>
          </div>

          <button type="submit" class="btn btn-default btn-block">Tambah</button>              
        </div>
      </div>

    </form>
  </div>

</div>

<script type="text/babel">

  var DivisiSelect = React.createClass ({
    getInitialState: function() {
      return {data: [], chosenDivision: ''};
    },

    componentDidMount: function() {
      this.serverRequest = $.get('/api/division/', function (result) {
        this.setState({data: result, chosenDivision: this.state.chosenDivision});
      }.bind(this));
    },

    handleDivisionChange: function(e) {
      this.setState({data: this.state.data, chosenDivision: e.target.value});
    },

    render: function() {
      var options = this.state.data.map(function (divisi) {
        return (
          <option value={divisi.id} key={divisi.id}>{divisi.shortname}</option>
        );
      });
      return (
        <select className="form-control" name="division"
                value={this.state.chosenDivision} 
                onChange={this.handleDivisionChange}>
          {options}
        </select>        
      )
    }
  });

  ReactDOM.render(
    <DivisiSelect />,
    document.getElementById('division_select_container')
  );


  $('.input-daterange').datepicker({});
  $('#deadline-datepicker').datepicker()
    .on('changeDate', function(e) {
      currentDeadline = e.date;
    });
  var currentDeadline;

  $('#proker-form').submit(function(e) {
    e.preventDefault();

    $.post('/api/proker', {
        name : $('input[name=name]').val(),
        description : $('input[name=description]').val(),
        startDate : moment($('input[name=startDate]').val()).format('YYYY-MM-DD'),
        endDate : moment($('input[name=endDate]').val()).format('YYYY-MM-DD'),
        deadline : moment(currentDeadline).format('YYYY-MM-DD'),
        division : $('select[name=division]').val(),
      }, function(data) {
        alert(data);
      })

  })

</script>

@endsection