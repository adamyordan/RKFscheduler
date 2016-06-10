@extends('layouts.app')

@section('content')

<div class="row">

  <div class="col-md-4">
    <div id="division_container"></div>
  </div>

  <div class="col-md-8">
    <div id="division_proker_container"></div>   
  </div>

</div>

<script type="text/babel">

// handle links with @href started with '#' only
$(document).on('click', 'a[href^="#"]', function(e) {
    // target element id
    var id = $(this).attr('href');

    // target element
    var $id = $(id);
    if ($id.length === 0) {
        return;
    }

    // prevent standard hash navigation (avoid blinking in IE)
    e.preventDefault();

    // top position relative to the document
    var pos = $(id).offset().top - 80;

    // animated top scrolling
    $('body, html').animate({scrollTop: pos});
});

var DivisionRow = React.createClass ({
  render: function() {
    return (
      <a href={'#' + this.props.shortname} className="list-group-item">
        <h4 className="list-group-item-heading">{this.props.shortname}</h4>
        <p className="list-group-item-text">{this.props.name}</p>
      </a>
    );
  }
})

var DivisionList = React.createClass ({
  loadDivisionsFromServer: function() {
    $.ajax({
      url: this.props.url,
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
    return {data: []}
  },

  componentDidMount: function() {
    this.loadDivisionsFromServer();
    setInterval(this.loadDivisionsFromServer(), this.props.pollInterval);
  },

  render: function() {

    var divisionNodes = this.state.data.map(function(division) {
      return (
        <DivisionRow key={division.id}
          name={division.name} 
          shortname={division.shortname}
          description={division.description} />
      );
    });

    return (
      <div className="list-group" data-spy="affix">
        {divisionNodes}
      </div>
    );
  }
});

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
  render: function() {
    return (
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
        <ProkerRows divisionId={this.props.divisionId} />
      </table>
    );
  }
});

var ProkerSections = React.createClass ({

  loadFromServer: function() {
    $.ajax({
      url: '/api/division/',
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
    return {data: []}
  },

  componentDidMount: function() {
    this.loadFromServer();
    setInterval(this.loadFromServer(), this.props.pollInterval);
  },

  render: function() {
    var prokerSections = this.state.data.map(function(division) {
      return (
        <div className="panel panel-default" key={division.id} id={division.shortname}>
          <div className="panel-body">
            <h3> {division.name} </h3>
            <ProkerTable 
              divisionName={division.name}
              divisionId={division.id}
              />
          </div>
        </div>
      );
    })
    return (
      <div>
        {prokerSections}      
      </div>
    );
  }

});

ReactDOM.render(
  <DivisionList url="{{route('api.division.index')}}" pollInterval={30000} />,    
  document.getElementById('division_container')
);


ReactDOM.render(
  <ProkerSections pollInterval={30000}/>,
  document.getElementById('division_proker_container')
);

</script>

@endsection
