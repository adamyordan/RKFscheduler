<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  
    <link rel="stylesheet" href="https://bootswatch.com/sandstone/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">

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

    <style>
    </style>


  </head>
  <body>
    
    <nav class="navbar navbar-default navbar-fixed-top">
      <a class="navbar-brand">RKF</a>
    </nav>
    <br><br><br><br>

    <div class="container" id="main">

      <div class="row">

        <div class="col-md-5">
          <div id="division_proker_container"></div>
        </div>

        <div class="col-md-7">
          <div id="form_container"></div> 
        </div>

      </div>
      
    </div>

  </body>
</html>

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
      this.props.onHandleChange(e.target.value);
    },

    render: function() {
      var options = this.state.data.map(function (divisi) {
        return (
          <option value={divisi.id} key={divisi.id}>{divisi.shortname}</option>
        );
      });
      return (
        <select className="form-control"
                value={this.state.chosenDivision} 
                onChange={this.handleDivisionChange}>
          {options}
        </select>        
      )
    }
  });

  var ProkerForm = React.createClass ({

    getInitialState: function() {
      return {name: '', description: '', startDate: '', endDate: '', deadline: ''};
    },
    handleNameChange: function(e) {
      this.setState({name: e.target.value});
    },
    handleDescriptionChange: function(e) {
      this.setState({description: e.target.value});
    },
    handleStartDateChange: function(e) {
      this.setState({startDate: e.target.value});
    },
    handleEndDateChange: function(e) {
      this.setState({endDate: e.target.value});
    },
    handleDeadlineChange: function(e) {
      this.setState({deadline: e.target.value});
    },

    handleSubmit: function(e) {
      e.preventDefault();
      var name = this.state.name;
      var description = this.state.description;
      var startDate = this.state.startDate;
      var endDate = this.state.endDate;
      var deadline = this.state.deadline;

      if (!name || !description || !startDate || !endDate || !deadline) {
        alert('something wrong');
        console.log(this.state);
        return;
      }

      // TODO: send request to the server
      this.setState(this.getInitialState());
    },

    render: function() {
      return (
        <form onSubmit={this.handleSubmit}>
          <div className="row">
            <div className="col-md-8">
              <div className="form-group">
                <label for="">Divisi</label>
                <DivisiSelect />
              </div>
              <div className="form-group">
                <label for="">Nama Proker</label>
                <input type="text" className="form-control" placeholder="Nama proker" 
                  value={this.state.name} onChange={this.handleNameChange}/>
              </div>
              <div className="form-group">
                <label for="">Deskripsi Proker</label>
                <input type="text" className="form-control" placeholder="Deskripsi proker" 
                  value={this.state.description} onChange={this.handleDescriptionChange} />
              </div>              
              <div className="form-group">
                <label for="">Tanggal Pelaksanaan</label>
                <div className="input-daterange input-group" id="datepicker">
                    <input type="text" className="input-sm form-control"
                      value={this.state.startDate} 
                      onChangeDate={this.handleStartDateChange} />
                    <span className="input-group-addon">to</span>
                    <input type="text" className="input-sm form-control" name="end"
                      value={this.state.endDate} 
                      onChange={this.handleEndDateChange} />
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="form-group">
                <label for="">Tanggal Deadline</label>
                <div id="deadline-datepicker"></div>
              </div>

              <button type="submit" className="btn btn-default">Tambah</button>              
            </div>
          </div>

        </form>
      );
    }
  });

  ReactDOM.render(
    <ProkerForm />,
    document.getElementById('form_container')
  );

  var ProkerRow = React.createClass ({
    render: function() {
      return (
        <tr>
          <td>{this.props.name}</td>
          <td>{this.props.description}</td>
          <td>{this.props.start_date} - {this.props.end_date}</td>
          <td>{this.props.deadline}</td>
          <td>{this.props.done}</td>
        </tr>
      )
    }
  });

  var ProkerRows = React.createClass ({

    loadFromServer: function() {
      $.ajax({
        url: '/api/division/' + this.props.divisionId + '/proker/',
        dataType: 'json',
        cache: false,

        success: function(data) {
          this.setState({data: data});
        }.bind(this),

        error: function(xhr, status, err) {
          console.error(this.props.url, status, err.toString());
        }.bind(this)
      });
    },

    getInitialState: function() {
      return {data: []};
    },

    componentDidMount: function() {
      this.loadFromServer();
      setInterval(this.loadFromServer(), this.props.pollInterval);
    },

    render: function() {
      var prokerNodes = this.state.data.map(function(proker) {
        return (
          <ProkerRow key={proker.id}
            name={proker.name}
            description={proker.description}
            start_date={proker.start_date}
            end_date={proker.end_date}
            deadline={proker.deadline}
            done={proker.done}
          />
        );
      })
      return (
        <tbody>{prokerNodes}</tbody>
      );
    }

  });

  var ProkerTable = React.createClass ({
    getInitialState: function() {
      return {divisionId: 1};
    },
    onHandleChange: function(i) {
      this.setState({divisionId: i});
    },
    render: function() {
      return (
        <div className="panel panel-default panel-body">
          <DivisiSelect onHandleChange={this.onHandleChange}/>
          <br />
          <table className="table table-condensed">
            <thead>
              <tr>
                <th>Proker</th>
                <th>Deskripsi</th>
                <th>Pelaksaan</th>
                <th>Deadline</th>
                <th>Selesai</th>
              </tr>
            </thead>
            <ProkerRows divisionId={this.state.divisionId} />
          </table>
        </div>
      );
    }
  });

  ReactDOM.render(
    <ProkerTable />,
    document.getElementById('division_proker_container')
  );


  $('.input-daterange').datepicker({});
  $('#deadline-datepicker').datepicker()
    .on('changeDate', function(e) {
      alert(e.date);
    });
</script>